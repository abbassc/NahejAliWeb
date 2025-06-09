<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Family</title>
    <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
</head>
<body>
    <header>
        <h1>Add New Family</h1>
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">Back to Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="form-container">
            <form action="{{ route('admin.families.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Family Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="members">Number of Members:</label>
                    <input type="number" id="members" name="members" min="1" required>
                </div>

                <button type="submit" class="btn btn-primary">Add Family</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Nahej Ali Organization</p>
    </footer>
</body>
</html> 