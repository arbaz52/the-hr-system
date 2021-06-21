<html>
<?php include("./components/head.php"); ?>
<?php include("./components/navbar.php"); ?>

<div class='container py-5'>
    <div class='row'>

        <div class='col-4 mx-auto'>

            <form class='form'>

                <h1>Register  Organization</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi accusantium dolores dolorem. Earum repellendus omnis totam, accusamus ab voluptatem necessitatibus!</p>
                <div class='form-group mb-3'>
                    <label for='inputCompanyName' class='mb-2'>Company Name <span class='text-danger'>*</span>
                    </label>
                    <input type='text' required placeholder="Enter Company Name" class='form-control' id='inputCompanyName' name='email' />
                </div>

                <div class='form-group mb-3'>
                    <label for='inputEmail' class='mb-2'>Email Address <span class='text-danger'>*</span>
                    </label>
                    <input type='email' required placeholder="Enter Email Address" class='form-control' id='inputEmail' name='email' />
                </div>

                <div class='form-group mb-3'>
                    <label for='inputPassword' class='mb-2'>Password <span class='text-danger'>*</span></label>
                    <input type='password' required placeholder="Enter Password" class='form-control' id='inputPassword' name='password' />
                </div>

                <div class='form-group mb-3'>
                    <a href="./login.php" class='btn btn-primary'>Register Organization</a>
                </div>

            </form>
        </div>
    </div>
</div>

</html>