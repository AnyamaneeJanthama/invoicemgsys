<?php
include("header.php");

$case = $_GET['xCase'];
if ($case == '1') {
    $header = 'Add';
    $id = '';
} else if ($case  == '2') {
    $header = 'Edit';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id ='$id' ");
    $row = mysqli_fetch_array($result);
    // print_r(md5($row['password']));
} else if ($case  == '3') {
    $header = 'Delete';
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id ='$id' ");
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
                            <li class="breadcrumb-item active"><a href="magUsers.php" class="text-decolation">System
                                    User</a>
                            </li>
                            <!-- <li class="breadcrumb-item active"><a href="magUsers.php" class="text-decolation">Manage
                                    User</a></li> -->
                            <li class="breadcrumb-item"><?php echo $header; ?> User</li>
                        </ol>
                    </div>
                    <!-- /.content-header -->
                    <div class="row">
                        <div class="col-12 order-2 order-md-3 order-lg-2 mb-4">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h3><?php echo $header; ?> User</h3>
                                </div>
                                <div class="card-body">
                                    <form id="formAccountSettings" action="../../API/api.php?xCase=<?php echo $case ?>&id=<?php echo $id ?>" method="POST">
                                        <div class="row">
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo ($case == 1) ? '' : $row['name'] ?>" <?php echo ($case == '3') ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="username" class="form-label">Username</label>
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Enter username" value="<?php echo ($case == 1) ? '' : $row['username'] ?>" <?php echo ($case == '3') ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter user's email address" value="<?php echo ($case == 1) ? '' : $row['email'] ?>" <?php echo ($case == '3') ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter user's phone number" value="<?php echo ($case == 1) ? '' : $row['phone'] ?>" <?php echo ($case == '3') ? 'readonly' : 'required' ?>>
                                            </div>
                                            <div class="mb-2 col-lg-4 col-md-6 col-ms-12">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="text" class="form-control" name="password" id="password" placeholder="<?php echo ($case == 2) ? "Enter user's new password, if left it empty it won't change" : "Enter user's password" ?>" value="<?php echo ($case == 3) ? $row['password'] : '' ?>" <?php echo ($case == '3') ? 'readonly' : (($case == '2') ? '' : 'required') ?>>
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
                                            <a href="magUsers.php" class="btn btn-secondary ms-3">Cancel</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--/ Total Revenue -->
                    </div>
                </div>
                <!-- / Content -->

                <script>
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
                </script>

                <!-- Footer -->
                <?php include("footer.php"); ?>
                <!-- / Footer -->