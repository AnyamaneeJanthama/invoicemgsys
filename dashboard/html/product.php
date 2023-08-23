<?php
include("connect.php");
$data = mysqli_query($conn, "select * from products WHERE void = 0 ORDER BY product_id");

include("header.php");
?>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

        <!-- Menu -->
        <?php include("sidebar.php") ?>
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
                            <!-- <li class="breadcrumb-item">Manage Users</li> -->
                        </ol>
                    </div>
                    <!-- /.content-header -->
                    <div class="row">
                        <div class="col-12 order-2 order-md-3 order-lg-2 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <a href="frm_product.php?pCase=1" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Add Product</a>
                                </div>
                                <div class="card-body">
                                    <table id="myTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th class="text-center" style="width: 140px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (mysqli_num_rows($data) > 0) {
                                                while ($row = mysqli_fetch_assoc($data)) {
                                            ?>
                                                    <tr>
                                                        <th><?php echo $row['product_name']; ?></th>
                                                        <td><?php echo $row['product_desc']; ?></td>
                                                        <td><?php echo $row['product_price']; ?></td>
                                                        <td>
                                                            <a href="frm_product.php?pCase=2&product_id=<?php echo $row['product_id'] ?>" name="btn_edit" class="btn btn-warning edit_sale"><i class="tf-icons bx bx-edit"></i></a>
                                                            <a href="frm_product.php?pCase=3&product_id=<?php echo $row['product_id'] ?>" name="btn_delete" class="btn btn-danger"><i class="tf-icons bx bx-trash"></i></a>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!--/ Total Revenue -->
                    </div>
                </div>
            </div>
            <!-- / Content -->
            <script>
                $.extend(true, $.fn.dataTable.defaults, {
                    "lengthMenu": [
                        [10, 15, 20],
                        [10, 15, 20],
                    ],
                });
                $('#myTable').DataTable({
                    order: [
                        [0, 'desc']
                    ]
                });
            </script>

            <!-- Footer -->
            <?php include("footer.php"); ?>
            <!-- / Footer -->