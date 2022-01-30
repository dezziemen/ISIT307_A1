<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <title>Buy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
    if(isset($_GET['product_num'])) {
        $query = htmlspecialchars($_GET['product_num']);
        $readfile = fopen("ShoesSale.txt", "r") or die("File does not exist");
        while(($line = fgets($readfile)) !== false) {
            $allData = explode(",", $line);
            if($query == $allData[3]) {
                echo $query . " found: " . $allData[3];
                fclose($readfile);
                return;
            }
        }
        echo $query . " does not exist.";
    }
?>
</body><?php
