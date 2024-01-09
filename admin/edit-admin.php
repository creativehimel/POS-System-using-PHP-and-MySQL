<?php include('includes/header.php') ?>

<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">
    <!-- Sidebar -->
    <?php include('includes/sidebar.php') ?>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <?php include('includes/navbar.php') ?>
            <!-- End of Topbar -->
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h5 class="h5 mb-0 text-gray-800">Dashboard / Admin / Edit Admin</h5>
                </div>
                <!-- Content Row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-2 shadow">
                            <div class="card-header">
                                <h4 class="mb-0 d-flex justify-content-between align-items-center">Edit Admin
                                    <a href="admin.php" class="btn btn-danger btn-sm"><i
                                                class="fas fa-chevron-left mr-2"></i>Back</a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <?php alertMessage(); ?>
                                <form action="code.php" method="POST">
                                    <?php
                                    if(isset($_GET['id'])){
                                        if($_GET['id'] != ''){
                                            $adminId = $_GET['id'];
                                        }else{
                                            echo '<h5>ID not found!</h5>';
                                            return false;
                                        }
                                    }else{
                                        echo '<h5>No ID given in params!</h5>';
                                        return false;
                                    }
                                    $adminRecord = getRecordById('admins',$adminId);
                                    if($adminRecord){
                                        if($adminRecord['status'] == 200){
                                            ?>
                                            <input type="hidden" name="id" value="<?php echo $adminRecord['data']['id']; ?>">
                                            <div class="row d-flex">
                                                <div class="col-md-6 mb-3">
                                                    <label for="name">Name <span class="text-danger">*</span></label>
                                                    <input type="text" name="name"
                                                           value="<?php echo $adminRecord['data']['name'] ?>"
                                                           class="form-control" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="name">Email <span class="text-danger">*</span></label>
                                                    <input type="email" name="email"
                                                           value="<?php echo $adminRecord['data']['email'] ?>"
                                                           class="form-control" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="name">Password</label>
                                                    <input type="password" name="password" class="form-control">
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="name">Phone Number</label>
                                                    <input type="text" name="phone"
                                                           value="<?php echo $adminRecord['data']['phone'] ?>"
                                                           class="form-control" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="name">Status</label>
                                                    <select name="status" class="form-select form-select-sm form-control"
                                                            aria-label="Default select example">
                                                        <option selected disabled>Select User Status</option>
                                                        <option value="1"
                                                            <?php echo $adminRecord['data']['status'] == 1 ? 'selected' : '' ?> >
                                                            Active
                                                        </option>
                                                        <option value="0" <?php echo $adminRecord['data']['status'] == 0 ? 'selected' : '' ?> >Inactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <button type="submit" name="updateAdmin"
                                                    class="btn btn-primary my-2">Update</button>
                                            <?php
                                        }else
                                        {
                                            echo '<h5>'.$adminRecord['message'].'</h5>';
                                        }
                                    }else{
                                        echo '<h5>Something went wrong</h5>';
                                        return false;
                                    }
                                    ?>


                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
        <!-- Footer -->
        <?php include('includes/footer.php') ?>
        <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->
<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<?php include('includes/script.php') ?>
</body>

</html>