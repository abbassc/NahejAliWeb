<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Families</title>
    <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
</head>
<body>
    <header>
        <h1>Manage Families</h1>
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" class="btn">Back to Dashboard</a></li>
                <li><a href="{{ route('admin.families.add') }}" class="btn">Add New Family</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="families-list">
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Phone</th>
                        <th>Members</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($families as $family)
                        <tr>
                            <td>{{ $family->name }}</td>
                            <td>{{ $family->location }}</td>
                            <td>{{ $family->phone }}</td>
                            <td>{{ $family->members }}</td>
                            <td>
                                <a href="{{ route('admin.families.edit', $family->id) }}" class="btn">Edit</a>
                                <form action="{{ route('admin.families.delete', $family->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" onclick="return confirm('Are you sure you want to delete this family?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $families->links() }}
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Nahej Ali Organization</p>
    </footer>
</body>
</html> 