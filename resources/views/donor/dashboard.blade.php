<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Donor Profile</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <script src="{{ asset('js/script.js') }}"></script>
</head>
<body>
  <header>
    <h1  id="welcomeMessage">Welcome, Donor {{ Auth::user()->name }}</h1>
    <nav>
      <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('donor.donations.add') }}">Donate</a></li>    
        <li><a onclick="openLog()">Profile</a></li>    
        <li>
          <form action="{{ route('logout') }}" method="POST" style="display: inline; background: none; border: none; padding: 0; margin: 0;">
            @csrf
            <button type="submit" style="background: none;"><a>Logout</a></button>
          </form>
        </li>
      </ul>
    </nav>
  </header>
  <main class="section">
    




  <div id="log" style="display: none;">
    <button onclick="openRemaining()">Close</button>
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





    

    

    <section id="remaining" style="display: block;">
      <h2 style="margin-top: 0rem;">Donor Details</h2>
      <p style="font-weight: bold;">Name: {{ $donor->user->name }}</p>
      <p style="font-weight: bold;">Phone: {{ $donor->phone }}</p>
      <p style="font-weight: bold;">Location: {{ $donor->location }}</p>

      <div id="remaining-2">
        <button class="btn" onclick="openAddNewDonation()">Make a Donation</button>
      </div>

      <h3>Past Donations</h3>
      <table>
        <tr>
          <th>Title</th>
          <th>Category</th>
          <th>Amount</th>
          <!-- <th>Date</th> -->
          <th>Preferred Time</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
        @foreach($donations as $donation)
          <tr>
            <td>{{ $donation->title }}</td>
            <td>{{ ucfirst($donation->category) }}</td>
            <td>{{ $donation->amount }}</td>
            <!-- <td>{{ $donation->date }}</td> -->
            <td>{{ \Carbon\Carbon::parse($donation->prefered_time)->format('Y-m-d H:i') }}</td>
            <td>{{ ucfirst($donation->status) }}</td>
            <td>
              <button class="btn" type="button" onclick="openUpdateModal('{{ $donation->id }}')">Update</button>
              <form action="{{ route('donor.donations.cancel', $donation->id)}}" method="POST" style="display: inline; background: none; border: none; padding: 0; margin: 0;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="showDeleteConfirmation()">Delete</button>
                <!-- <button type="submit" style="background: none; border: none; padding: 0; margin: 0; cursor: pointer; color: inherit; font: inherit;">Delete</button> -->
              </form>
            </td>
          </tr>
        @endforeach
      </table>
    </section>

    <section id="new-donation" style="display: none;">
      <h2>Make a donation</h2>
      <button class="btn" onclick="openRemaining()">Back to Dashboard</button>

      <form action="{{ route('donor.donations.store') }}" method="POST">
        @csrf
        <label>Title:</label>
        <input name="title" type="text" placeholder="Enter donation title" required>

        <label>Category:</label>
        <select name="category" required>
          <option value="">-- Select --</option>
          <option value="money">Money</option>
          <option value="food">Food</option>
          <option value="clothes">Clothes</option>
        </select>

        <label>Amount:</label>
        <input name="amount" type="number" placeholder="Enter amount">

        <label>Description:</label>
        <input name="description" type="text" placeholder="Enter description" required>

        <label>Location:</label>
        <input name="location" type="text" placeholder="Enter your location" required>

        <label>Phone:</label>
        <input name="phone" type="text" placeholder="Enter your phone number" required>

        <label>Preferred Time:</label>
        <input name="prefered_time" type="datetime-local" required>

        <!-- <button type="submit" onclick="showDonationConfirmation()">Submit Donation</button> -->
         <br><br>
        <button type="submit">Submit Donation</button>
      </form>
    </section>

    <!-- Update Modal -->
    <section id="update-modal" style="display:none;">
      <h3>Update Donation</h3>
      <form id="update-donation-form" action="" method="POST" class="donation-form">
        @csrf
        @method('PUT')

        <input type="hidden" name="donation_id" id="donation_id" />

        <label>Title:</label>
        <input name="title" id="title_update" type="text" placeholder="Enter donation title" required>

        <label>Category:</label>
        <select name="category" id="category_update" required>
          <option value="">-- Select --</option>
          <option value="money">Money</option>
          <option value="food">Food</option>
          <option value="clothes">Clothes</option>
        </select>

        <label>Amount:</label>
        <input name="amount" id="amount_update" type="number" placeholder="Enter amount">

        <label>Description:</label>
        <input name="description" id="description_update" type="text" placeholder="Enter description" required>

        <label>Location:</label>
        <input name="location" id="location_update" type="text" placeholder="Enter your location" required>

        <label>Phone:</label>
        <input name="phone" id="phone_update" type="text" placeholder="Enter your phone number" required>

        <label>Preferred Time:</label>
        <input name="prefered_time" id="prefered_time_update" type="datetime-local" required>

        <button type="submit">Update Donation</button>
        <button type="button" onclick="openRemaining()">Cancel</button>
      </form>
    </section>

  </main>

  <script>

  function openLog(){
    closeAllModals();
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
          title: '{{ $donation->title }}',
          category: '{{ $donation->category }}',
          amount: '{{ $donation->amount }}',
          description: '{{ $donation->description }}',
          location: '{{ $donation->location }}',
          phone: '{{ $donation->phone }}',
          // date: '{{ $donation->date }}',
          prefered_time: '{{ \Carbon\Carbon::parse($donation->prefered_time)->format('Y-m-d\TH:i') }}'
        },
      @endforeach
    };

    function openUpdateModal(donationId) {
        // closeRemaining();
        // closeAddNewDonation();
        closeAllModals();
        document.getElementById('update-modal').style.display = 'block';
        document.getElementById('donation_id').value = donationId;
        document.getElementById('update-donation-form').action = `/donor/donations/${donationId}`;
        
        // Get donation data from the donationsData object
        const donation = donationsData[donationId];
        if(!donation) return alert('Donation data not found');

        document.getElementById("title_update").value = donation.title;
        document.getElementById("category_update").value = donation.category;
        document.getElementById("amount_update").value = donation.amount;
        document.getElementById("description_update").value = donation.description;
        document.getElementById("location_update").value = donation.location;
        document.getElementById("phone_update").value = donation.phone;
        document.getElementById("prefered_time_update").value = donation.prefered_time;
    }
    function closeUpdateModal() {
      document.getElementById("update-modal").style.display = "none";
      // openRemaining();
    }

    function openAddNewDonation(){
      // closeRemaining();
      closeAllModals();
      document.getElementById("new-donation").style.display = "block";
    }

    function closeAddNewDonation(){
      document.getElementById("new-donation").style.display = "none";
      // openRemaining();
    }

    function openRemaining(){
      closeAllModals();
      document.getElementById("remaining").style.display = "block";
      document.getElementById("remaining-2").style.display = "block";
    }

    function closeRemaining(){
      document.getElementById("remaining").style.display = "none";
      document.getElementById("remaining-2").style.display = "none";
      // closeUpdateModal();
    }

    function closeAllModals(){
      closeUpdateModal();
      closeAddNewDonation();
      closeRemaining();
      closeLog();
    }
  </script>

  <footer>
    <p>&copy; 2025 Nahej Ali Organization</p>
  </footer>
</body>
</html>

<!-- if(!donation) return alert('Donation data not found');

document.getElementById("update-modal").style.display = "block";

document.getElementById("donation_id").value = donationId;
document.getElementById("type_update").value = donation.type;
document.getElementById("amount_update").value = donation.amount;
document.getElementById("description_update").value = donation.description;
document.getElementById("location_update").value = donation.location;
document.getElementById("date_update").value = donation.date;
document.getElementById("time_update").value = donation.time; -->