<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Sell</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Create a listing</h1>
    <?php
    $nameErr = $phoneErr = $emailErr = $productErr = $typeErr = $brandErr = $charErr = $conditionErr = $descriptionErr = "";
    $name = $phone = $email = $product = $type = $brand = $char = $condition = $description = "";
    $validated = true;
    $phonePattern = "/^[89][0-9]{7}$/";
    $emailPattern = "/^[a-zA-Z0-9.!#$%&’*+=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/";
    $productNumPattern = "/^[a-z]{3}$/";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST["name"])) {
            $nameErr = "Name is required.";
            $validated = false;
        }
        else {
            $name = htmlspecialchars($_POST["name"]);
        }

        // If phone number is empty
        if(empty($_POST["phone"])) {
            $phoneErr = "Phone number is required.";
            $validated = false;
        }
        // If phone number is valid
        else if(preg_match($phonePattern, htmlspecialchars($_POST["phone"]))) {
            $phone = htmlspecialchars($_POST["phone"]);
        }
        // If phone number is not empty but invalid
        else {
            $phone = htmlspecialchars($_POST["phone"]);
            $phoneErr = "Must be a Singapore mobile number.";
            $validated = false;
        }

        // If email is empty
        if(empty($_POST["email"])) {
            $emailErr = "Email is required.";
            $validated = false;
        }
        // If email is valid
        else if(preg_match($emailPattern, $_POST["email"])){
            $email = htmlspecialchars($_POST["email"]);
        }
        // If email is not empty but invalid
        else {
            $email = htmlspecialchars($_POST["email"]);
            $emailErr = "Email not valid.";
            $validated = false;
        }

        $date = date("d-m-y") . "-";
        echo "Date: " . $date . "<br>";
        echo "Your input: " . $_POST["product_num"] . "<br>";
        echo "Input date: " . substr($_POST["product_num"], 0, 9) . "<br>";
        $productFront = substr($_POST["product_num"], 0, 9);
        $productBack = substr($_POST["product_num"], 9);
        // If product number is empty
        if(empty($_POST["product_num"])) {
            $productErr = "Product number is required.";
            $validated = false;
        }
        // If product number is valid
        else if($date == $productFront && preg_match($productNumPattern, $productBack)) {
            echo "Input date matches !" . "<br>";
            $product = htmlspecialchars($_POST["product_num"]);
        }
        // If product number is not empty but invalid
        else {
            $product = htmlspecialchars($_POST["product_num"]);
            $productErr = "Product number must be in the format 'dd-mm-yy-ccc', where 'c' is any alphabet.";
            $validated = false;
        }

        if(empty($_POST["type"])) {
            $typeErr = "Type is required.";
            $validated = false;
        }
        else {
            $type = htmlspecialchars($_POST["type"]);
        }

        if(empty($_POST["brand"])) {
            $brandErr = "Brand is required.";
            $validated = false;
        }
        else {
            $brand = htmlspecialchars($_POST["brand"]);
        }

        if(empty($_POST["char"])) {
            $charErr = "Characteristics is required.";
            $validated = false;
        }
        else {
            $char = htmlspecialchars($_POST["char"]);
        }

        if(empty($_POST["condition"])) {
            $conditionErr = "Condition is required.";
            $validated = false;
        }
        else {
            $condition = htmlspecialchars($_POST["condition"]);
        }

        if(empty($_POST["description"])) {
            $descriptionErr = "Description is required.";
            $validated = false;
        }
        else {
            $description = htmlspecialchars($_POST["description"]);
        }

        if($validated) {
            saveToFile($name, $phone, $email, $product, $type, $brand, $char, $condition, $description);
            echo "Data saved\n";
            Header("Location: home.php");
            exit();
        }
        else {
            echo "Form not complete";
        }
    }

    function saveToFile($name, $phone, $email, $product, $type, $brand, $char, $condition, $description) {
        $sep = ",";
        $dataArray = array($name, $phone, $email, $product, $type, $brand, $char, $condition, $description);
        $data = implode(",", $dataArray) . "\n";
        echo $data;

        $savefile = fopen("ShoesSale.txt", "a") or die("Can't create file");
        fwrite($savefile, $data);
        fclose($savefile);
    }
    ?>
    <div id="main_div" class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
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
            <input type="text" name="product_num" id="product_num" placeholder="Product Number" value="<?php echo $product;?>">
            <div class="error_msg" id="product_num_error_msg"><?php echo $productErr;?></div>
            <label for="type">Type</label>
            <input type="text" name="type" id="type" placeholder="Type" value="<?php echo $type;?>">
            <div class="error_msg" id="type_error_msg"><?php echo $typeErr;?></div>
            <label for="brand">Brand</label>
            <input type="text" name="brand" id="brand" placeholder="Brand" value="<?php echo $brand;?>">
            <div class="error_msg" id="brand_error_msg"><?php echo $brandErr;?></div>
            <hr>
            <label for="char">Characteristics</label>
            <input type="text" name="char" id="char" placeholder="Characteristics" value="<?php echo $char;?>">
            <div class="error_msg" id="char_error_msg"><?php echo $charErr;?></div>
            <label for="condition">Condition</label>
            <input type="text" name="condition" id="condition" placeholder="Condition" value="<?php echo $condition;?>">
            <div class="error_msg" id="condition_error_msg"><?php echo $conditionErr;?></div>
            <label for="description">Description</label>
            <input type="text" name="description" id="description" placeholder="Description" value="<?php echo $description;?>">
            <div class="error_msg" id="description_error_msg"><?php echo $descriptionErr;?></div>
            <hr>
            <input type="submit" value="Submit">
        </form>
    </div>

</body>
