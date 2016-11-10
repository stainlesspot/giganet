<?php
function printNavigationBar($activeFile){
    $files = ['Начало'=>'index.php', 'Абонати'=>'customers.php', 'Настройки'=>'options.php', 'За нас'=>'about.php', 'Договор'=>'contract.php'];
    echo "<h1 align='center'><strong>GIGA NET</strong></h1>".
    "<nav><ul>";
    foreach($files as $navName=>$navFile){
        echo "<li><a href='" . $navFile . "'";
        if($activeFile == $navFile)
            echo " class='navActive'";
        echo ">$navName</a></li>";
    }
    echo "</ul></nav>";
}