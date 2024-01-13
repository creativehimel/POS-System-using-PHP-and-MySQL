
    <!-- Navbar Section Start -->
    <?php include('includes/head.php'); 
    if(isset($_SESSION['loggedIn'])){
        ?>
        <script>window.location.href = 'index.php'</script>
        <?php
    }
    ?>
    <!-- Navbar Section End -->
    <!-- Navbar Section Start -->
    <?php include('includes/navbar.php') ?>
    <!-- Navbar Section End -->
    <main class="py-5 bg-light">
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card shadow ronded-4">
                        <?php alertMessage() ?>
                        <div class="p-5">
                            <h4 class="text-dark mb-3 text-center">Sign into your POS System</h4>
                            <form action="login-code.php" method="post">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" placeholder="**********" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" name="signInBtn" class="btn btn-primary w-100 mt-2">Sign In</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Footer Section Start -->
    <?php include('includes/footer.php') ?>
    <!-- Footer Section End -->
</body>

</html>