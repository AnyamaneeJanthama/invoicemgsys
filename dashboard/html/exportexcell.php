<?php


if (isset($_GET['act'])) // ตรวจสอบว่ามีการส่งค่า พารามิเตอร์ที่ชื่อ act หรือไม่
{
    if ($_GET['act'] == 'excel') // ตรวจสอบว่าพารามิเตอร์ act มีค่าคือ excel หรือไม่
    {
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="filename.xls"'); #ก ําหนดชื่อไฟล์
        echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"';
        set_time_limit(0);
        header('Content-Type: text/html; charset=utf-8');
    }
}
// Connect to the database
$mysqli = new mysqli("localhost", "root", "", "invoicemgsys");

// output any connection error
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
// the query
$query = "SELECT * FROM invoices i JOIN customers c ON c.invoice = i.invoice WHERE i.invoice = c.invoice ORDER BY i.invoice";
// mysqli select query
$results = $mysqli->query($query);
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <title>ตัวอย่ํางกําร ส่งข้อมูลออกไปเป็น Excel ไฟล์</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>

<body>
    <p> <a href="?act=excel" class="btn btn-primary"> Excel </a> </p>
    <?php
    // mysqli select query
    if ($results) {
        echo '<table><tr>

<td>Invoice</td>
<td>Customer</td>
<td>Issue Date</td>
<td>Due Date</td>
<td>Type</td>
<td>Status</td>
</tr>';
        while ($row = $results->fetch_assoc()) {
            echo '
<tr>
<td>' . $row["invoice"] . '</td>
<td>' . $row["name"] . '</td>
<td>' . $row["invoice_date"] . '</td>
<td>' . $row["invoice_due_date"] . '</td>
<td>' . $row["invoice_type"] . '</td>
';
            if ($row['status'] == "open") {
                echo '<td><span class="label label-primary">' . $row['status'] . '</span></td>';
            } elseif ($row['status'] == "paid") {
                echo '<td><span class="label label-success">' . $row['status'] . '</span></td>';
            }
            echo '</tr>';
        }
        echo '</tr></table>';
    } else {
        echo "<p>There are no invoices to display.</p>";
    }
    $results->free();
    $mysqli->close();
    ?>
</body>

</html>