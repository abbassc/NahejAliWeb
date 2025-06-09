<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Reports</title>
    <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
</head>
<body>
    <header>
        <h1>Donation Reports</h1>
        <nav>
            <ul>
                <li><a href="{{ route('admin.dashboard') }}">Back to Dashboard</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="stats-container">
            <div class="card">
                <h3>Overall Statistics</h3>
                <p>Total Donations: {{ $totalDonations }}</p>
                <p>Completed Donations: {{ $completedDonations }}</p>
                <p>Pending Donations: {{ $pendingDonations }}</p>
                <p>Assigned Donations: {{ $assignedDonations }}</p>
            </div>

            <div class="card">
                <h3>Donations by Category</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donationsByCategory as $category)
                            <tr>
                                <td>{{ ucfirst($category->category) }}</td>
                                <td>{{ $category->count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card">
                <h3>Donations by Month ({{ date('Y') }})</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($donationsByMonth as $month)
                            <tr>
                                <td>{{ date('F', mktime(0, 0, 0, $month->month, 1)) }}</td>
                                <td>{{ $month->count }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Nahej Ali Organization</p>
    </footer>
</body>
</html> 