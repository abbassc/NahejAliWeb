<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nahej Ali - Home</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        
    </style>
</head>

<body>
    <header>
        <h1>Nahej Ali Organization</h1>

        <nav>
            <ul type="disc">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>


        <!-- <li>
          <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit">Logout</button>
          </form>
        </li> -->


            </ul>
        </nav>
    </header>

    <main class="section">

        <section id="intro">
            <h2>Welcome to Nahej Ali</h2>
            <p>Supporting families in need across Lebanon. Join us in our mission of giving and hope.</p>

            <a class="btn" href="{{ route('guest.donations.create') }}">Make a Donation</a>
            <a class="btn" href="{{ route('register') }}">Join Our Family!</a>
            <br><br>
        </section>

        <section id="about">
            <h2>Who We Are</h2>
                                    
            <p>.مبادرة شبابية لتأمين الافطارات اليومية من طعامكم للعائلات المتعففة في شهر رمضان المبارك
                <br>ما تراه قليل؛ قد يعني الكثير <br><br></p>
            <div class="image-container">
                <figure>
                    <img src="{{ asset('images/temp-03.jpg') }}" alt="Nahej-ali logo" class="image" id="na-img">
                    <figcaption>Original Organization Logo</figcaption>
                </figure>
            </div>

            <p>Nahej Ali is a Lebanese nonprofit organization that manages donations and supports vulnerable families throughout the country.</p>
        </section>

    </main>

    <footer>
        <p>&copy; 2025 Nahej Ali Organization</p>
    </footer>
    
</body>
</html>