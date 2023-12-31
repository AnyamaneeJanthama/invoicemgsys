<?php
include("header.php");

$case = $_GET['pCase'];
if ($case == '1') {
    $header = 'Add';
    $product_id = '';
} else if ($case  == '2') {
    $header = 'Edit';
    $product_id = $_GET['product_id'];
    $result = mysqli_query($conn, "SELECT * FROM products WHERE product_id ='$product_id' ");
    $row = mysqli_fetch_array($result);
} else if ($case  == '3') {
    $header = 'Delete';
    $product_id = $_GET['product_id'];
    $result = mysqli_query($conn, "SELECT * FROM products WHERE product_id ='$product_id' ");
    $row = mysqli_fetch_array($result);
}

?>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <!-- Menu -->
        <?php include("sidebar.php"); ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->
            <?php include("topbar.php"); ?>
            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="product.php" class="text-decolation">Product</a>
                            </li>
                            <!-- <li class="breadcrumb-item active"><a href="product.php" class="text-decolation">Manage
                                    User</a></li> -->
                            <li class="breadcrumb-item"><?php echo $header; ?> Product</li>
                        </ol>
                    </div>
                    <!-- /.content-header -->
                    <div class="row">
                        <div class="col-12 order-2 order-md-3 order-lg-2 mb-4">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h3><?php echo $header; ?> Product</h3>
                                </div>
                                <div class="card-body">
                                    <form id="formAccountSettings" action="../../API/apiproduct.php?pCase=<?php echo $case ?>&product_id=<?php echo $product_id ?>" method="POST">
                                        <div class="row">
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="product_name" class="form-label">Product</label>
                                                <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter product name" value="<?php echo ($case == 1) ? '' : $row['product_name'] ?>" <?php echo ($case == '3') ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="product_desc" class="form-label">Description</label>
                                                <input type="text" class="form-control" name="product_desc" id="product_desc" placeholder="Enter Product description" value="<?php echo ($case == 1) ? '' : $row['product_desc'] ?>" <?php echo ($case == '3') ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="product_price" class="form-label">Price</label>
                                                <input type="int" class="form-control" name="product_price" id="product_price" placeholder="0.00" value="<?php echo ($case == 1) ? '' : $row['product_price'] ?>" <?php echo ($case == '3') ? 'readonly' : 'required' ?>>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <?php
                                            echo ($case == '1') ?
                                                '<button type="submit" name="submit_frm" class="btn btn-success">Save</button> ' : (($case == '2') ?
                                                    '<button type="submit" name="submit_frm" class="btn btn-warning">Edit</button>' : (($case == '3') ?
                                                        '<button type="submit" name="submit_frm" class="btn btn-danger">Delete</button>' : ''))
                                            ?>
                                            <!-- <button type="submit" name="submit" class="btn btn-success">บันทึก</button> -->
                                            <a href="product.php" class="btn btn-secondary ms-3">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--/ Total Revenue -->
                    </div>
                </div>
                <!-- / Content -->

                <!-- <script>
                    $(document).ready(function() {
                        $("#formAccountSettings").submit(function(e) {
                            e.preventDefault();

                            let formUrl = $(this).attr("action");
                            let reqMethod = $(this).attr("method");
                            let formData = $(this).serialize();

                            $.ajax({
                                url: formUrl,
                                type: reqMethod,
                                data: formData,
                                success: function(data) {
                                    // console.log("Success", data);
                                    let result = JSON.parse(data);

                                    if (result.status == "success") {
                                        // console.log("Success", result);
                                        Swal.fire({
                                            icon: result.status,
                                            title: result.title,
                                            text: result.message,
                                            showConfirmButton: false,
                                            timer: 2500
                                        }).then(function() {
                                            window.location.href = "magUsers.php";
                                        });
                                    } else {
                                        Swal.fire(result.title, result.message, result
                                            .status)
                                    }
                                }
                            })
                        })
                    })
                </script> -->

                <!-- Footer -->
                <?php include("footer.php"); ?>
                <!-- / Footer -->