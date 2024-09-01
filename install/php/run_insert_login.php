<?php

// Include the file where the insert_login function is defined

use Php\DbImport;

require_once 'D:/xamp/htdocs/xainhotel/install/php/DbImport.php';

// Ensure session is started to access $_SESSION variables
session_start();
$DbImport     = new DbImport();
// Call the insert_login function
$result = $DbImport->insert_login();

// Output result
if ($result) {
    echo "Insert successful!";
} else {
    echo "Insert failed!";
}

?>