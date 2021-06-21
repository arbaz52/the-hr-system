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
        <div id='clockedInForHowLongContainer' class='display-5 mb-3'>05h 25m</div>
        <div class='d-flex gap-2'>
            <button id="clockInButton" onclick="clockIn()" class='d-none btn btn-primary'>Clock In</button>
            <button id="clockOutButton" onclick="clockOut()" class='d-none btn btn-outline-primary'>Clock Out</button>
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
                    <tbody id='clockInsContainer'>

                    </tbody>
                </table>
            </div>
            <div class='col'>

                <h6>Leaves requested

                    <span class="badge badge-pill">2</span>

                </h6>
                <p class='lead'>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus pariatur, minus porro velit deserunt totam.</p>
                <ul id="leavesContainer" class="list-group"></ul>
            </div>
        </div>
    </div>






    <!-- Modal -->
    <div class="modal fade" id="modalRequestLeave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form class="modal-content" onsubmit="handleRequestLeave(event)">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Request a Leave</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class='form-group mb-3'>
                        <label for='inputStartDate' class='mb-2'>From <span class='text-danger'>*</span>
                        </label>
                        <input type='date' required class='form-control' id='inputStartDate' name='inputStartDate' />
                    </div>

                    <div class='form-group mb-3'>
                        <label for='inputEndDate' class='mb-2'>To <span class='text-danger'>*</span>
                        </label>
                        <input type='date' required class='form-control' id='inputEndDate' name='inputEndDate' />
                    </div>
                    <div id="resultContainer"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Request</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    function handleRequestLeave(event) {
        event.preventDefault();

        let fromDate = (new Date(inputStartDate.value)).valueOf() / 1000;
        let toDate = (new Date(inputEndDate.value)).valueOf() / 1000;

        let input = {
            fromDate,
            toDate
        }

        fetch("http://localhost/the-hr-system/api/?action=REQUEST_LEAVE", {
            method: "POST",
            body: JSON.stringify(input),
            redirect: "error",
            header: {
                "Content-Type": "application/json",
            },
        }).then(res => res.json()).then((res) => {
            console.debug(res)

            inputStartDate.value = ""
            inputEndDate.value = ""

            if (res.error) {
                resultContainer.innerHTML = `<div class='alert alert-danger'>${res.error}</div>`
            } else if (res.success) {
                setTimeout(() => {
                    resultContainer.innerHTML = "";
                    window.location.href = "./index.php";
                }, 1500)
                resultContainer.innerHTML = `<div class='alert alert-success'>${res.success}<br />Redirecting...</div>`
            }
        })
    }
</script>

<script>
    function clockOut() {
        fetch("http://localhost/the-hr-system/api/?action=CLOCK_OUT", {
            redirect: "error",
            header: {
                "Content-Type": "application/json",
            },
            method: "POST",
            body: JSON.stringify({
                clockOut: (new Date()).valueOf() / 1000
            })
        }).then(res => res.json()).then((res) => {
            console.debug(res)
            if (!res.info.clockIn) {
                clockOutButton.classList.add("d-none")
                clockInButton.className = clockOutButton.className.replace(new RegExp("d-none", "gi"), "");
                ("d-none")
                clockedInForHowLongContainer.innerHTML = "Not yet clocked in!"
            } else {
                // determine how for how long the user has clocked in
                console.debug(res);
                const currentDate = new Date()
                const clockInDate = new Date(parseInt(res.info.clockIn.clockIn) * 1000)

                const timeDiff = new Date(currentDate.valueOf() - clockInDate.valueOf())
                timeDiff.setMinutes(timeDiff.getMinutes() + timeDiff.getTimezoneOffset())
                const append0 = (str) => ('0' + str).slice(-2)
                clockedInForHowLongContainer.innerHTML = `${append0(timeDiff.getHours())}h ${append0(timeDiff.getMinutes())}m`;






                clockInButton.classList.add("d-none")
                clockOutButton.className = clockInButton.className.replace(new RegExp("d-none", "gi"), "");
                ("d-none")

            }
        })
    }

    function clockIn() {
        fetch("http://localhost/the-hr-system/api/?action=CLOCK_IN", {
            redirect: "error",
            header: {
                "Content-Type": "application/json",
            },
            method: "POST",
            body: JSON.stringify({
                clockIn: (new Date()).valueOf() / 1000
            })
        }).then(res => res.json()).then((res) => {
            if (!res.info.clockIn) {
                clockOutButton.classList.add("d-none")
                clockInButton.className = clockOutButton.className.replace(new RegExp("d-none", "gi"), "");
                ("d-none")
                clockedInForHowLongContainer.innerHTML = "Not yet clocked in!"
            } else {
                // determine how for how long the user has clocked in
                console.debug(res);
                const currentDate = new Date()
                const clockInDate = new Date(parseInt(res.info.clockIn.clockIn) * 1000)

                const timeDiff = new Date(currentDate.valueOf() - clockInDate.valueOf())
                timeDiff.setMinutes(timeDiff.getMinutes() + timeDiff.getTimezoneOffset())
                const append0 = (str) => ('0' + str).slice(-2)
                clockedInForHowLongContainer.innerHTML = `${append0(timeDiff.getHours())}h ${append0(timeDiff.getMinutes())}m`;






                clockInButton.classList.add("d-none")
                clockOutButton.className = clockInButton.className.replace(new RegExp("d-none", "gi"), "");
                ("d-none")

            }
        })
    }
