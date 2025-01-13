<?php
session_start();
if (!isset($_SESSION['admin_username'])) {
    header('Location: index.html');  // Redirect to login if not logged in
}

require_once '../model/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Admin Dashboard</h1>

    <h2>Manage Employees</h2>
    <table id="employee-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Contact No</th>
                <th>Username</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Employee rows will be dynamically populated here -->
        </tbody>
    </table>

    <script>
        // Fetch and display employee data on page load
        window.onload = function() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'fetch_employees.php', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById('employee-table').getElementsByTagName('tbody')[0].innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        };

        function deleteEmployee(username) {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'delete_employee.php?username=' + username, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    location.reload();  // Reload the page to reflect the changes
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>
