<!DOCTYPE html>
<?php
include 'Unit5_database.php';
$conn = getConnection();
$data = getCustomers($conn);
$productsData = getProducts($conn);
date_default_timezone_set("America/Denver");
?> 

<html>
    <head>
        <title>Connor's exotic goods</title>
        <link rel="stylesheet" href="Unit5_common.css">
        <link rel="stylesheet" href="Unit5_store.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    </head>
<body>
    <?php include 'Unit5_header.php';?>
    <main>
        <form  action="Unit5_process_orders.php" method="post">

            <div class = "image">
                <h3>Select a product</h3>
                <img id = "placeholder"></img>
                <h3 id="Stock"></h3>
            </div>

            <fieldset class="contactDetails">
                <legend><span>Personal Information</span></legend>
                
                <label for="name">First Name: </label>
                <input type="text" name="name" id="name" pattern="[A-Za-z ']{1,}" title="Only letters, ' and spaces allowed" required>
                <br />
                <label for="secondname">Last Name: </label>
                <input type="text" name="secondname" id="secondname" pattern="[A-Za-z ']{1,}"  required>
                <br />
                <label for="email">Enter your email:</label>
                <input type="email" id="email" name="email" required>
            </fieldset>

            <div class = "Selection">
                <legend><span>Product Information</span><legend>
                <select name = "selection" id="drinks" onchange="myFunction(this.value)" required>
                    <option value="" disabled selected hidden>Please Choose a product</option>
                    <?php if ($productsData): ?>
                        <?php foreach($productsData as $row): ?>
                            <?php if ($row['inactive'] != 1): ?>
                                <option value=<?=$row['id']?> data-instock="<?=$row['in_stock']?>" data-image="<?=$row['product_name']?>"><?=$row['product_name']?> $<?=$row['price']?></option>
                            <?php endif ?> 
                         <?php endforeach ?>
                    <?php endif ?>
                </select>
                <label for="Quantity">Quantity:</label>
                <input type="number" id="Quantity" name="Quantity" min="0" max="100" value="1" required><br>
            </div>

            <div class = "Donation">
            <p> Round up to the nearest dollar for a donation? </p>
                <input type="radio" id="Yes" name="Yes/No" value="Yes" checked>
                <label for="Yes">Yes</label><br>
                <input type="radio" id="No" name="Yes/No" value="No">
                <label for="No">No</label><br>
            <input type="hidden" name="timestamp" value="<?php echo time(); ?>">
            <input type="submit" value="Submit">
        </form>
    </main>
    

    <?php include 'Unit5_footer.php';?>
    <script>
        const viewedProducts = [];

        function myFunction(x) {
            

        }
        
        document.querySelector('select').onchange = function(){   
            //Displays the image
            var x = this.selectedOptions[0].getAttribute('data-image');
            if(!viewedProducts.includes(x)){
                viewedProducts.push(x);
            }
            var json_str = JSON.stringify(viewedProducts);
            createCookie('mycookie', json_str);

            var y = "Images/"+this.selectedOptions[0].getAttribute('data-image')+".jpg";
            var image = document.getElementById("placeholder");
            image.setAttribute('src', y);
            //This will report the stock amount
            var numStock = this.selectedOptions[0].getAttribute('data-instock');
            var stockText = document.getElementById("Stock");
            if(numStock == 0){
                stockText.innerHTML = "Sorry we are out of stock"
                stockText.style.color = "red";
                //Update text here
            }
            else if(numStock < 5){
                stockText.innerHTML = "Hurry! We only have " + numStock + " left";
                stockText.style.color = "orange";
            }
            else{
                stockText.innerHTML = ""
                stockText.style.color = "";
            }


        };

    //function createCookie and getCookie where orignally from https://stackoverflow.com/questions/4825683/how-do-i-create-and-read-a-value-from-cookie
        
    function createCookie(name, value, days) {
        var expires;
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        else {
            expires = "";
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    


    </script>

</body>
</html>