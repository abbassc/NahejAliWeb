<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Donor Profile</title>
  <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
</head>
<body>
  <header>
    <h1>Donor Profile</h1>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="new-donation.html">Donate</a></li>        
        <li><a href="about.html">About</a></li>
      </ul>
    </nav>
  </header>
  <main class="section">
    <div id="remaining-2">
      <h2>Make a donation</h2>
      <button class="btn" onclick="openAddNewDonation()">Make a Donation</a>
    </div>

    <section id="new-donation" style="display: none;">

      <button class="button" onclick="closeAddNewDonation()">Back to Dashboard</button>

      <form>
        <label>Donation Type:</label>
        <select required>
          <option value="">-- Select --</option>
          <option value="money">Money</option>
          <option value="food">Food</option>
          <option value="clothes">Clothes</option>
        </select>

        <label>Amount / Description:</label>
        <input type="text" placeholder="Enter amount or description" required>

        <label>Occasion:</label>
        <input type="text" placeholder="Enter occasion title">

        <label>Location:</label>
        <input type="text" placeholder="Enter your location" required>

        <label>Date:</label>
        <input type="date" placeholder="Enter the date" required>

        <label>Time:</label>
        <input type="text" placeholder="Enter the prefered time" required>

        <button type="submit" onclick="">Submit Donation</button>
      </form>
    </section>

    <section id="remaining" style="display: block;">
      <h2>Donor Details</h2>
      <p>Name: John Doe</p>
      <p>Phone: +961 -- --- ---</p>
      <p>Location: City Area Street Bldg Aprt</p>

      <h3>Past Donations</h3>
      <ul>
        <li>Money - $100 - March 2025</li>
        <li>Food - 20 kg of Rice - February 2025</li>
      </ul>
      <table>
        <tr><th>Type</th><th>Amount</th><th>Date</th></tr>
        <tr><td>Money</td><td>$100</td><td>Mar 2025</td></tr>
        <tr><td>Food</td><td>20kg Rice</td><td>Feb 2025</td></tr>
      </table>
    </section>
  </main>

  <script>
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

    function openRemainig(){
      document.getElementById("remaining").style.display = "block";
      document.getElementById("remaining-2").style.display = "block";
    }
  </script>

  <footer>
    <p>&copy; 2025 Nahej Ali Organization</p>
  </footer>
</body>
</html>