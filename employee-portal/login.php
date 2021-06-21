<html>
<?php include("../components/head.php"); ?>
<?php include("../components/navbar.php"); ?>

<div class='container py-5'>
    <div class='row'>

        <div class='col-4 mx-auto'>

            <form class='form'>

                <h1>Login to<br /> Employee Dashboard</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi accusantium dolores dolorem. Earum repellendus omnis totam, accusamus ab voluptatem necessitatibus!</p>
                <div class='form-group mb-3'>
                    <label for='inputEmail' class='mb-2'>Email Address <span class='text-danger'>*</span>
                    </label>
                    <input type='email' required placeholder="Enter Email Address" class='form-control' id='inputEmail' name='email' />
                </div>

                <div class='form-group mb-3'>
                    <label for='inputPassword' class='mb0'>Password <span class='text-danger'>*</span></label>
                    <input type='password' required placeholder="Enter Password" class='form-control' id='inputPassword' name='password' />
                </div>

                <div class='alert alert-primary mb-2'>If it is your first time login,  this will be used as your password.</div>
                <div class='form-group mb-3'>
                    <a href="./index.php" class='btn btn-primary'>Login as Employee</a>
                </div>

            </form>
        </div>
    </div>
</div>

</html>