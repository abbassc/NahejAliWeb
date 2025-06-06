<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Donor Profile</title>
  <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
  <script src="{{ asset('js/script.js') }}"></script>
</head>
<body>
  <header>
    <h1  id="welcomeMessage">Welcome, Donor {{ Auth::user()->name }}</h1>
    <nav>
      <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('donor.donations.add') }}">Donate</a></li>        
        <li>
          <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit">Logout</button>
          </form>
        </li>
      </ul>
    </nav>
  </header>
  <main class="section">
    <div id="remaining-2">
      <h2>Make a donation</h2>
      <button class="btn" onclick="openAddNewDonation()">Make a Donation</button>
    </div>

    <section id="new-donation" style="display: none;">

      <button class="button" onclick="closeAddNewDonation()">Back to Dashboard</button>

      <form action="{{ route('donor.donations.store') }}" method="POST">
        @csrf
        <label>Donation Type:</label>
        <select name="type" required>
          <option value="">-- Select --</option>
          <option value="money">Money</option>
          <option value="food">Food</option>
          <option value="clothes">Clothes</option>
        </select>

        <label>Amount:</label>
        <input type="text" placeholder="Enter amount" >

        <label>Description:</label>
        <input type="text" placeholder="Enter description" >

        <label>Location:</label>
        <input type="text" placeholder="Enter your location" required>

        <label>Date:</label>
        <input type="date" placeholder="Enter the date" required>

        <label>Time:</label>
        <input type="text" placeholder="Enter the prefered time" required>

        <button type="submit" onclick="showDonationConfirmation()">Submit Donation</button>
      </form>
    </section>

    <section id="remaining" style="display: block;">
      <h2>Donor Details</h2>
      <p>Name: {{ $donor->name }}</p>
      <p>Phone: {{ $donor->phone }}</p>
      <p>Location: {{ $donor->location }}</p>

      <h3>Past Donations</h3>
      <ul>
        <li>Money - $100 - March 2025</li>
        <li>Food - 20 kg of Rice - February 2025</li>
      </ul>
      <table>
        <tr><th>Type</th><th>Amount</th><th>Date</th><th>Status</th><th>Actions</th></tr>
        <tr><td>Money</td><td>$100</td><td>Mar 2025</td></tr>
        <tr><td>Food</td><td>20kg Rice</td><td>Feb 2025</td></tr>
        @foreach($donations as $donation)
          <tr>
            <td>{{ $donation->type }}</td>
            <td>{{ $donation->amount }}</td>
            <td>{{ $donation->date }}</td>
            <td>{{ ucfirst($donation->status) }}</td>
            <td>
              <button type="button" onclick="openUpdateModal('{{ $donation->id }}',)">Update</button>
              <form action="{{ route('donor.donations.cancel', $donation->id)}}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="showDeleteConfirmation()">Delete</button>
              </form>
            </td>
          </tr>
        @endforeach
      </table>
    </section>
  </main>

  <script>
    function showDonationConfirmation() {    }

    function showDeleteConfirmation(){    }

    function openUpdateModal(donationId){}

    function closeRemaining(){
      document.getElementById("remaining").style.display = "none";
      document.getElementById("remaining-2").style.display = "none";
    }

    function closeAddNewDonation(){
      document.getElementById("new-donation").style.display = "none";
      openRemainig();
    }

    function openAddNewDonation(){
      closeRemaining();
      document.getElementById("new-donation").style.display = "block";
    }

    function openRemaining(){
      document.getElementById("remaining").style.display = "block";
      document.getElementById("remaining-2").style.display = "block";
    }
  </script>

  <footer>
    <p>&copy; 2025 Nahej Ali Organization</p>
  </footer>
</body>
</html>