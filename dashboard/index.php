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
                        <ul id="leavesContainer" class="list-group">
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
    (function() {
        // Defining locale
        Date.shortMonths = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        Date.longMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        Date.shortDays = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
        Date.longDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
        // Defining patterns
        var replaceChars = {
            // Day
            d: function() {
                var d = this.getDate();
                return (d < 10 ? '0' : '') + d
            },
            D: function() {
                return Date.shortDays[this.getDay()]
            },
            j: function() {
                return this.getDate()
            },
            l: function() {
                return Date.longDays[this.getDay()]
            },
            N: function() {
                var N = this.getDay();
                return (N === 0 ? 7 : N)
            },
            S: function() {
                var S = this.getDate();
                return (S % 10 === 1 && S !== 11 ? 'st' : (S % 10 === 2 && S !== 12 ? 'nd' : (S % 10 === 3 && S !== 13 ? 'rd' : 'th')))
            },
            w: function() {
                return this.getDay()
            },
            z: function() {
                var d = new Date(this.getFullYear(), 0, 1);
                return Math.ceil((this - d) / 86400000)
            },
            // Week
            W: function() {
                var target = new Date(this.valueOf())
                var dayNr = (this.getDay() + 6) % 7
                target.setDate(target.getDate() - dayNr + 3)
                var firstThursday = target.valueOf()
                target.setMonth(0, 1)
                if (target.getDay() !== 4) {
                    target.setMonth(0, 1 + ((4 - target.getDay()) + 7) % 7)
                }
                var retVal = 1 + Math.ceil((firstThursday - target) / 604800000)

                return (retVal < 10 ? '0' + retVal : retVal)
            },
            // Month
            F: function() {
                return Date.longMonths[this.getMonth()]
            },
            m: function() {
                var m = this.getMonth();
                return (m < 9 ? '0' : '') + (m + 1)
            },
            M: function() {
                return Date.shortMonths[this.getMonth()]
            },
            n: function() {
                return this.getMonth() + 1
            },
            t: function() {
                var year = this.getFullYear()
                var nextMonth = this.getMonth() + 1
                if (nextMonth === 12) {
                    year = year++
                    nextMonth = 0
                }
                return new Date(year, nextMonth, 0).getDate()
            },
            // Year
            L: function() {
                var L = this.getFullYear();
                return (L % 400 === 0 || (L % 100 !== 0 && L % 4 === 0))
            },
            o: function() {
                var d = new Date(this.valueOf());
                d.setDate(d.getDate() - ((this.getDay() + 6) % 7) + 3);
                return d.getFullYear()
            },
            Y: function() {
                return this.getFullYear()
            },
            y: function() {
                return ('' + this.getFullYear()).substr(2)
            },
            // Time
            a: function() {
                return this.getHours() < 12 ? 'am' : 'pm'
            },
            A: function() {
                return this.getHours() < 12 ? 'AM' : 'PM'
            },
            B: function() {
                return Math.floor((((this.getUTCHours() + 1) % 24) + this.getUTCMinutes() / 60 + this.getUTCSeconds() / 3600) * 1000 / 24)
            },
            g: function() {
                return this.getHours() % 12 || 12
            },
            G: function() {
                return this.getHours()
            },
            h: function() {
                var h = this.getHours();
                return ((h % 12 || 12) < 10 ? '0' : '') + (h % 12 || 12)
            },
            H: function() {
                var H = this.getHours();
                return (H < 10 ? '0' : '') + H
            },
            i: function() {
                var i = this.getMinutes();
                return (i < 10 ? '0' : '') + i
            },
            s: function() {
                var s = this.getSeconds();
                return (s < 10 ? '0' : '') + s
            },
            v: function() {
                var v = this.getMilliseconds();
                return (v < 10 ? '00' : (v < 100 ? '0' : '')) + v
            },
            // Timezone
            e: function() {
                return Intl.DateTimeFormat().resolvedOptions().timeZone
            },
            I: function() {
                var DST = null
                for (var i = 0; i < 12; ++i) {
                    var d = new Date(this.getFullYear(), i, 1)
                    var offset = d.getTimezoneOffset()

                    if (DST === null) DST = offset
                    else if (offset < DST) {
                        DST = offset;
                        break
                    } else if (offset > DST) break
                }
                return (this.getTimezoneOffset() === DST) | 0
            },
            O: function() {
                var O = this.getTimezoneOffset();
                return (-O < 0 ? '-' : '+') + (Math.abs(O / 60) < 10 ? '0' : '') + Math.floor(Math.abs(O / 60)) + (Math.abs(O % 60) === 0 ? '00' : ((Math.abs(O % 60) < 10 ? '0' : '')) + (Math.abs(O % 60)))
            },
            P: function() {
                var P = this.getTimezoneOffset();
                return (-P < 0 ? '-' : '+') + (Math.abs(P / 60) < 10 ? '0' : '') + Math.floor(Math.abs(P / 60)) + ':' + (Math.abs(P % 60) === 0 ? '00' : ((Math.abs(P % 60) < 10 ? '0' : '')) + (Math.abs(P % 60)))
            },
            T: function() {
                var tz = this.toLocaleTimeString(navigator.language, {
                    timeZoneName: 'short'
                }).split(' ');
                return tz[tz.length - 1]
            },
            Z: function() {
                return -this.getTimezoneOffset() * 60
            },
            // Full Date/Time
            c: function() {
                return this.format('Y-m-d\\TH:i:sP')
            },
            r: function() {
                return this.toString()
            },
            U: function() {
                return Math.floor(this.getTime() / 1000)
            }
        }

        // Simulates PHP's date function
        Date.prototype.format = function(format) {
            var date = this
            return format.replace(/(\\?)(.)/g, function(_, esc, chr) {
                return (esc === '' && replaceChars[chr]) ? replaceChars[chr].call(date) : chr
            })
        }
    }).call(this)
