<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Donations</title>
    <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
</head>
<body>
    <header>
        <h1>Manage Donations</h1>
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}" >Back to Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="donations-list">
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Donor</th>
                        <th>Volunteer</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($donations as $donation)
                        <tr>
                            <td>{{ $donation->title }}</td>
                            <td>{{ ucfirst($donation->category) }}</td>
                            <td>{{ $donation->amount }}</td>
                            <td>{{ $donation->donor->name ?? 'N/A' }}</td>
                            <td>{{ $donation->volunteer->name ?? 'Not Assigned' }}</td>
                            <td>{{ ucfirst($donation->status) }}</td>
                            <td>{{ $donation->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if($donation->status === 'pending')
                                    <form action="{{ route('admin.donations.assign', $donation->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn">Assign</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $donations->links() }}
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Nahej Ali Organization</p>
    </footer>
</body>
</html> 