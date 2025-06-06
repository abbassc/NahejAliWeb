<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
</head>

<body>
    <header>
        <h1> Register </h1>
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('login') }}">Login</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <button onclick="openRegisterAsDonor()">Register as Donor</button> 
        <button onclick="openRegisterAsVolunteer()">Register as Volunteer</button> 

        <div style="width:400px; display: none;" id="register-as-donor" class="signup-container" >
            <h2>Register as Donor</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    <label for="name"> Name: </label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                </div>

                <br>
                <div>
                    <label for="email"> Email: </label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <br>
                <div>
                    <label for="phone"> Phone: </label>
                    <input type="number" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>

                <br>
                <div>
                    <label for="location"> Location: </label>
                    <input type="text" id="location" name="location" placeholder="Enter your location" required>
                </div>

                <br>
                <div>
                    <label for="password"> Password: </label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                </div>

                <br>
                
                <br>
                <button type="submit">Register</button>
                <button type="reset">Reset</button>
            </form>
            <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
        </div>

        <section class="form-container" style="display: none;" id="register-as-volunteer">
        <h2>Register as Volunteer</h2>
        <form>
            @csrf
            <label for="name" style="font-weight: bold;">Full Name:</label>
            <input id="name" name="name" type="text" placeholder="Full Name" required>
            <br>

            <label for="phone" style="font-weight: bold;">Phone Number:</label>
            <input id="phone" name="phone" type="number" placeholder="Phone" required>
            <br>

            <label for="email"> Email: </label>
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <br>            

            <label for="location" style="font-weight: bold;">Location:</label>
            <input id="location" name="location" type="text" placeholder="Enter your location" required>
            <br>

            <label for="availabilty" style="font-weight: bold;">Select your availabilty</label>
            <select name="availabilty" id="availabilty">
            <option value="" disabled selected>availabilty</option>
            <option value="week-end">Week-end</option>
            <option value="7-days">7-days</option>
            <option value="Mon--Fri">Mon--Fri</option>
            </select>
            
            <br>

            <label for="message" style="font-weight: bold;">Volunteer message:</label>
            <textarea id="message" name="message" placeholder="Why do you want to volunteer?" rows="4"></textarea>

            <button type="submit">Register</button>
            <button type="reset" class="reset-button">Reset</button>
        </form>
    </section>
    </main>

    <script>
        function closeRegisterAsDonor(){
            document.getElementById("register-as-donor").style.display = "none";
        }

        function closeRegisterAsVolunteer(){
            document.getElementById("register-as-volunteer").style.display = "none";
        }

        function closeAllModals(){
            closeRegisterAsDonor();
            closeRegisterAsVolunteer();
        }

        function openRegisterAsDonor(){
            closeAllModals();
            document.getElementById("register-as-donor").style.display = "block";
        }

        function openRegisterAsVolunteer(){
            closeAllModals();
            document.getElementById("register-as-volunteer").style.display = "block";
        }
    </script>

</body>

</html>