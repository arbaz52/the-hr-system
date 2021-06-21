<html>
<?php include("./components/head.php"); ?>
<?php include("./components/navbar.php"); ?>

<div class='container py-5'>
    <div class='row'>

        <div class='col-4 mx-auto'>

            <form class='form' onsubmit="handleFormSubmission(event)">

                <h1>Login to HR System</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi accusantium dolores dolorem. Earum repellendus omnis totam, accusamus ab voluptatem necessitatibus!</p>
                <div class='alert alert-warning'>Are you an employee?
                    <a href='./employee-portal/login.php'>Employee Login</a>
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
                    <button class='btn btn-primary'>Login</button>
                </div>

                <div id='resultContainer'></div>

            </form>
        </div>
    </div>
</div>


<script>
    function handleFormSubmission(event) {
        event.preventDefault();

        let email = inputEmail.value;
        let password = inputPassword.value;

        let input = {
            email,
            password,
        }

        fetch("http://localhost/the-hr-system/api/?action=HR_LOGIN", {
            method: "POST",
            body: JSON.stringify(input),
            redirect: "error",
            header: {
                "Content-Type": "application/json",
            },
        }).then(res => res.json()).then((res) => {
            console.debug(res)
            if (res.error) {
                resultContainer.innerHTML = `<div class='alert alert-danger'>${res.error}</div>`
            } else if (res.success) {
                setTimeout(() => {
                    window.location.href = "./dashboard/";
                }, 500)
                resultContainer.innerHTML = `<div class='alert alert-success'>${res.success}<br />Redirecting...</div>`
            }
        })
    }
</script>


</html>