<html>
<?php include("../components/head.php"); ?>

<body>
    <?php include("../components/navbar.php"); ?>
    <div class='container pt-5 '>

        <div class="jumbotron">
            <h1 class="display-2">Employee Portal</h1>
            <p class="lead">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores odit suscipit neque distinctio eligendi exercitationem sequi aspernatur sed ipsa doloremque!</p>
        </div>
    </div>
    <div class='container pt-4'>
        <h6>Time clocked in for today</h6>
        <p class='lead'>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus pariatur, minus porro velit deserunt totam.</p>
        <div class='display-5 mb-3'>05h 25m</div>
        <div class='d-flex gap-2'>
            <button id="clockInButton" class='d-none btn btn-primary'>Clock In</button>
            <button id="clockOutButton" class='d-none btn btn-outline-primary'>Clock Out</button>
            <button class='btn btn-link' data-bs-toggle="modal" data-bs-target="#modalRequestLeave">Request a Leave</button>
        </div>

        <div class='row pt-5'>
            <div class='col'>
                <h6>Time clocked in for this week</h6>
                <p class='lead'>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus pariatur, minus porro velit deserunt totam.</p>
                <table class='table table-borderless'>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th>Started at</th>
                            <th>Ended at</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>1st Jun, 2021</td>
                            <td>09:00 am</td>
                            <td>14:00 pm</td>
                            <td>05h 00m</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>1st Jun, 2021</td>
                            <td>14:00 pm</td>
                            <td>18:00 am</td>
                            <td>04h 00m</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>2nd Jun, 2021</td>
                            <td>09:00 am</td>
                            <td>19:00 pm</td>
                            <td>09h 00m</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class='col'>

                <h6>Leaves requested

                    <span class="badge badge-pill">2</span>

                </h6>
                <p class='lead'>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus pariatur, minus porro velit deserunt totam.</p>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class='d-flex align-items-center'>
                            <div>

                                From <code>21st May, 2021</code> to <code>16th June, 2021</code>
                            </div>
                            <button class='btn btn-link btn-small text-secondary' style="font-size:12px">Cancel Request</button>
                        </div>
                        <span class="badge bg-warning rounded-pill">pending</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            From <code>21st May, 2021</code> to <code>16th June, 2021</code>
                        </div>
                        <span class="badge bg-danger rounded-pill">rejected</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            From <code>21st May, 2021</code> to <code>16th June, 2021</code>
                        </div>
                        <span class="badge bg-success rounded-pill">approved</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>






    <!-- Modal -->
    <div class="modal fade" id="modalRequestLeave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request a Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>

                        <div class='form-group mb-3'>
                            <label for='inputStartDate' class='mb-2'>From <span class='text-danger'>*</span>
                            </label>
                            <input type='date' required class='form-control' id='inputStartDate' name='inputStartDate' />
                        </div>

                        <div class='form-group mb-3'>
                            <label for='inputStartDate' class='mb-2'>To <span class='text-danger'>*</span>
                            </label>
                            <input type='date' required class='form-control' id='inputStartDate' name='inputStartDate' />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Request</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function fetchInfo() {
        fetch("http://localhost/the-hr-system/api/", {
            redirect: "error",
            header: {
                "Content-Type": "application/json",
            },
        }).then(res => res.json()).then((res) => {
            if (res.info.employee) {
                console.debug(clockInButton, clockOutButton)
                if (!res.info.employee.clockIn) {
                    clockInButton.classList.remove("d-none")
                    clockOutButton.replace(new RegExp("d-none", "gi"), "");("d-none")
                } else {
                    clockOutButton.classList.remove("d-none")
                    clockInButton.replace(new RegExp("d-none", "gi"), "");("d-none")

                }
            }
        })
    }

    fetchInfo()
</script>

</html>