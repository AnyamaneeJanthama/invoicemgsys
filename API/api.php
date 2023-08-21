<?php

use Mpdf\Tag\Select;

include("connect.php");

$case = $_GET['xCase'];
$id = $_GET['id'];
switch ($case) {
    case 1:
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = md5($_POST['password']);
        $maxID = mysqli_query($conn, "SELECT MAX(id) AS id FROM users ORDER BY id");
        if (mysqli_num_rows($maxID) > 0) {
            while ($row = mysqli_fetch_assoc($maxID)) {
                $id = $row['id'] + 1;
            }
        }

        $spl = mysqli_query($conn, "INSERT INTO users VALUES ('$id','$name','$username','$email','$phone','$password','0')");
        if (!$spl) {
            echo json_encode(array('title' => 'Unsuccessfully!', 'status' => 'error', 'message' => 'Inserted data is not success.'));
        } else {
            echo json_encode(array('title' => 'Successfully!', 'status' => 'success', 'message' => 'Inserted data is successfully.'));
        }

        break;
    case 2:
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        if ($_POST['password'] == '') {
            $pass = mysqli_query($conn, "SELECT * from users WHERE id = $id");
            $p = mysqli_fetch_assoc($pass);
            $password = $p['password'];
        } else {
            $password = md5($_POST['password']);
        }

        $spl = mysqli_query($conn, "UPDATE users SET name = '$name', username = '$username',email = '$email',phone = '$phone',password = '$password' Where id = $id");
        if (!$spl) {
            echo mysqli_error($conn);
        } else {
            echo "Records added successfully.";
            header('Location: ../dashboard/html/magUsers.php');
        }

        break;
    case 3:
        $id = $_GET['id'];
        $spl = mysqli_query($conn, "UPDATE users SET void = '1' Where id = $id");
        if (!$spl) {
            echo mysqli_error($conn);
        } else {
            echo "Records added successfully.";
            header('Location: ../dashboard/html/magUsers.php');
        }

        break;
}
