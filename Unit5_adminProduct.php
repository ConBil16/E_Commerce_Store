<!DOCTYPE html>
<?php
include 'Unit5_database.php';
$conn = getConnection();
$data = getCustomers($conn);
$productsData = getProducts($conn);
?> 


<html>
<head>
        <title>adminProduct</title>
        <link rel="stylesheet" href="Unit5_adminProduct.css">
        <link rel="stylesheet" href="Unit5_common.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type = "text/javascript" src="Unit5_productScript.js"></script>
</head>
<body>
<?php include 'Unit5_header.php';?>
    <main>
        <div class="left">
            <!-- #This is where the product table goes. -->
        <h1> Products </h1>
            <div class="table" id="table" onclick="highlight_row()">
            <table>
                <tr>
                    <th> Product </th>
                    <th> Image name </th>
                    <th> Price </th>
                    <th> Quantity </th>
                    <th> Inactive? </th>
                </tr>
                <?php
                    $sql = "SELECT id, product_name, image_name, price, in_stock, inactive FROM product";
                    $cusResult = $conn->query($sql);
                    if($cusResult -> num_rows > 0){
                        while($row = $cusResult-> fetch_assoc()){
                            if ($row['inactive'] == '1'){
                                $inactive = "Yes";
                            }
                            else{
                                $inactive = "";
                            }
                            echo "<tr><td style='display:none;'>" . $row['id'] . "</td><td>" . $row["product_name"] . "</td><td>" . $row['image_name'] . "</td><td>" . $row['price'] . "</td><td>" . $row['in_stock'] . "</td><td>". $inactive . "</td></tr>";
                        }
                        echo "</table>";
                    }
                    else{
                        echo "No Products";
                    }
                ?>
            </div>
        </div>

    
        <div class= "right">
        <form id = "myForm">
        <h3 id=errorMessage></h3> 
        <fieldset class="contactDetails">
                <legend><span>Product Information</span></legend>
                <input type="hidden" id="product_id" name="product_id">

                <label for="productName">Product Information: * </label>
                <input type="text" name="name" id="name">
                <br />
                <label for="imageName">Image Name: * </label>
                <input type="text" name="imageName" id="imageName">
                <br />
                <label for="quantity">Quantity</label>
                <input type="number" id="Quantity" name="Quantity">
                <br />
                <label for="price">Price</label>
                <input type="number" id="Price" name="Price" step=".01">
                <br />
                <label for="inactive">Inactive</label>
                <input type="checkbox" id="checkBox" name="checkBox">
                <br />
            </fieldset>


            <div class="buttons">
                <input type="submit" id="daSubmit" value="Add Product" onclick="buttonPressed(this)">
                <button type="button" id="Delete" onclick="buttonPressed(this)">Delete</button>
                <button type="button" id="Update" onclick="buttonPressed(this)">Update</button>
            </div>
        </form>
        </div>

    </main>
    

    <?php include 'Unit5_footer.php';?>

</body>
</html>
