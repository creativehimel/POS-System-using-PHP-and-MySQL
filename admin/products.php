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
                        <h5 class="h6 mb-0 text-gray-800">Dashboard / Products</h5>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mt-2 shadow">
                                <div class="card-header">
                                    <h5 class="mb-0 d-flex justify-content-between align-items-center">All Products
                                        <a href="create-products.php" class="btn btn-primary btn-sm"><i
                                                class="fas fa-user-plus mr-2"></i>Add Product</a>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <?php alertMessage(); ?>
                                    
                                        <?php
                                            $products = getAllRecord('products', '');
                                            if(!$products){
                                                echo '<h4>Something went wrong!</h4>';
                                                return false;
                                            }
                                            if(mysqli_num_rows($products) > 0){
                                                ?>
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered text-center">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Name</th>
                                                                <th>Image</th>
                                                                <th>Price</th>
                                                                <th>Quantity</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                <?php
                                                    foreach($products as $product){
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $product['id'] ?></td>
                                                            <td><?php echo $product['name'] ?></td>
                                                            <td>
                                                                <img src="../<?php echo $product['image'] ?>" style="width:50px; height:50px;" alt="Product Image">
                                                                
                                                            </td>
                                                            
                                                            <td><?php echo $product['price'] ?></td>
                                                            <td><?php echo $product['quantity'] ?></td>
                                                            <td><?php
                                                            if($product['status'] == 1){
                                                                echo '<span class="badge bg-success text-white">Active</span>';
                                                            }else{
                                                                echo '<span class="badge bg-danger text-white">Inactive</span>';
                                                            }
                                                            ?>
                                                            </td>
                                                            <td>
                                                                <a href="edit-products.php?id=<?php echo $product['id']; ?>"
                                                                    class="btn btn-primary btn-sm">Edit</a>
                                                                <a href="delete-products.php?id=<?php echo $product['id']; ?>"
                                                                    class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Are you sure you want to delete this product!')"
                                                                    >Delete</a>
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
                                                <td colspan="2" >
                                                    <p class="text-center mb-0">No record found.</p>
                                                </td>
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