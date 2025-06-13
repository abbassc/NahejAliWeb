<!DOCTYPE html>
<html lang="ar">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
</head>

<body>
    <header>
        <h1> Login </h1>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
            </ul>
        </nav>
    </header>

    <main class=''>
        
        <div  style="width:400px;">
            <form action="{{ route('login') }}" method="POST">
              @csrf
                <div>
                    <label for="email"> Email: </label>
                    <input id="email" name="email" type="email" placeholder="Enter your email" required>
                </div>

                <br>
                <div>
                    <label for="password"> Password: </label>
                    <input id="password" name="password" type="password" placeholder="Enter your password" required>
                </div>

                <br>
                <button type="submit">Login</button>
                <button type="reset">Reset</button>
                <br><br>
            </form>

            <!-- <p>Forgot password? <a href="#forgot-pass">Reset password</a></p> -->
            <p>Don't have an account? <a href="{{ route('register') }}">Sign up</a></p>
        </div>

        <!-- <section id="forgot-pass" style="display: block;">
          <h2>Reset Your Password</h2>
          <form>
            <label>Email:
              <input type="email" placeholder="Enter your email" required />
            </label>
            <br />
            <button type="submit">Send Reset Link</button>
          </form>
        </section> -->

    </main>

  
</body>
</html>
