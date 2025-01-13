<?php
require_once '../model/db_connect.php';

$result = mysqli_query($conn, "SELECT * FROM employee");

while ($employee = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$employee['name']}</td>
            <td>{$employee['contact_no']}</td>
            <td>{$employee['username']}</td>
            <td><button onclick='deleteEmployee(\"{$employee['username']}\")'>Delete</button></td>
        </tr>";
}
?>
