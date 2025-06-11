<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Family</title>
    <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
</head>
<body>
    <header>
        <h1>Edit Family</h1>
        <nav>
            <ul>
                <li><a href="{{ route('admin.families.index') }}" class="btn">Back to Families</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="edit-form">
            <form action="{{ route('admin.families.update', $family->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $family->name) }}" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" value="{{ old('location', $family->location) }}" required>
                    @error('location')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone', $family->phone) }}" required>
                    @error('phone')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="members">Number of Members:</label>
                    <input type="number" id="members" name="members" value="{{ old('members', $family->members) }}" min="1" required>
                    @error('members')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn">Update Family</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Nahej Ali Organization</p>
    </footer>
</body>
</html> 