<!DOCTYPE php>
<head>
    <link rel="stylesheet" href="Unit5_proces_orders.css">
    <link rel="stylesheet" href="Unit5_common.css">

    <style>
        .my_class{
            border: dotted 10px black;
            background-color: aquamarine;
            color: blue;
            width: 400px;
            text-align: center;
        }
    </style>
</head>
<body onload="test()">
    <?php include 'Unit5_header.php';?>
    <?php
    date_default_timezone_set("America/Denver");
    include'Unit5_database.php';

    $conn = getConnection();

    //Creating the variables needed
    $first = $_POST['name'];
    $second = $_POST['secondname'];
    $email = $_POST['email'];
    $amount = $_POST['Quantity'];
    $donation = $_POST['Yes/No'];
    $productID = $_POST['selection'];
    $currentTime = $_POST['timestamp'];
    $productInfo = findProductbyId($conn, $productID);
    $purchase = $productInfo['product_name']; //OHHH the productInfo in an array with all the information and you can access it!
    $price = $productInfo['price']; //Wow that makes so much sense! 
    $productQuanity = $productInfo['in_stock']; //In order to check for quantity
    $taxRate = .75;
    $donationAmount = 0;

    
    $returning = findCustomer($conn, $email);
    //$productID = returnProduct($conn, $purchase); Shouldn't need this variable anymore as it's been initiated correctly


    $total = $price; //Should be redundent
    $subtotal = $total * $amount;
    $tax = $subtotal * $taxRate; //This calculates just the tax for that particular product, very simple!
    $totalW = $subtotal + $tax;


    echo '<div class="my_class">';
    if ($returning){
        echo "<p><strong>Hello, $first $second - </strong><em>Welcome back!</em></p>";
        echo "<p>We hope you enjoy your $purchase!</p>";
        echo "<p>Order details:</p>";
       } 
    else{
        echo "<br>Thank you for your order, $first $second $email <br>";
        newCustomer($conn, $first, $second, $email);
    }

    echo "You have selected $amount $purchase @ $total <br>";
    $customerID = returnCustomer($conn, $email); 
    echo "Subtotal: $$subtotal <br>";
    echo "Total including tax (75%): $" . round($totalW, 2) . "<br>";

    if($donation == "Yes"){
        $donationAmount = ceil($totalW) - $totalW;
        $totalW = ceil($totalW);
        echo "Total with Donation: $$totalW";
    }
    $totalW = round($totalW, 2);

    echo "<p id = 'recommended'></p>";

    echo '</div>';
    
    createOrder($conn, $customerID, $productID, $amount, $price, $tax, $donationAmount, $currentTime, $productQuanity);


    ?>

    
    <?php include 'Unit5_footer.php';?> 
    <script>
        function test(){
            var json_str = getCookie('mycookie');
            var arr = JSON.parse(json_str);
            if(arr.length > 1){
                document.getElementById('recommended').innerHTML = "Based on your viewing history we'd like to offer you 20% off these items:<br>"
                document.getElementById('recommended').innerHTML += "<ul>";
                for (var i = 0; i < arr.length; i++){
                    document.getElementById('recommended').innerHTML += "<br>";
                    document.getElementById('recommended').innerHTML += "<li>" + arr[i] + "</li>"
                }
                document.getElementById('recommended').innerHTML += "</ul>";
            }
            
        }

        function getCookie(c_name) {
            if (document.cookie.length > 0) {
                c_start = document.cookie.indexOf(c_name + "=");
                if (c_start != -1) {
                    c_start = c_start + c_name.length + 1;
                    c_end = document.cookie.indexOf(";", c_start);
                    if (c_end == -1) {
                        c_end = document.cookie.length;
                    }
                    return unescape(document.cookie.substring(c_start, c_end));
                }
            }
            return "";
        }
    </script>
</body>

