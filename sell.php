<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Sell</title>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
$nameErr = $phoneErr = $emailErr = $productErr = $typeErr = $brandErr = $charErr = $conditionErr = $descriptionErr = "";
$name = $phone = $email = $product = $type = $brand = $char = $condition = $description = "";
$validated = true;
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

    if(empty($_POST["product_num"])) {
        $productErr = "Product number is required.";
        $validated = false;
    }
    else {
        $product = htmlspecialchars($_POST["product_num"]);
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Name">
            <div class="error_msg" id="name_error_msg"><?php echo $nameErr;?></div>
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" placeholder="Phone">
            <div class="error_msg" id="phone_error_msg"><?php echo $phoneErr;?></div>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" placeholder="Email">
            <div class="error_msg" id="email_error_msg"><?php echo $emailErr;?></div>
            <hr>
            <label for="product_num">Product Number</label>
            <input type="text" name="product_num" id="product_num" placeholder="Product Number">
            <div class="error_msg" id="product_num_error_msg"><?php echo $productErr;?></div>
            <label for="type">Type</label>
            <input type="text" name="type" id="type" placeholder="Type">
            <div class="error_msg" id="type_error_msg"><?php echo $typeErr;?></div>
            <label for="brand">Brand</label>
            <input type="text" name="brand" id="brand" placeholder="Brand">
            <div class="error_msg" id="brand_error_msg"><?php echo $brandErr;?></div>
            <hr>
            <label for="char">Characteristics</label>
            <input type="text" name="char" id="char" placeholder="Characteristics">
            <div class="error_msg" id="char_error_msg"><?php echo $charErr;?></div>
            <label for="condition">Condition</label>
            <input type="text" name="condition" id="condition" placeholder="Condition">
            <div class="error_msg" id="condition_error_msg"><?php echo $conditionErr;?></div>
            <label for="description">Description</label>
            <input type="text" name="description" id="description" placeholder="Description">
            <div class="error_msg" id="description_error_msg"><?php echo $descriptionErr;?></div>
            <hr>
            <input type="submit" value="Submit">
        </form>
    </div>

</body>
