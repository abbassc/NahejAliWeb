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
        <button class="btn" onclick="openRegisterAsDonor()">Register as Donor</button> 
        <button class="btn" onclick="openRegisterAsVolunteer()">Register as Volunteer</button> 

        <div style="width:400px; display: none;" id="register-as-donor" class="signup-container" >
            <h2>Register as Donor</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div>
                    <label for="name" :value="__('Name')"> Name: </label>
                    <input type="text" id="name" name="name" :value="old('name')" placeholder="Enter your name" required>
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <br>
                <div>
                    <label for="email" :value="__('Email')"> Email: </label>
                    <input type="email" :value="old('email')" id="email" name="email" placeholder="Enter your email" required>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <br>
                <div>
                    <label for="phone" :value="__('Phone')"> Phone: </label>
                    <input type="number" :value="old('phone')" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>

                <br>
                <div>
                    <label for="location" :value="__('Location')"> Location: </label>
                    <input type="text" :value="old('location')" id="location" name="location" placeholder="Enter your location" required>
                </div>

                <br>
                <div>
                    <label for="password" :value="__('Password')"> Password: </label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div>
                    <label for="password_confirmation" :value="__('Confirm Password')"> Confirm password: </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <br>

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
            <label for="name" :value="__('Name')" style="font-weight: bold;">Full Name:</label>
            <input id="name" :value="old('name')" name="name" type="text" placeholder="Full Name" required>
            <br>

            <label for="phone" :value="__('Phone')" style="font-weight: bold;">Phone Number:</label>
            <input id="phone" :value="old('phone')" name="phone" type="number" placeholder="Phone" required>
            <br>

            <label for="email" :value="__('Email')"> Email: </label>
            <input type="email" :value="old('email')" id="email" name="email" placeholder="Enter your email" required>
            <br>            

            <div>
                <label for="password" :value="__('Password')"> Password: </label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
            <br>

            <div>
                <label for="password_confirmation" :value="__('Confirm Password')"> Confirm password: </label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
            <br>


            <label for="location" :value="__('Location')" style="font-weight: bold;">Location:</label>
            <input id="location" :value="old('location')" name="location" type="text" placeholder="Enter your location" required>
            <br>

            <label for="availabilty" :value="__('Availability')" style="font-weight: bold;">Select your availabilty</label>
            <select name="availabilty" :value="old('availability')" id="availabilty">
            <option value="" disabled selected>availabilty</option>
            <option value="week-end">Week-end</option>
            <option value="7-days">7-days</option>
            <option value="Mon--Fri">Mon--Fri</option>
            </select>
            
            <br>

            <label for="message" :value="__('Message')" style="font-weight: bold;">Volunteer message:</label>
            <textarea id="message" :value="old('message')" name="message" placeholder="Why do you want to volunteer?" rows="4"></textarea>

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