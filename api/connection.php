<?php
$HOSTNAME = "localhost";
$USERNAME = "root";
$PASSWORD = "";
$DATABASE = "the-hr-system";
session_start();

?>
<?php
$connection = mysqli_connect($HOSTNAME, $USERNAME, $PASSWORD, $DATABASE);

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