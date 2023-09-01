<?php
    include 'Unit5_database_credentials.php';
    include 'Unit5_database.php';
    $conn = getConnection();
    //Fetching Values from URL

    $name = $_POST['name'];
    $imageName = $_POST['imageName'];
    $quantity = $_POST['Quantity'];
    $price = $_POST['Price'];
    $inactive = $_POST['checkBox'];
    $type = $_POST['type'];
    $id = $_POST['product_id'];


    if($inactive == 'off'){
        $randomName = 0;
    }

    else{
        $randomName = 1;
    }

    if($type == 'add'){
        //Add this product to the database
        addProduct($conn, $name, $imageName, $quantity, $price, $randomName);
    }
    else if($type == 'update'){
        updateProduct ($conn, $name, $imageName, $quantity, $price, $randomName, $id);
    }
    else{
        $orderExists = orderExists($conn, $id);
        if($orderExists){
            echo "Can't delete, there are existing orders of this product";
        }
        else{
            deleteProduct($conn, $id);
        }
        
    }
    
?>