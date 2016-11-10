<?php
function connectionToDatabase()
{
    $servername = "localhost";
    $username = "root";
    $password = "mysql321";
    $database = "internetserviceprovider";
// Create connection
    $conn = new mysqli($servername, $username, $password, $database);
    unset($servername, $username, $password, $database);
// Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset('utf8');
    unset($servername, $username, $password, $database);
    return $conn;
}


function sanitizeString($string) {
    return htmlspecialchars(stripslashes(trim($string)));
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
    $command = $conn->prepare("INSERT INTO customers (CustomerName, Location, Telephone, IpAddress, Fee, PaymentDate, AccessEnd) " .
        "VALUES (?, ?, ?, INET_ATON(?), ?, ?, ?)");
    $command->bind_param('ssssiss', $name, $location, $telephone, $ipAddress, $fee, $paymentDate, $accessEnd);
    if(!$command->execute()){
        die('Insertion Failed');
    }
    $command->close();

}