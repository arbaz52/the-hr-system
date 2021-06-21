<html>
<?php include("../../components/head.php"); ?>
<?php include("../../components/navbar.php"); ?>

<div class='container py-5'>
    <div class='row'>

        <div class='col-4 mx-auto'>

            <form class='form'>

                <h1>Add Employee</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi accusantium dolores dolorem. Earum repellendus omnis totam, accusamus ab voluptatem necessitatibus!</p>
                <div class='form-group mb-3'>
                    <label for='inputFirstName' class='mb-2'>First Name <span class='text-danger'>*</span>
                    </label>
                    <input type='text' required placeholder="Enter First Name" class='form-control' id='inputFirstName' name='firstName' />
                </div>
                <div class='form-group mb-3'>
                    <label for='inputLastName' class='mb-2'>Last Name <span class='text-danger'>*</span>
                    </label>
                    <input type='text' required placeholder="Enter Last Name" class='form-control' id='inputLastName' name='lastName' />
                </div>
                <div class='form-group mb-3'>
                    <label for='inputEmail' class='mb-2'>Email Address <span class='text-danger'>*</span>
                    </label>
                    <input type='email' required placeholder="Enter Email Address" class='form-control' id='inputEmail' name='email' />
                </div>
                <div class='form-group mb-3'>
                    <label for='inputHiringDate' class='mb-2'>Hiring Date <span class='text-danger'>*</span>
                    </label>
                    <input type='date' required class='form-control' id='inputHiringDate' name='inputHiringDate' />
                </div>
                <div class='form-group mb-3'>
                    <label for='inputSalary' class='mb-2 d-block'>Salary <span class='text-danger'>*</span>
                    <div class="input-group mt-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" required class="form-control" aria-label="Amount (to the nearest dollar)">
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>

                </div>

                <div class='form-group mb-3'>
                    <button class='btn btn-primary'>Add Employee</button>
                </div>

            </form>
        </div>
    </div>
</div>

</html>