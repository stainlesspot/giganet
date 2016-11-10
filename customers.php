<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="navigationBar.css">
    <link rel="stylesheet" type="text/css" href="customersTable.css">
    <link rel="stylesheet" type="text/css" href="page.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
    <script src="js-utils-master/assets/js/jherax.js"></script>
    <script src="script.js"></script>
    <title>
         THIS IS A TEST SITE - GigaNet inc.
    </title>
</head>
<body>
<?php
    include 'functions.php';
    date_default_timezone_set('Europe/Sofia');

    //$name = $location = $telephone = $ipAddress = $fee = $paymentDate = $accessEnd = "";
    //$conn = connectToDatabase();


    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = sanitizeString($_POST["name"]);
        $location = sanitizeString($_POST["location"]);
        $telephone = sanitizeString($_POST["telephone"]);
        $ipAddress = sanitizeString($_POST["ipAddress"]);
        $fee = sanitizeString($_POST["fee"]);
        $paymentDate = formatAndValidateDate(sanitizeString($_POST['paymentDate']));
        $accessEnd= formatAndValidateDate(sanitizeString($_POST["accessEnd"]));

        addRow($name, $location, $telephone, $ipAddress, $fee, $paymentDate, $accessEnd);
    }


    include 'navigationBar.php';
    printNavigationBar('customers.php');
?>
             <div class="non-menu">
                 <p id="test"></p>
                 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                     <table align='center'>
                         <tr class='head'>
                             <th rowspan='2'>Име</th>
                             <th rowspan='2'>Населено Място</th>
                             <th rowspan='2'>Телефон</th>
                             <th rowspan='2'>IP Адрес</th>
                             <th rowspan='2'>Такса</th>
                             <th colspan='2'>Интернет Достъп</th>
                             <th rowspan='2' colspan='2'>Опции</th>
                         </tr>
                         <tr class='head'>
                             <th>Заплатил</th>
                             <th>Крайна дата</th>
                         </tr>
                         <?php
    $conn = connectionToDatabase();
    $selectSql = "SELECT CustomerId, CustomerName, Location, Telephone, INET_NTOA(IpAddress) AS IpAddress, Fee,".
    "DATE_FORMAT(PaymentDate, '%d.%m.%Y') AS PaymentDate, DATE_FORMAT(AccessEnd, '%d.%m.%Y') AS AccessEnd FROM customers;";
    $result = $conn->query($selectSql);
    if($conn->errno)
        die("Database error: " . $conn->error);
    if ($result->num_rows > 0) {
        $rowId = 0;
        $rowToCustomerId[0] = 0;
        $selectedLocation = $selectedTelephone = '';
        while ($row = $result->fetch_assoc()) {
            $rowId++;
            $rowToCustomerId[$rowId] = $row["CustomerId"];
            echo        "<tr rowspan='2' data-id='" . $rowId . "'" . "><td class='notNull'><span class='editable name' title='Редактирай'>" . $row["CustomerName"] . "</span></td>" .
                            "<td class='couldBeNull pointerCursor'><span class='editable location' title='Редактирай'>" . $row["Location"] . "</span></td>" .
                            "<td class='couldBeNull pointerCursor'><span class='editable telephone' title='Редактирай'>" . $row["Telephone"] . "</span></td>" .
                            "<td class='notNull'><span class='editable ipAddress' title='Редактирай'>" . $row["IpAddress"] . "</span></td>" .
                            "<td class='notNull'><span class='editable fee' title='Редактирай'>" . $row["Fee"] . "</span> лв.</td>" .
                            "<td> " . $row["PaymentDate"] . " г.</td>" .
                            "<td>" . $row["AccessEnd"] . " г.</td>" .
                            "<td>
                                <span class='buttonAddContract' title='Издаване на бележка'></span>
                <span class='buttonRemove' title='Премахване на реда'></span>
            </td>";
        }
        $_SESSION['customerIds'] = $rowToCustomerId;
    }
    ?>
                         <tr>
                             <td><input title='Име' type='text' name='name' class="text" required></td>
                             <td><input title='Населено Място' type='text' name='location' class="text"></td>
                             <td><input title="Телефон" type='number' name='telephone' class="text"></td>
                             <td><input title="IP адрес" type='text' name='ipAddress' class="text" required></td>
                             <td class ='fee'><input title="Такса" type='number' name='fee' value='20' class='fee' required> лв.</td>
                             <td><input title="Заплатил" type='date' name='paymentDate' value='<?php echo date('Y-m-d')?>' required></td>
                             <td><input title="Крайна дата" type='date' name='accessEnd' value ='<?php echo date('Y-m-d', strtotime('+1 month'))?>' required></td>
                             <td><input type='submit' value='Добавяне'></td>
                        </tr>
     </table>
     </form>
    <button class="testButton">TEST</button>
    <p class="testable">test here</p>
    <div class="hide_div">
        <span id="clicker">Click me не работиииии</span>
    </div>
    <!--<p id='error'>test text</p>
    <button id="buttonTest">TEST</button>-->
</div>
<footer><a class='Icons8' href="https://icons8.com">Icon pack by Icons8</a></footer>
</body>
</html>