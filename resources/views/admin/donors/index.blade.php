<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Donors</title>
    <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
</head>
<body>
    <header>
        <h1>Manage Donors</h1>
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="btn">Back to Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="donors-list">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donors as $donor)
                        <tr>
                            <td>{{ $donor->name }}</td>
                            <td>{{ $donor->email }}</td>
                            <td>{{ $donor->donor->phone ?? 'N/A' }}</td>
                            <td>{{ $donor->donor->location ?? 'N/A' }}</td>
                            <td>
                                <form action="{{ route('admin.donors.delete', $donor->id) }}" method="POST" style="display: inline; background: none; border: none; padding: 0; margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this donor?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Nahej Ali Organization</p>
    </footer>
</body>
</html> 