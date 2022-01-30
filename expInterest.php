<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Express interest</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
$nameErr = $phoneErr = $emailErr = $productErr = $priceErr = "";
$name = $phone = $email = $price = "";


$product = htmlspecialchars($_GET["product_num"]);
$validated = true;
$params = "?";
$first = true;
foreach($_GET as $key => $val) {
    if(!$first) {
        $params .= "&";
    }
    else {
        $first = false;
    }
    $params .= $key . "=" . $val;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["name"])) {
        $nameErr = "Name is required.";
        $validated = false;
    }
    else {
        $name = htmlspecialchars($_POST["name"]);
    }

    if(empty($_POST["phone"])) {
        $phoneErr = "Phone number is required.";
        $validated = false;
    }
    else {
        $phone = htmlspecialchars($_POST["phone"]);
    }

    if(empty($_POST["email"])) {
        $emailErr = "Email is required.";
        $validated = false;
    }
    else {
        $email = htmlspecialchars($_POST["email"]);
    }

    if(empty($_POST["price"])) {
        $priceErr = "Price is required.";
        $validated = false;
    }
    else {
        $price = htmlspecialchars($_POST["price"]);
    }

    if($validated) {
        saveToFile($product, $name, $phone, $email, $price);
        Header("Location: home.php");
        echo "Data saved\n";
        exit();
    }
    else {
        echo "Form not complete";
    }
}

function saveToFile($product, $name, $phone, $email, $price) {
    $sep = ",";
    $dataArray = array($product, $name, $phone, $email, $price);
    $data = implode(",", $dataArray) . "\n";
    echo $data;

    $savefile = fopen("ExpInterest.txt", "a") or die("Can't create file");
    fwrite($savefile, $data);
    fclose($savefile);
}
?>
<div id="main_div" class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . $params;?>" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" placeholder="Name" value="<?php echo $name;?>">
        <div class="error_msg" id="name_error_msg"><?php echo $nameErr;?></div>
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" placeholder="Phone" value="<?php echo $phone;?>">
        <div class="error_msg" id="phone_error_msg"><?php echo $phoneErr;?></div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" placeholder="Email" value="<?php echo $email;?>">
        <div class="error_msg" id="email_error_msg"><?php echo $emailErr;?></div>
        <hr>
        <label for="product_num">Product Number</label>
        <input type="text" name="product_num" id="product_num" placeholder="Product Number" value="<?php echo $product;?>" readonly>
        <div class="error_msg" id="product_num_error_msg"><?php echo $productErr;?></div>
        <label for="price">Price</label>
        <input type="text" name="price" id="price" placeholder="Price" value="<?php echo $price;?>">
        <div class="error_msg" id="price_error_msg"><?php echo $priceErr;?></div>
        <hr>
        <input type="submit" value="Submit">
    </form>
</div>

</body>