</script>
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
    const append0 = (str) => ('0' + str).slice(-2)

    function fetchInfo() {
        fetch("http://localhost/the-hr-system/api/?action=CLOCK_INS", {
            redirect: "error",
            header: {
                "Content-Type": "application/json",
            },
        }).then(res => res.json()).then((res) => {

            // populate my leave requests
            if (res.info.leaves) {
                let rows = "";
                for (let leave of res.info.leaves) {
                    const fromDate = (new Date(parseInt(leave.fromDate) * 1000)).format("jS M, o")
                    const toDate = (new Date(parseInt(leave.toDate) * 1000)).format("jS M, o")
                    let status = leave.status.toLowerCase();
                    let statusColor = status === "pending" ? "warning" : status === "approved" ? "success" : "danger";
                    let statusSpan = `<span class="badge bg-${statusColor} rounded-pill">${status}</span>`;
                    const leaveTemplate = `
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class='d-flex align-items-center'>
                        <div>
                        
                        From <code>${fromDate}</code> to <code>${toDate}</code>
                        </div>
                        <button class='btn btn-link btn-small text-secondary' style="font-size:12px">Cancel Request</button>
                        </div>
                        ${statusSpan}
                    </li>`
                    rows += leaveTemplate
                }

                leavesContainer.insertAdjacentHTML("beforeend", rows)

            }

            // this weeks clock ins
            let rows = "";
            const d = new Date()
            clockInsContainer.innerHTML = "";
            for (let row of res.data) {
                const clockInDate = new Date(parseInt(row.clockIn) * 1000)
                if (clockInDate.format("W") != d.format("W"))
                    continue;

                const clockOutDate = row.clockOut ? new Date(parseInt(row.clockOut) * 1000) : undefined


                const duration = clockOutDate ? new Date(clockOutDate.valueOf() - clockInDate.valueOf()) : undefined
                if (duration)
                    duration.setMinutes(duration.getMinutes() + duration.getTimezoneOffset())

                const template = `
                <tr>
                    <td>${row.id}</td>
                    <td>${clockInDate.format("jS M o")}</td>
                    <td>${clockInDate.format("g:i a")}</td>
                    <td>${clockOutDate ? clockOutDate.format("g:i a") : "N/A"}</td>
                    <td>${duration ? `${append0(duration.getHours())}h ${append0(duration.getMinutes())}m` : "N/A"} </td>
                </tr>`
                rows += template;
            }
            clockInsContainer.insertAdjacentHTML("beforeend", rows)




            if (res.info.employee) {

                if (!res.info.clockIn) {
                    clockOutButton.classList.add("d-none")
                    clockInButton.className = clockOutButton.className.replace(new RegExp("d-none", "gi"), "");
                    ("d-none")
                    clockedInForHowLongContainer.innerHTML = "Not yet clocked in!"
                } else {
                    // determine how for how long the user has clocked in
                    console.debug(res);
                    const currentDate = new Date()
                    const clockInDate = new Date(parseInt(res.info.clockIn.clockIn) * 1000)

                    const timeDiff = new Date(currentDate.valueOf() - clockInDate.valueOf())
                    timeDiff.setMinutes(timeDiff.getMinutes() + timeDiff.getTimezoneOffset())
                    clockedInForHowLongContainer.innerHTML = `${append0(timeDiff.getHours())}h ${append0(timeDiff.getMinutes())}m`;






                    clockInButton.classList.add("d-none")
                    clockOutButton.className = clockInButton.className.replace(new RegExp("d-none", "gi"), "");
                    ("d-none")

                }
                console.debug(clockInButton, clockOutButton)

            }
        })
    }



    fetchInfo()
</script>

</html>