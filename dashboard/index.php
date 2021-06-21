<html>
<?php include("../components/head.php"); ?>

<body>
    <?php include("../components/navbar.php"); ?>
    <div class='container pt-5'>

        <div class="jumbotron">
            <h1 class="display-4">Welcome to <span id="companyNameContainer"></span></h1>
            <p class="lead">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores odit suscipit neque distinctio eligendi exercitationem sequi aspernatur sed ipsa doloremque!</p>

        </div>
    </div>
    <div class='container'>
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between">

                            <span>Organization's Employees</span>
                            <span id="totalEmployeesContainer" class="badge bg-secondary"></span>
                        </h5>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam, aliquid?</p>
                        <a href="./employees/add.php" class="btn btn-primary">Add a New Employee</a>
                        <a href="./employees/" class="btn btn-link">Employees</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex justify-content-between">

                            <span>Requests for leave</span>
                            <span class="badge bg-secondary">0</span>
                        </h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <ul class="list-group">
                            <div class="list-group-item d-flex justify-content-between align-items-start">

                                <div class="ms-2 me-auto">
                                    <a class="fw-bold d-block" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Khubaib Tariq
                                    </a>
                                    From <code>21st May, 2021</code> to <code>16th June, 2021</code>
                                    <div class="collapse" id="collapseExample1">

                                        <div class='d-flex gap-2 mt-2'>

                                            <button class='btn btn-outline-primary btn-sm'>Approve</button>
                                            <button class='btn btn-outline-danger btn-sm'>Reject</button>
                                        </div>
                                    </div>
                                </div>
                                <span class="badge bg-primary rounded-pill">2d</span>
                            </div>
                            <li class="list-group-item d-flex justify-content-between align-items-start">

                                <div class="ms-2 me-auto">
                                    <a class="fw-bold d-block" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        Khubaib Tariq
                                    </a>
                                    From <code>21st May, 2021</code> to <code>16th June, 2021</code>
                                    <div class="collapse" id="collapseExample">

                                        <div class='d-flex gap-2 mt-2'>

                                            <button class='btn btn-outline-primary btn-sm'>Approve</button>
                                            <button class='btn btn-outline-danger btn-sm'>Reject</button>
                                        </div>
                                    </div>
                                </div>
                                <span class="badge bg-primary rounded-pill">2d</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold">Khubaib Tariq</div>
                                    From <code>21st May, 2021</code> to <code>16th June, 2021</code>
                                </div>
                                <span class="badge bg-primary rounded-pill">2d</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function fetchEmployees() {
        fetch("http://localhost/the-hr-system/api/?action=EMPLOYEES", {

        }).then(res => res.json()).then(res => {
            const employees = res.data
            totalEmployeesContainer.innerHTML = res.data.length

            if (res.info.company) {
                companyNameContainer.innerHTML = res.info.company.name;
            }
        })
    }
    fetchEmployees()
</script>

</html>