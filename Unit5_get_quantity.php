
<?php
    $q = $_GET['q'];
    include 'Unit5_database_credentials.php';
    include 'Unit5_database.php';
    $conn = getConnection();
    $return = findQuantityById($conn, $q);
    $returnValue = $return['in_stock'];
    echo "$returnValue";
?>

