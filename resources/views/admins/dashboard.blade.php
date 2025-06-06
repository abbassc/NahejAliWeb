@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Page</title>
  <link rel="stylesheet" href="{{asset('../css/styles.css')}}">
  <script src="{{ asset('js/script.js') }}"></script>
  </head>
<body>
  <header>
    <h1>Admin Page</h1>
    <nav>
      <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="#dashboard">Dashboard</a></li>
        <li><a href="#panel">Panel</a></li>
        <li><a href="#families">Families</a></li>
        <li><a href="#report">Reports</a></li>
      </ul>
    </nav>
  </header>
  <main>

    <div class="dashboard" id="dashboard">
      <h1>Dashboard</h1>

      <section id="donations">
        <h2>New Donations</h2>

        <ul>

          <li>
            <div class="card">
              <h3> Donation title</h3>
              <p>location:      time:    </p>
              <button class="button" onclick="">Assign to</button>
            </div>
          </li>

          <li>
            <div class="card">
              <h3> Donation 2 title</h3>
              <p>location:      time:    </p>
              <button class="button" onclick="">Assign to</button>
            </div>
          </li>

      </ul>
      </section>

      <section id="volunteers">
        <h2>Volunteers</h2>
        <table>
          <thead>
            <tr>
              <th>Volunteer Name</th>
              <th>Location</th>
              <th>Availability</th>
              <th>Phone</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </section>

      <section id="families">
        <h2>Families</h2>
        <table>
          <thead>
            <tr>
              <th>Family Name</th>
              <th>Location</th>
              <th>Status</th>
              <th>Phone</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>

            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </section>


      <div class="card">
        <h3>إحصائيات التبرعات</h3>
        <p>إجمالي التبرعات: 1000 دولار</p>
        <button class="button">عرض التفاصيل</button>
      </div>

      <div class="card">
        <h3>إحصائيات العائلات</h3>
        <p>إجمالي العائلات المستفيدة: 50 عائلة</p>
        <button class="button">عرض التفاصيل</button>
      </div>

      <div class="card">
        <h3>إحصائيات المتطوعين</h3>
        <p>إجمالي المتطوعين: 30 متطوع</p>
        <button class="button">عرض التفاصيل</button>
      </div>
    </div>

    <section class="mainandsidebar" id="panel">
      <!-- Sidebar -->
      <div class="sidebar">
        <h2>Admin Panel</h2>
        <a href="#system-management">System Management</a>
        <a href="#manage-users">Manage Users</a>
        <a href="#assign-volunteers">Assign Volunteers</a>
        <a href="#generate-reports">Generate Reports</a>
      </div>

      <!-- Main Content -->
      <div class="main-content">

        <!-- System Management -->
        <div id="system-management" class="section">
          <h3>System Management</h3>
          <p>Configure system settings, permissions, security options.</p>
          <button class="button">Edit Settings</button>
        </div>

        <!-- Manage Users  -->
        <div id="manage-users" class="section">
          <h3>Manage Users</h3>
          <p>Add, update, or remove users and assign roles</p>
          <button class="button">Manage Users</button>
        </div>

        <!-- Assign Volunteers -->
        <div id="assign-volunteers" class="section">
          <h3>Assign Volunteers</h3>
          <p>Assign volunteers to tasks, centers, or events.</p>
          <button class="button">Assign Volunteers</button>
        </div>

        <!-- Generate Reports  -->
        <div id="generate-reports" class="section">
          <h3>Generate Reports</h3>
          <p>Produce reports on donations, families, and volunteer activity.</p>
          <button class="button">Generate Reports</button>
        </div>
      </div>
    </section>

    <section id="families">
      <h2>Family List</h2>
      <table>
        <tr><th>Family Name</th><th>Members</th><th>Area</th></tr>
        <tr><td>Khalil</td><td>5</td><td>Haret Hreik</td></tr>
        <tr><td>Mohsen</td><td>6</td><td>Corniche</td></tr>
      </table>
    </section>

    <section id="report">
      <h2>Donations Report</h2>
      <table>
        <tr>
          <th>Donation Type</th>
          <th>Amount</th>
          <th>Date</th>
        </tr>
        <tr>
          <td>Money</td>
          <td>$500</td>
          <td>March 2025</td>
        </tr>
        <tr>
          <td>Food</td>
          <td>200 kg</td>
          <td>February 2025</td>
        </tr>
      </table>

      <h3>Funds Distribution</h3>
      <ul>
        <li>50% of funds allocated to food distribution</li>
        <li>30% allocated to family support</li>
        <li>20% allocated to administrative costs</li>
      </ul>
    </section>

  </main>
  <footer>
    <p>&copy; 2025 Nahej Ali Organization</p>
  </footer>
</body>
</html>
