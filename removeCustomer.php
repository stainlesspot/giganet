<?php
session_start();
include 'functions.php';
header('Content-Type: text/plain');

if(isset($_POST['rowId'], $_SESSION['customerIds'])) {
    $rowId = $_POST['rowId'];
    $rowToCustomerId = $_SESSION['customerIds'];
    echo deleteRow($rowToCustomerId[$rowId]);
}
else
    echo false;