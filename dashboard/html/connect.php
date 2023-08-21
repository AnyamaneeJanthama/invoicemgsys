<?php
$conn = mysqli_connect("localhost", "root", "") or die("ไม่สามารถเชื่อมต่อฐานเข้ามูลได้");
mysqli_select_db($conn, "invoicemgsys") or die("ไม่พบฐานข้อมูล");
mysqli_query($conn, "SET NAMES UTF8");
?>

<?php
// $host = "localhost"; /* Host name */
// $user = "root"; /* User */
// $password = ""; /* Password */
// $dbname = "cit6001"; /* Database name */

// $conn = mysqli_connect($host, $user, $password, $dbname);
// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// }