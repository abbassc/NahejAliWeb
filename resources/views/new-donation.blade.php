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
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="{{ route('register') }}">Register</a></li>
        <li><a href="{{ route('login') }}">Login</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <section>
      <h2>Donate Now</h2>

      <form>
        @csrf
        <label>Name:</label>
        <input name="name" type="text" placeholder="Enter your family name" required>

        <label>Phone:</label>
        <input name="phone" type="text" placeholder="Enter your phone number" required>

        <label>Donation Type:</label>
        <select name="type" required>
          <option value="">-- Select --</option>
          <option value="money">Money</option>
          <option value="food">Food</option>
          <option value="clothes">Clothes</option>
        </select>

        <label>Amount:</label>
        <input name="amount" type="text" placeholder="Enter amount" required>

        <label>Descriptions:</label>
        <input name="description" type="text" placeholder="Enter description">

        <label>Location:</label>
        <input name="location" type="text" placeholder="Enter your location" required>

        <label>Date:</label>
        <input name="date" type="date" placeholder="Enter the date" required>

        <label>Time:</label>
        <input name="time" type="text" placeholder="Enter the prefered time" required>

        <button type="submit" onclick="">Submit Donation</button>
      </form>
      
    </section>
  </main>
  <footer>
    <p>&copy; 2025 Nahej Ali Organization</p>
  </footer>
</body>
</html>
