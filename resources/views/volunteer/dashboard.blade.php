<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Volunteer Dashboard</title>
  <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
  <script src="{{ asset('js/script.js') }}"></script>
</head>

<body>
  <header>
    <h1>Volunteer Dashboard</h1>
    <nav>
      <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#available-donations">Donations</a></li>
        <li><a href="#tasks">Tasks</a></li>
        <li><a href="#archive">Archive</a></li>
        <li>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Logout</button>
          </form>
        </li>
        <li><a onclick="openLog()">Profile</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <section>
      <h2>Welcome, {{ Auth::user()->name }}!</h2>
      <p>Email: {{ Auth::user()->email }}</p>
      <p>Phone: {{ Auth::user()->phone }}</p>
      <p>Location: {{ Auth::user()->location }}</p>
    </section>

    <section>
      <h2>My Assigned Donations</h2>
      @if($donations->isEmpty())
        <p>No donations assigned yet.</p>
      @else
        <table>
          <thead>
            <tr>
              <th>Title</th>
              <th>Category</th>
              <th>Amount</th>
              <th>Location</th>
              <th>Date</th>
              <th>Status</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($donations as $donation)
              <tr>
                <td>{{ $donation->title }}</td>
                <td>{{ $donation->category }}</td>
                <td>{{ $donation->amount }}</td>
                <td>{{ $donation->location }}</td>
                <td>{{ $donation->date }}</td>
                <td>{{ $donation->status }}</td>
                <td>
                  @if($donation->status === 'assigned')
                    <form action="{{ route('volunteer.donations.collect', $donation->id) }}" method="POST">
                      @csrf
                      <button type="submit" class="btn">Complete</button>
                    </form>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @endif
    </section>

    <div id="log" style="display: none;">
    <button onclick="closeLog()">Close</button>
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

    <section id="available-donations">
      <h2>Available Donations</h2>

      @if($availableDonations->count() > 0)
        <ul>
          @foreach($availableDonations as $donation)
            <li>
              <div class="card">
                <h3>{{ $donation->title }}</h3>
                <p>Location: {{ $donation->location }}</p>
                <p>Description: {{ $donation->description }}</p>
                <p>Date: {{ $donation->date }}</p>
                <p>Preferred Time: {{ \Carbon\Carbon::parse($donation->prefered_time)->format('Y-m-d H:i') }}</p>
                <form action="{{ route('volunteer.donations.reserve', $donation->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="btn">Reserve Donation</button>
                </form>
              </div>
            </li>
          @endforeach
        </ul>
      @else
        <p>No available donations at the moment.</p>
      @endif

    </section>

    <section id="tasks">
      <h2>Tasks</h2>
      @if($tasksDonations->count() > 0)
        <ul>
          @foreach($tasksDonations as $donation)
            <li>
              <div class="card">
                <h3>{{ $donation->title }}</h3>
                <p>Location: {{ $donation->location }}</p>
                <p>Description: {{ $donation->description }}</p>
                <p>Date: {{ $donation->date }}</p>
                <p>Preferred Time: {{ \Carbon\Carbon::parse($donation->prefered_time)->format('Y-m-d H:i') }}</p>
                <form action="{{ route('volunteer.donations.collect', $donation->id) }}" method="POST">
                  @csrf
                  <button type="submit" class="btn">Mark as Collected</button>
                </form>
              </div>
            </li>
          @endforeach
        </ul>
      @else
        <p>No assigned tasks at the moment.</p>
      @endif
    </section>

    <section id="archive">
      <h3>Past Contributions</h3>
      @if($completedDonations->count() > 0)
        <ul>
          @foreach($completedDonations as $donation)
            <li>
              <div class="card">
                <h3>{{ $donation->title }}</h3>
                <p>Location: {{ $donation->location }}</p>
                <p>Description: {{ $donation->description }}</p>
                <p>Date: {{ $donation->date }}</p>
                <p>Status: {{ ucfirst($donation->status) }}</p>
              </div>
            </li>
          @endforeach
        </ul>
      @else
        <p>No completed donations yet.</p>
      @endif
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