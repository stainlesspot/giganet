<?php
session_start();
include 'functions.php';
header('Content-Type: text/plain');

if(isset($_POST['rowId'], $_POST['editedColumn'], $_POST['newText'], $_SESSION['customerIds'])){
    $rowId = $_POST['rowId'];
    $column = $_POST['editedColumn'];
    $text = sanitizeString($_POST['newText']);
    $rowToCustomerId = $_SESSION['customerIds'];

    $updateSql = "UPDATE customers SET " . $column . " = ? WHERE CustomerID = ? ;";

    $conn = connectionToDatabase();
    $command = $conn->prepare($updateSql);
    $command->bind_param('ss', $text, $rowToCustomerId[$rowId]);
    echo $command->execute();
    //echo "rowId: " . $rowId . ' isString: ' .is_string($rowId). ' customerId: '. $rowToCustomerId[$rowId] .' column: ' . $column . " text: " . $text;
    //die('column: ' . $column . ' sql: ' . $updateSql . ' text: '. $text . ' rowId: ' . $rowToCustomerId[$rowId]);
}
else
    //echo 'Parameters not set! ' . $_POST['editedColumn'] . ' ' . $_POST['newText'];
    echo false;