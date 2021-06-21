<?php
include("../api/connection.php");
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">The HR System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <?php if ($_SESSION && $_SESSION[$KEY_LOGIN_DETAILS]) {
                ?>
                    <?php if ($_SESSION[$KEY_LOGIN_DETAILS][$KEY_TYPE] === $TYPE_EMPLOYEE) { ?>
                        <a class="nav-link active" aria-current="page" href="/the-hr-system/employee-portal/">Employee Portal</a>
                    <?php } else { ?>
                        <a class="nav-link active" href="/the-hr-system/dashboard/">HR Dashboard</a>
                    <?php } ?>
                    <button class="btn btn-link nav-link" href="#" tabindex="-1" aria-disabled="true" onclick="logout()">Logout</button>
                <?php
                } else {
                ?>
                    <a class="nav-link active" aria-current="page" href="/the-hr-system">Home</a>
                    <a class="nav-link" href="/the-hr-system/login.php">Login</a>
                    <a class="nav-link" href="/the-hr-system/register.php">Request a demo</a>
                <?php } ?>

            </div>
        </div>
    </div>
</nav>

<script>
    function logout() {
        fetch("http://localhost/the-hr-system/api/?action=LOGOUT").then(() => window.location.href = "/the-hr-system");
    }
</script>