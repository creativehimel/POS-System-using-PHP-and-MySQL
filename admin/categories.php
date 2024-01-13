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
                        <h5 class="h5 mb-0 text-gray-800">Dashboard / Categories</h5>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mt-2 shadow">
                                <div class="card-header">
                                    <h4 class="mb-0 d-flex justify-content-between align-items-center">All Categories
                                        <a href="create-categories.php" class="btn btn-primary btn-sm"><i
                                                class="fas fa-user-plus mr-2"></i>Add Category</a>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <?php alertMessage(); ?>
                                    
                                        <?php
                                            $categories = getAllRecord('categories', '');
                                            if(!$categories){
                                                echo '<h4>Something went wrong!</h4>';
                                                return false;
                                            }
                                            if(mysqli_num_rows($categories) > 0){
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Name</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                <?php
                                                    foreach($categories as $category){
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $category['id'] ?></td>
                                                            <td><?php echo $category['name'] ?></td>
                                                            <td><?php
                                                            if($category['status'] == 1){
                                                                echo '<span class="badge bg-success text-white">Active</span>';
                                                            }else{
                                                                echo '<span class="badge bg-danger text-white">Inactive</span>';
                                                            }
                                                            ?>
                                                            </td>
                                                            <td>
                                                                <a href="edit-categories.php?id=<?php echo $category['id']; ?>"
                                                                    class="btn btn-primary btn-sm">Edit</a>
                                                                <a href="delete-categories.php?id=<?php echo $category['id']; ?>"
                                                                    class="btn btn-danger btn-sm">Delete</a>
                                                            </td>
                                                        </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php 
                                        }else{
                                            ?>
                                            <tr>
                                                <td colspan="4">No record found.</td>
                                            </tr>
                                        <?php
                                        } ?>
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