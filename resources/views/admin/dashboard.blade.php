<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Page</title>
  <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
  <script src="{{ asset('js/script.js') }}"></script>
</head>

<body>
  <header>
    <h1>Admin Page</h1>
    <nav>
      <ul type="disc">
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#dashboard">Dashboard</a></li>
        <li><a href="#panel">Panel</a></li>
        <li><a href="#families">Families</a></li>
        <li><a href="#report">Reports</a></li>
        <li><a onclick="openLog()">Profile</a></li>
        <li>
          <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn">Logout</button>
          </form>
        </li>
      </ul>
    </nav>
  </header>
  <main>








  <div id="log" style="display: none;">
  <button class="btn" onclick="closeLog()">Close</button>
    <x-app-layout>
            <x-slot name="header">
                <h2 >
                    {{ __('Dashboard') }}
                </h2>
            </x-slot>

            <div >
                <div >
                    <div >
                        <div >
                            {{ __("You're logged in!") }}
                        </div>
                    </div>
                </div>
            </div>
    </x-app-layout>
  </div>





    <div class="dashboard" id="dashboard">
      <h1>Dashboard</h1>

      <section id="donations">
        <h2>New Donations</h2>
        @if($pendingDonations->count() > 0)
          <ul>
            @foreach($pendingDonations as $donation)
              <li>
                <div class="card">
                  <h3>{{ $donation->title }}</h3>
                  <p>Location: {{ $donation->location }}</p>
                  <p>Date: {{ $donation->date }}</p>
                  <p>Preferred Time: {{ \Carbon\Carbon::parse($donation->prefered_time)->format('Y-m-d H:i') }}</p>
                  <p>Category: {{ ucfirst($donation->category) }}</p>
                  <p>Amount: {{ $donation->amount }}</p>
                  <form action="{{ route('admin.donations.assign', $donation->id) }}" method="POST">
                    @csrf
                    <select name="volunteer_id" required>
                      <option value="">Select Volunteer</option>
                      @foreach($availableVolunteers as $volunteer)
                        <option value="{{ $volunteer->id }}">{{ $volunteer->user->name }}</option>
                      @endforeach
                    </select>
                    <button type="submit" class="btn">Assign to Volunteer</button>
                  </form>
                </div>
              </li>
            @endforeach
          </ul>
        @else
          <p>No pending donations at the moment.</p>
        @endif
      </section>

      <section id="volunteers">
        <h2>Volunteers</h2>
        @if($volunteers->count() > 0)
          <table>
            <thead>
              <tr>
                <th>Volunteer Name</th>
                <th>Location</th>
                <th>Phone</th>
                <th>Active Tasks</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($volunteers as $volunteer)
                <tr>
                  <td>{{ $volunteer->user->name }}</td>
                  <td>{{ $volunteer->location }}</td>
                  <td>{{ $volunteer->phone }}</td>
                  <td>{{ $volunteer->donations()->where('status', 'assigned')->count() }}</td>
                  <td>
                    <a href="{{ route('admin.volunteers.index') }}" class="btn">Edit</a>
                    <form action="{{ route('admin.volunteers.delete', $volunteer->user_id) }}" method="POST" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete this volunteer?')">Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <p>No volunteers registered yet.</p>
        @endif
      </section>

      <section id="families">
        <h2>Families</h2>
        @if($families->count() > 0)
          <table>
            <thead>
              <tr>
                <th>Family Name</th>
                <th>Location</th>
                <th>Phone</th>
                <th>Members</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($families as $family)
                <tr>
                  <td>{{ $family->name }}</td>
                  <td>{{ $family->location }}</td>
                  <td>{{ $family->phone }}</td>
                  <td>{{ $family->members }}</td>
                  <td>
                    <a href="{{ route('admin.families.index') }}" class="btn">Edit</a>
                    <form action="{{ route('admin.families.delete', $family->id) }}" method="POST" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete this family?')">Delete</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        @else
          <p>No families registered yet.</p>
        @endif
      </section>

      <div class="stats-container">
        <div class="card">
          <h3>Donation Statistics</h3>
          <p>Total Donations: {{ $totalDonations }}</p>
          <p>Pending Donations: {{ $pendingDonations->count() }}</p>
          <p>Completed Donations: {{ $completedDonations }}</p>
          <a href="{{ route('admin.donations') }}" class="btn">View Details</a>
        </div>

        <div class="card">
          <h3>Family Statistics</h3>
          <p>Total Families: {{ $families->count() }}</p>
          <a href="{{ route('admin.families.index') }}" class="btn">View Details</a>
        </div>

        <div class="card">
          <h3>Volunteer Statistics</h3>
          <p>Total Volunteers: {{ $volunteers->count() }}</p>
          <p>Active Volunteers: {{ $activeVolunteers }}</p>
          <a href="{{ route('admin.volunteers.index') }}" class="btn">View Details</a>
        </div>
      </div>
    </div>

    <section class="mainandsidebar" id="panel">
      <!-- Sidebar -->
      <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="{{ route('admin.donations') }}">Manage Donations</a>
        <a href="{{ route('admin.volunteers.index') }}">Manage Volunteers</a>
        <a href="{{ route('admin.families.index') }}">Manage Families</a>
        <a href="{{ route('admin.reports') }}">Generate Reports</a>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <div class="section">
          <h3>Quick Actions</h3>
          <div class="action-buttons">
            <a href="{{ route('admin.volunteers.add') }}" class="btn">Add New Volunteer</a>
            <a href="{{ route('admin.families.add') }}" class="btn">Add New Family</a>
            <a href="{{ route('admin.donations') }}" class="btn">View All Donations</a>
          </div>
        </div>
      </div>
    </section>

    <section id="families">
      <h2>Family List</h2>
      <table>
        <tr><th>Family Name</th><th>Members</th><th>Area</th></tr>
        <tr><td>Khalil</td><td>5</td><td>Haret Hreik</td></tr>
        <tr><td>Mohsen</td><td>6</td><td>Corniche</td></tr>
      </table>
    </section>

    <section id="report">
      <h2>Donations Report</h2>
      <table>
        <tr>
          <th>Donation Type</th>
          <th>Amount</th>
          <th>Date</th>
        </tr>
        <tr>
          <td>Money</td>
          <td>$500</td>
          <td>March 2025</td>
        </tr>
        <tr>
          <td>Food</td>
          <td>200 kg</td>
          <td>February 2025</td>
        </tr>
      </table>

      <h3>Funds Distribution</h3>
      <ul>
        <li>50% of funds allocated to food distribution</li>
        <li>30% allocated to family support</li>
        <li>20% allocated to administrative costs</li>
      </ul>
    </section>

  </main>
  <footer>
    <p>&copy; 2025 Nahej Ali Organization</p>
  </footer>
</body>
<script>
    function openLog(){
    document.getElementById('log').style.display = 'block';
  }
  function closeLog(){
    document.getElementById('log').style.display = 'none';
  }
</script>
</html>
