<html>
<?php include("../../components/head.php"); ?>

<body>
    <?php include("../../components/navbar.php"); ?>
    <div class='container py-5'>
        <div class='d-flex flex-direction-row justify-content-between align-items-start'>
            <div class='flex-1'>
                <h1>Organization's Employees</h1>
                <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, soluta.</p>
            </div>
            <a class='btn btn-primary' href="./add.php">Add Employee</a>
        </div>
    </div>
    <div class='container'>

        <table class='table table-borderless'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Hiring Date</th>
                    <th>Salary</th>
                    <th>Actions</th>
                </tr>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td><strong>Mark</strong></td>
                    <td>Otto</td>
                    <td>24th May, 2020</td>
                    <td>50,000$</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td><strong>Jacob</strong></td>
                    <td>Thornton</td>
                    <td>21 Jun, 2015</td>
                    <td>43,000$</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td colspan="2"><strong>Larry the Bird</strong></td>
                    <td>12th Mar, 2018</td>
                    <td>60,000$</td>
                </tr>
            </tbody>
            </thead>

        </table>

    </div>
</body>

</html>