<?php
include("./connection.php");
?>

<?php
// CONSTANTS

$KEY_TYPE = "type";
$KEY_ERROR = "error";
$KEY_SUCCESS = "success";

$KEY_ID = "id";
$KEY_COMPANY_ID = "companyId";
$KEY_LOGIN_DETAILS = "login_details";

$TYPE_HR = "HR";
$TYPE_EMPLOYEE = "EMPLOYEE";
?>

<?php
// UTILITY FUNCTIONS
function isHrLoggedIn()
{
    global $KEY_TYPE, $TYPE_HR, $KEY_LOGIN_DETAILS;
    return isset($_SESSION) && isset($_SESSION[$KEY_LOGIN_DETAILS]) && $_SESSION[$KEY_LOGIN_DETAILS][$KEY_TYPE] == $TYPE_HR;
}
?>

<?php

session_start();
$response = array();

if (!isset($_GET['action'])) {
    $response["error"] = "Please specify an action";
} else {
    $action = $_GET['action'];
    $input = json_decode(file_get_contents("php://input"), TRUE);
    switch ($action) {
        case "CREATE_COMPANY":
            $email = $input["email"];
            $password = $input["password"];
            $companyName = $input["companyName"];
            $result = mysqli_query($connection, "INSERT INTO company (name) VALUES ('$companyName')");
            if ($result) {
                //fetching company id
                $result = mysqli_query($connection, "SELECT id FROM company WHERE name='$companyName'");
                $row = mysqli_fetch_row($result);
                $companyId = $row[0];

                //creating hr account
                $result = mysqli_query($connection, "INSERT INTO humanresource (companyId, email, password) VALUES ($companyId, '$email', '$password')");

                if ($result) {
                    $response["success"] = "Company and HR Account successfully created";
                } else {
                    $response["error"] = "Could not create HR Account";
                }
            } else {
                $response["error"] = "Company already exists";
            }

            break;

        case "HR_LOGIN":
            $email = $input["email"];
            $password = $input["password"];
            //fetching account
            $result = mysqli_query($connection, "SELECT hr.id, c.id FROM humanresource as hr JOIN company as c ON hr.companyId=c.id WHERE hr.email='$email' AND hr.password='$password' LIMIT 1");
            if (mysqli_num_rows($result) == 0) {
                $response["error"] = "Email or password incorrect";
            } else {
                $row = mysqli_fetch_row($result);
                $hrId = $row[0];
                $companyId = $row[1];
                $response["success"] = "Login successful";
                if (isset($_SESSION))
                    session_destroy();

                session_start();
                $_SESSION[$KEY_LOGIN_DETAILS] = array(
                    $KEY_ID => $hrId,
                    $KEY_TYPE => $TYPE_HR,
                    $KEY_COMPANY_ID => $companyId,
                );
            };
            break;

        case "EMPLOYEES":
            $companyId = $_SESSION[$KEY_LOGIN_DETAILS][$KEY_COMPANY_ID];
            $response["data"] = array();

            $result = mysqli_query($connection, "SELECT id, email, firstName, lastName, salary FROM employee WHERE companyId=$companyId");
            if ($result)
                while ($row = mysqli_fetch_assoc($result)) {
                    array_push($response["data"], $row);
                }
            break;

        case "EMPLOYEE_LOGIN":
            $email = $input["email"];
            $password = $input["password"];
            //fetching account
            $result = mysqli_query($connection, "SELECT e.id, c.id, e.password FROM employee as e JOIN company as c ON e.companyId=c.id WHERE e.email='$email' LIMIT 1");
            if (mysqli_num_rows($result) == 0) {
                $response["error"] = "Email or password incorrect";
            } else {
                $row = mysqli_fetch_row($result);
                $employeeId = $row[0];
                $companyId = $row[1];

                // if password is set, check password otherwise set the given password
                if (isset($row[2])) {
                    if ($row[2] != $password) {
                        $response["error"] = "Invalid password";
                        break;
                    }
                } else {
                    $result = mysqli_query($connection, "UPDATE employee SET password='$password' WHERE id=$employeeId");
                    if (!$result) {
                        $response["error"] = "An error occured while setting the default password";
                        break;
                    }
                }

                $response["success"] = "Login successful";
                if (isset($_SESSION))
                    session_destroy();

                session_start();
                $_SESSION[$KEY_LOGIN_DETAILS] = array(
                    $KEY_ID => $employeeId,
                    $KEY_TYPE => $TYPE_EMPLOYEE,
                    $KEY_COMPANY_ID => $companyId,
                );
            };
            break;

        case "LOGOUT":
            if (isset($_SESSION))
                session_destroy();
            session_start();
            $response["success"] = "Logout successful";
            break;

        case "ADD_EMPLOYEE":
            if (isHrLoggedIn()) {
                // do not set the password for now, it will be set on first login

                $email = $input["email"];
                $salary = $input["salary"];
                $lastName = $input["lastName"];
                $firstName = $input["firstName"];

                $companyId = $_SESSION[$KEY_LOGIN_DETAILS][$KEY_COMPANY_ID];

                $result = mysqli_query($connection, "INSERT INTO employee (companyId, firstName, lastName, email, salary) VALUES ($companyId, '$firstName', '$lastName', '$email', $salary)");
                if ($result) {
                    $response["success"] = "Employee successfully added, the employee will now be able to login by providing the desired password on the first login";
                }
            } else {
                $response["error"] = "You need to login as HR to add an employee";
            }
            break;

        case "CLOCK_IN":
            $clockIn = $input["clockIn"];
            $employeeId = $_SESSION[$KEY_LOGIN_DETAILS][$KEY_ID];
            $result = mysqli_query($connection, "INSERT INTO clockin (employeeId, clockIn) VALUES ($employeeId, $clockIn)");
            if ($result) {
                $response["success"] = "Clock in successful";
            } else {
                $response["error"] = "Could not clock in";
            }
            break;

        case "CLOCK_OUT":
            $clockOut = $input["clockOut"];
            $employeeId = $_SESSION[$KEY_LOGIN_DETAILS][$KEY_ID];
            // fetch the last clock in and clock out
            $result = mysqli_query($connection, "SELECT * FROM clockin WHERE employeeId=$employeeId AND clockout is NULL ORDER BY id DESC LIMIT 1");
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_row($result);
                $clockInId = $row[0];
                $result = mysqli_query($connection, "UPDATE clockin SET clockOut=$clockOut WHERE id=$clockInId");
                if ($result) {
                    $response["success"] = "Clock out successful";
                } else {
                    $response["error"] = "Could not clock out!";
                }
            } else {
                $response["error"] = "Did not clock in recently";
            }
            break;

        case "REQUEST_LEAVE":
            $toDate = $input["toDate"];
            $fromDate = $input["fromDate"];

            $status = "PENDING";
            $employeeId = $_SESSION[$KEY_LOGIN_DETAILS][$KEY_ID];


            $result = mysqli_query($connection, "INSERT INTO leaverequest (employeeId, fromDate, toDate, status) VALUES ($employeeId, $fromDate, $toDate, '$status')");
            if ($result) {
                $response["success"] = "Leave successfully requested";
            } else {
                $response["error"] = "An error occured while requesting leave";
            }
            break;

        case "MANAGE_LEAVE":
            $leaveId = $input["leaveId"];
            $status = $input["status"];

            $result = mysqli_query($connection, "UPDATE leaverequest SET status='$status' WHERE id='$leaveId'");
            if ($result) {
                $response["success"] = "Leave successfully updated";
            } else {
                $response["error"] = "An error occured while updating leave request";
            }
            break;

        case "DELETE_LEAVE":
            $leaveId = $input["leaveId"];

            $result = mysqli_query($connection, "DELETE FROM leaverequest WHERE id=$leaveId");
            if ($result) {
                $response["success"] = "Leave deleted successfully";
            } else {
                $response["error"] = "An error occured while deleting leave";
            }
            break;


        default:
            $response["error"] = "Action has not been implemented yet";
    }
}


