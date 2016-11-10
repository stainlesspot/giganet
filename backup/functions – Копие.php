<?php
function connectionToDatabase()
{
    $servername = "localhost";
    $username = "root";
    $password = "th3-mysqlbyth3-haker3";
    $database = "internetserviceprovider";
// Create connection
    $conn = new mysqli($servername, $username, $password, $database);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}


function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function formatAndValidateDate($post){
    $time = strtotime($post);
    if ($time != false){
        $new_date = date('Y-m-d', $time);
        return $new_date;
    }
    else{
        die('Invalid Date:' . $post);
        // fix it.
    }
}

function deleteRow($customerId){
    $conn = connectionToDatabase();
    $deleteSQL = "DELETE FROM customers WHERE CustomerId = " . $customerId . ";";
    return $conn->query($deleteSQL);
    /*if($conn->query($deleteSQL) === false)
        return "  Failed to remove from database!";
    else
        return "  Successfully removed from database!";*/
}

function addRow($name, $location, $telephone, $ipAddress, $fee, $paymentDate, $accessEnd){
    $conn = connectionToDatabase();
    $insertSql = "INSERT INTO customers (CustomerName, Location, Telephone, IpAddress, Fee, PaymentDate, AccessEnd)" .
        "VALUES ('" . $name . "', '". $location . "', '" . $telephone . "', INET_ATON('" . $ipAddress . "'), '" . $fee . "', '";
    if(empty($paymentDate))
        $insertSql .= "CURRENT_DATE()";
    else
        $insertSql .= $paymentDate;
    $insertSql .= "', '" . $accessEnd . "')";
    if($conn->query($insertSql) === false)
        die("(insert) Database Error: " . $conn->error);
}