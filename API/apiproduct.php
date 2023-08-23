<?php

include("connect.php");

$case = $_GET['pCase'];
$product_id = $_GET['product_id'];
switch ($case) {
    case 1:
        $product_name = $_POST['product_name'];
        $product_desc = $_POST['product_desc'];
        $product_price = $_POST['product_price'];
        $maxID = mysqli_query($conn, "SELECT MAX(product_id) AS product_id FROM products ORDER BY product_id");
        if (mysqli_num_rows($maxID) > 0) {
            while ($row = mysqli_fetch_assoc($maxID)) {
                $product_id = $row['product_id'] + 1;
            }
        }

        $spl = mysqli_query($conn, "INSERT INTO products VALUES ('$product_id','$product_name','$product_desc','$product_price','0')");
        if (!$spl) {
            echo mysqli_error($conn);
        } else {
            echo "Records added successfully.";
            header('Location: ../dashboard/html/product.php');
        }

        break;
    case 2:
        $product_name = $_POST['product_name'];
        $product_desc = $_POST['product_desc'];
        $product_price = $_POST['product_price'];

        $spl = mysqli_query($conn, "UPDATE products SET product_name = '$product_name', product_desc = '$product_desc',product_price = '$product_price' Where product_id = $product_id");
        if (!$spl) {
            echo mysqli_error($conn);
        } else {
            echo "Records edited successfully.";
            header('Location: ../dashboard/html/product.php');
        }

        break;
    case 3:
        $product_id = $_GET['product_id'];
        $spl = mysqli_query($conn, "UPDATE products SET void = '1' Where product_id = $product_id");
        if (!$spl) {
            echo mysqli_error($conn);
        } else {
            echo "Records deleted successfully.";
            header('Location: ../dashboard/html/product.php');
        }

        break;
}
