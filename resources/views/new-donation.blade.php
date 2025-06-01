<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Make a Donation</title>
  <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
  </head>
<body>
  <header>
    <h1>Make a Donation</h1>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="register.html">Register</a></li>
        <li><a href="login.html">Login</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <section>
      <h2>Donate Now</h2>

      <form>
        <label>Name:</label>
        <input type="text" placeholder="Enter your family name" required>

        <label>Phone:</label>
        <input type="text" placeholder="Enter your phone number" required>

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
  </main>
  <footer>
    <p>&copy; 2025 Nahej Ali Organization</p>
  </footer>
</body>
</html>