if ($_SESSION && $_SESSION[$KEY_LOGIN_DETAILS]) {
    $companyId = $_SESSION[$KEY_LOGIN_DETAILS][$KEY_COMPANY_ID];
    $query = "SELECT id, name FROM company WHERE id=$companyId";
    $result = mysqli_query($connection, $query);
    $response["info"] = array();
    if ($result) {
        $response["info"]["company"] = mysqli_fetch_assoc($result);
    }


    if ($_SESSION[$KEY_LOGIN_DETAILS][$KEY_TYPE] === $TYPE_EMPLOYEE) {
        $employeeId = $_SESSION[$KEY_LOGIN_DETAILS][$KEY_ID];
        $query = "SELECT id, firstName, lastName, email, salary FROM employee WHERE id=$employeeId";
        $result = mysqli_query($connection, $query);
        if ($result) {
            $response["info"]["employee"] = mysqli_fetch_assoc($result);
        }

        //get current clockedin time
        $query = "SELECT id, clockIn, clockOut from clockin WHERE employeeId=$employeeId AND clockOut is NULL ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($connection, $query);
        if ($result && mysqli_num_rows($result) > 0) {
            $response["info"]["clockIn"] = mysqli_fetch_assoc($result);
        }
    }
}




print(json_encode($response));
