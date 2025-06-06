<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Volunteer Dashboard</title>
  <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
  <script src="{{ asset('js/script.js') }}"></script>
</head>

<body>
  <header>
    <h1>Volunteer Dashboard</h1>
    <nav>
      <ul>
        <li><a href="{{ route('home') }}">Home</a></li>
        <li><a href="#available-donations">Donations</a></li>
        <li><a href="#tasks">Tasks</a></li>
        <li><a href="#archive">Archive</a></li>
        <li>
          <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer;">Logout</button>
          </form>
        </li>
      </ul>
    </nav>
  </header>
  <main>

     <section id="available-donations">
      <h2>Available Donations</h2>

      <ul>

        <li>
          <div class="card">
            <h3> Donation title</h3>
            <p>location:      time:    </p>
            <button class="button" onclick="">Reserve Donation</button>
          </div>
        </li>

        <li>
          <div class="card">
            <h3> Donation 2 title</h3>
            <p>location:      time:    </p>
            <button class="button" onclick="">Reserve Donation</button>
          </div>
        </li>

      </ul>

      @if($availableDonations->count() > 0)
        <ul>
          @foreach($availableDonations as $donation)
            <li>
              <div class="card">
                <h3>{{ $donation->type }} Donation</h3>
                <p>Location: {{ $donation->location }}</p>
                <p>Date: {{ $donation->date }}</p>
                <p>Time: {{ $donation->time }}</p>
                <p>Description: {{ $donation->description }}</p>
                <form action="{{ route('volunteer.donations.reserve', $donation) }}" method="POST">
                  @csrf
                  <button type="submit" class="button">Reserve Donation</button>
                </form>
              </div>
            </li>
          @endforeach
        </ul>
      @else
        <p>No available donations at the moment.</p>
      @endif

    </section>

    <section id="tasks">
      <h2>Tasks</h2>
      <ul>
        <li>
          <div class="card">
            <h3> Donation title</h3>
            <p>location:      time:    </p>
            <button class="button" onclick="">Completed</button>
          </div>
        </li>

        <li>
          <div class="card">
            <h3> Donation 2 title</h3>
            <p>location:      time:    </p>
            <button class="button" onclick="">Completed</button>
          </div>
        </li>

      </ul>

       @if($assignedDonations->count() > 0)
        <ul>
          @foreach($assignedDonations as $donation)
            <li>
              <div class="card">
                <h3>{{ $donation->type }} Donation</h3>
                <p>Location: {{ $donation->location }}</p>
                <p>Date: {{ $donation->date }}</p>
                <p>Time: {{ $donation->time }}</p>
                <p>Description: {{ $donation->description }}</p>
                <form action="{{ route('volunteer.donations.complete', $donation) }}" method="POST">
                  @csrf
                  <input type="hidden" name="status" value="collected">
                  <button type="submit" class="button">Mark as Completed</button>
                </form>
              </div>
            </li>
          @endforeach
        </ul>
      @else
        <p>No assigned tasks at the moment.</p>
      @endif

    </section>

    <section id="archive">

      <h3>Past Contributions</h3>
      <ul>
        <li>
          <div class="card">
            <h3> Donation 2 title</h3>
            <p>location:      time:    </p>
          </div>
        </li>

        <li>Volunteered for food distribution - February 2025</li>

        <li>Assisted with donation organization - January 2025</li>

        <li>
          <div class="card">
            <h3> Donation 2 title</h3>
            <p>location:      time:    </p>
          </div>
        </li>

        <li>
          <div class="card">
            <h3> Donation 2 title</h3>
            <p>location:      time:    </p>
          </div>
        </li>

        <li>
          <div class="card">
            <h3> Donation 2 title</h3>
            <p>location:      time:    </p>
          </div>
        </li>
      </ul>

      
      @if($completedDonations->count() > 0)
        <ul>
          @foreach($completedDonations as $donation)
            <li>
              <div class="card">
                <h3>{{ $donation->type }} Donation</h3>
                <p>Location: {{ $donation->location }}</p>
                <p>Date: {{ $donation->date }}</p>
                <p>Time: {{ $donation->time }}</p>
                <p>Description: {{ $donation->description }}</p>
                <p>Status: {{ $donation->status }}</p>
              </div>
            </li>
          @endforeach
        </ul>
      @else
        <p>No completed donations yet.</p>
      @endif
    </section>
  </main>
  <footer>
    <p>&copy; 2025 Nahej Ali Organization</p>
  </footer>
</body>
</html>