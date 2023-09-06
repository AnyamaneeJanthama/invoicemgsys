<?php
if (isset($_GET['act'])) // ตรวจสอบว่ามีการส่งค่า พารามิเตอร์ที่ชื่อ act หรือไม่
{
    if ($_GET['act'] == 'excel') // ตรวจสอบว่าพารามิเตอร์ act มีค่าคือ excel หรือไม่
    {
        header("Content-Type: application/vnd.ms-excel");
        header('Content-Disposition: attachment; filename="filename.xls"'); #ก ําหนดชื่อไฟล์
        echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"xmlns:x="urn:schemas-microsoft-com:office:excel"';
        set_time_limit(0);
        // header('Content-Type: text/html; charset=utf-8');
    }
}
// Connect to the database
$mysqli = new mysqli("localhost", "root", "", "invoicemgsys");

// output any connection error
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
// the query
$query = "SELECT * FROM products WHERE void = 0";
// mysqli select query
$results = $mysqli->query($query);

include('header.php');
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
                    <div class="content-header">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active"><a href="product.php" class="text-decolation">Product</a>
                            </li>
                            <!-- <li class="breadcrumb-item">Manage Users</li> -->
                        </ol>
                    </div>

                    <div class="row">
                        <div class="col-12 order-2 order-md-3 order-lg-2 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-4">
                                            <a href="frm_product.php?pCase=1" class="btn btn-primary"><i class="fa-solid fa-plus me-2"></i>Add Product</a>
                                        </div>
                                        <div class="col-8 text-end">
                                            <a href="?act=excel" class="btn btn-success mx-3"> Export to Excel </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <?php
                                    // mysqli select query
                                    if ($results) {
                                        echo '<table id="myTable" class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Description</th>
                                                <th>Price</th>
                                                <th ></th>
                                            </tr>
                                        </thead>';
                                        while ($row = $results->fetch_assoc()) {
                                            echo '
                                        <tbody>
                                            <tr>
                                                <td>' . $row["product_name"] . '</td>
                                                <td>' . $row["product_desc"] . '</td>
                                                <td>' . $row["product_price"] . '</td>
                                                <td class="text-center">
                                                    <a href="frm_product.php?pCase=2&product_id=' . $row["product_id"] . '"
                                                        name="btn_edit" class="btn btn-warning edit_sale mx-2"><i
                                                            class="tf-icons bx bx-edit"></i></a>
                                                    <a href="frm_product.php?pCase=3&product_id=' . $row["product_id"] . '"
                                                        name="btn_delete" class="btn btn-danger mx-2"><i
                                                            class="tf-icons bx bx-trash"></i></a>
                                                </td>
                                            </tr>    
                                        </tbody>';
                                        }
                                        echo '</table>';
                                    } else {
                                        echo "<p>There are no invoices to display.</p>";
                                    }
                                    $results->free();
                                    $mysqli->close();
                                    ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
</script>


<!-- Footer -->
<?php include("footer.php"); ?>
<!-- / Footer -->