<?php
    $partial = $_REQUEST['q'];
    $field = $_REQUEST['h'];
    include 'Unit5_database_credentials.php';
    include 'Unit5_database.php';
    $conn = getConnection();
    partialName($conn, $partial, $field);
?>