</script>
<script>
    function manageLeave(leaveId, status) {
        fetch("http://localhost/the-hr-system/api/?action=MANAGE_LEAVE", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                leaveId,
                status
            })
        }).then(res => res.json()).then(res => {
            window.location.href = window.location.href
        })
    }

    function fetchLeaves() {
        fetch("http://localhost/the-hr-system/api/?action=LEAVES", {

        }).then(res => res.json()).then(res => {
            const leaves = res.data
            let rows = ""
            leavesContainer.innerHTML = ""
            for (let leave of leaves) {
                if (leave.status !== "PENDING") continue;

                const fromDate = (new Date(parseInt(leave.fromDate) * 1000)).format("jS M, o")
                const toDate = (new Date(parseInt(leave.toDate) * 1000)).format("jS M, o")

                const duration = new Date(new Date(parseInt(leave.toDate) * 1000).valueOf() - new Date(parseInt(leave.fromDate) * 1000).valueOf())
                duration.setMinutes(duration.getMinutes() + duration.getTimezoneOffset())

                const template = `
                    <div class="list-group-item d-flex justify-content-between align-items-start">
                        <div class="ms-2 me-auto">
                            <a class="fw-bold d-block" data-bs-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                                ${leave.firstName} ${leave.lastName}
                            </a>
                            From <code>${fromDate}</code> to <code>${toDate}</code>

                            <div class="collapse" id="collapseExample1">
                            
                                <div class='d-flex gap-2 mt-2'>
                                    <button class='btn btn-outline-primary btn-sm' onclick="manageLeave(${leave.leaveId}, 'APPROVED')">Approve</button>
                                    <button class='btn btn-outline-danger btn-sm' onclick="manageLeave(${leave.leaveId}, 'REJECTED')">Reject</button>
                                </div>
                            </div>
                        </div>
                        <span class="badge bg-primary rounded-pill">${duration.format("z")}d ${leave.leaveId}</span>
                    </div>
                `
                rows += template
            }
            leavesContainer.insertAdjacentHTML("beforeend", rows)


        })
    }


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
    fetchLeaves()
</script>

</html>