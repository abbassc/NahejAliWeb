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

      <form action="{{ route('guest.donations.store') }}" method="POST">
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
        <input name="phone" type="tel" placeholder="Enter your phone number" required>

        <!-- <label>Date:</label>
        <input name="date" type="date" required> -->

        <label>Preferred Time:</label>
        <input name="prefered_time" type="datetime-local" required>

        <button type="submit">Submit Donation</button>
      </form>
      
    </section>
  </main>
  <footer>
    <p>&copy; 2025 Nahej Ali Organization</p>
  </footer>
</body>
</html>
