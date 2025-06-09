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
        <li><button onclick="openLog()">Profile</button></li>
      </ul>
    </nav>
  </header>
  <main class="section">
    




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





    <div id="remaining-2">
      <h2>Make a donation</h2>
      <button class="btn" onclick="openAddNewDonation()">Make a Donation</button>
    </div>

    <section id="new-donation" style="display: none;">

      <button class="button" onclick="closeAddNewDonation()">Back to Dashboard</button>

      <form action="{{ route('donor.donations.store') }}" method="POST">
        @csrf
        @method('POST')
        <label>Donation Type:</label>
        <select name="type" required>
          <option value="">-- Select --</option>
          <option value="money">Money</option>
          <option value="food">Food</option>
          <option value="clothes">Clothes</option>
        </select>

        <label>Amount:</label>
        <input name="amount" type="text" placeholder="Enter amount" >

        <label>Description:</label>
        <input name="description" type="text" placeholder="Enter description" >

        <label>Location:</label>
        <input name="location" type="text" placeholder="Enter your location" required>

        <label>Date:</label>
        <input id="date" name="date" type="date" placeholder="Enter the date" required>

        <label>Time:</label>
        <input name="time" type="text" placeholder="Enter the prefered time" required>

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
        @foreach($donations as $donation)
          <li>{{ $donation->type }} - {{ $donation->amount }} - {{ $donation->date }} - {{ ucfirst($donation->status) }}</li>
        @endforeach
      </ul>
      <table>
        <tr><th>Type</th><th>Amount</th><th>Date</th><th>Status</th><th>Actions</th></tr>
        @foreach($donations as $donation)
          <tr>
            <td>{{ $donation->type }}</td>
            <td>{{ $donation->amount }}</td>
            <td>{{ $donation->date }}</td>
            <td>{{ ucfirst($donation->status) }}</td>
            <td>
              <button type="button" onclick="openUpdateModal('{{ $donation->id }}')">Update</button>
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

    <!-- EDITTTTTTTTTTTTTTT-->
    <section id="update-modal" style="display:none;">
      <h3>Update Donation</h3>
      <form id="update-donation-form" action="{{ route('donor.donations.update') }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="donation_id" id="donation_id" />

        <label>Donation Type:</label>
        <select name="type" id="type_update" required>
          <option value="">-- Select --</option>
          <option value="money">Money</option>
          <option value="food">Food</option>
          <option value="clothes">Clothes</option>
        </select>

        <label>Amount:</label>
        <input name="amount" id="amount_update" type="text" placeholder="Enter amount" >

        <label>Description:</label>
        <input name="description" id="description_update" type="text" placeholder="Enter description" >

        <label>Location:</label>
        <input name="location" id="location_update" type="text" placeholder="Enter your location" required>

        <label>Date:</label>
        <input name="date" id="date_update" type="date" placeholder="Enter the date" required>

        <label>Time:</label>
        <input name="time" id="time_update" type="text" placeholder="Enter the preferred time" required>

        <button type="submit" onclick="showUpdateConfirmation()">Update Donation</button>
        <button type="button" onclick="closeUpdateModal()">Cancel</button>
      </form>
    </section>

  </main>

  <script>

  function openLog(){
    document.getElementById('log').style.display = 'block';
  }
  function closeLog(){
    document.getElementById('log').style.display = 'none';
  }

    function showDonationConfirmation() {  
      let date = document.getElementById("date").value;

      if (date) {
          alert(`Donation added on ${date}!`);
      }
      else {
          alert("Please select all required values.");
      }
    }

    function showDeleteConfirmation(){  
      alert("Your donation has been deleted.");
    }

    function showUpdateConfirmation() {
      alert("Your donation has been updated.");
    }

    

    const donationsData = {
      @foreach($donations as $donation)
        {{ $donation->id }} : {
          type: '{{ $donation->type }}',
          amount: '{{ $donation->amount }}',
          description: '{{ $donation->description }}',
          location: '{{ $donation->location }}',
          date: '{{ $donation->date }}',
          time: '{{ $donation->time }}'
        },
      @endforeach
    };

    function openUpdateModal(donationId){
      closeRemaining();
      closeAddNewDonation();
      const donation = donationsData[donationId];
      if(!donation) return alert('Donation data not found');

      document.getElementById("update-modal").style.display = "block";

      document.getElementById("donation_id").value = donationId;
      document.getElementById("type_update").value = donation.type;
      document.getElementById("amount_update").value = donation.amount;
      document.getElementById("description_update").value = donation.description;
      document.getElementById("location_update").value = donation.location;
      document.getElementById("date_update").value = donation.date;
      document.getElementById("time_update").value = donation.time;
    }
    function closeUpdateModal() {
      document.getElementById("update-modal").style.display = "none";
    }

    function closeRemaining(){
      document.getElementById("remaining").style.display = "none";
      document.getElementById("remaining-2").style.display = "none";
      closeUpdateModal();
    }

    function closeAddNewDonation(){
      document.getElementById("new-donation").style.display = "none";
      openRemaining();
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