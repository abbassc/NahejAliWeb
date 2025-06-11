<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Volunteers</title>
    <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
</head>
<body>
    <header>
        <h1>Manage Volunteers</h1>
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="btn">Back to Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="volunteers-list">
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
                    @foreach($volunteers as $volunteer)
                        <tr>
                            <td>{{ $volunteer->name }}</td>
                            <td>{{ $volunteer->email }}</td>
                            <td>{{ $volunteer->volunteer->phone ?? 'N/A' }}</td>
                            <td>{{ $volunteer->volunteer->location ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.volunteers.edit', $volunteer->id) }}" class="btn">Edit</a>
                                <form action="{{ route('admin.volunteers.delete', $volunteer->id) }}" method="POST" style="display: inline; background: none; border: none; padding: 0; margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this volunteer?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $volunteers->links() }}
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Nahej Ali Organization</p>
    </footer>
</body>
</html> 