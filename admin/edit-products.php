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
                        <h5 class="h6 mb-0 text-gray-800">Dashboard / Products / Edit Product</h5>
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mt-2 shadow">
                                <div class="card-header">
                                    <h5 class="mb-0 d-flex justify-content-between align-items-center">Edit Product
                                        <a href="products.php" class="btn btn-danger btn-sm"><i
                                                class="fas fa-chevron-left mr-2"></i>Back</a>
                                    </h5>
                                </div>
                                
                                <div class="card-body">
                                    <?php alertMessage(); ?>
                                    <form action="code.php" method="POST" enctype="multipart/form-data">
                                        <?php
                                            $paramId = checkParam('id');
                                            if(!is_numeric($paramId)){
                                                echo '<h5>'.$paramId.'</h5>';
                                                return false;
                                            }
                                            $productRecord = getRecordById('products',$paramId);
                                            if($productRecord){
                                            if($productRecord['status'] == 200){
                                        ?>
                                        <input type="hidden" name="id" value="<?php echo $productRecord['data']['id']; ?>">
                                        <div class="row d-flex">
                                            <div class="col-md-6 mb-3">
                                                <label for="name">Product Name <span class="text-danger">*</span></label>
                                                <input type="text" name="name" value="<?php echo $productRecord['data']['name']; ?>" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="name">Select Category <span class="text-danger">*</span></label>
                                                <select name="category_id" class="form-select form-select-sm form-control">
                                                    <option selected disabled>Select Category</option>
                                                    <?php
                                                        $categories = getAllRecord('categories');
                                                        if ($categories) {
                                                            if(mysqli_num_rows($categories) > 0) {
                                                                foreach($categories as $category) {
                                                                    ?>
                                                                    <option value="<?php echo $category['id']?>"
                                                                    <?php echo $productRecord['data']['category_id'] == $category['id'] ? 'selected' : ''; ?>
                                                                     ><?php echo $category['name']; ?></option>';
                                                                    <?php
                                                                    
                                                                }
                                                            }else{
                                                                echo '<option value="">No Category Found.</option>';
                                                            }
                                                        }else{
                                                            echo '<option value="">Something went wrong!</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="price">Price <span class="text-danger">*</span></label>
                                                <input type="text" name="price" value="<?php echo $productRecord['data']['price']; ?>" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="quantity">Quantity <span class="text-danger">*</span></label>
                                                <input type="text" name="quantity" value="<?php echo $productRecord['data']['quantity']; ?>" class="form-control" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                                                <input class="form-control" type="file" name="image" id="image">
                                                <img src="../<?php echo $productRecord['data']['image']; ?>" style="width: 40px; height: 40px;" alt="Product Image">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label >Status</label>
                                                <select name="status" class="form-select form-select-sm form-control"
                                                    aria-label="Default select example">
                                                    <option selected disabled>Select Category Status</option>
                                                    <option value="1"
                                                                <?php echo $productRecord['data']['status'] == 1 ? 'selected' : '' ?> >
                                                                Active
                                                            </option>
                                                            <option value="0" <?php echo $productRecord['data']['status'] == 0 ? 'selected' : '' ?> >Inactive</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label for="description">Description</label>
                                                <textarea name="description" class="form-control" id="" cols="30" rows="4"><?php echo $productRecord['data']['description']; ?></textarea>
                                            </div>
                                        </div>
                                        <?php
                                                }else
                                                {
                                                    echo '<h5>'.$categoryRecord['message'].'</h5>';
                                                }
                                            }else{
                                                echo '<h5>Something went wrong</h5>';
                                                return false;
                                            }
                                            ?>
                                        <button type="submit" name="updateProduct"
                                            class="btn btn-primary my-2">Update</button>
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