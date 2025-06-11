<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Volunteer</title>
    <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
</head>
<body>
    <header>
        <h1>Add New Volunteer</h1>
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">Back to Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="form-section">
            <form action="{{ route('admin.volunteers.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" required>
                </div>

                <div class="form-group">
                    <label for="availability">Availability:</label>
                    <select id="availability" name="availability" required>
                        <option value="Week-end">Week-end</option>
                        <option value="all-week">7 days</option>
                    </select>
                </div>

                <button type="submit" class="btn">Add Volunteer</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Nahej Ali Organization</p>
    </footer>
</body>
</html> 