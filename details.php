<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <title>View product details</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Details of shoes</h1>
    <div class="container">
        <?php
            if(isset($_GET['product_num'])) {
                $query = htmlspecialchars($_GET['product_num']);
                $readFile = fopen("ShoesSale.txt", "r") or die("File does not exist");
                while(($line = fgets($readFile)) !== false) {
                    $allData = explode(",", $line);
                    if($query == $allData[3]) {
                        fclose($readFile);

                        $countInterest = 0;
                        $readInterest = fopen("ExpInterest.txt", 'r') or die("File does not exist");
                        while(($lineInterest = fgets($readInterest)) !== false) {
                            $allInterest = explode(",", $lineInterest);
                            if($allInterest[0] == $query) {
                                $countInterest++;
                            }
                        }
                        fclose($readInterest);

                        echo '
                            <form action="expInterest.php?product_num=' . $allData[3] . '" method="get">
                                <label for="product_num">Product Number</label>
                                <input type="text" name="product_num" value="' . $allData[3] . '" readonly>
                                <label for="type">Type</label>
                                <input type="text" name="type" value="' . $allData[4] . '" readonly>
                                <label for="brand">Brand</label>
                                <input type="text" name="brand" value="' . $allData[5] . '" readonly>
                                <label for="char">Characteristics</label>
                                <input type="text" name="char" value="' . $allData[6] . '" readonly>
                                <label for="condition">Condition</label>
                                <input type="text" name="cond" value="' . $allData[7] . '" readonly>
                                <label for="desc">Description</label>
                                <input type="text" name="desc" value="' . $allData[8] . '" readonly>
                                <label for="interest_num">Number of interests</label>
                                <input type="text" name="interest_num" value="' . $countInterest . '" readonly>
                                <input type="submit" value="Express Interest">
                            </form>';
                        return;
                    }
                }
                echo $query . " does not exist.";
            }
        ?>
    </div>
</body>
