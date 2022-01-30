<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <link rel="stylesheet" href="style.css">
    <title>Listing</title>
</head>
<body>
    <?php
    $searchError = "";
    if (!empty($_GET['search'])) {
        $query = htmlspecialchars($_GET['search']);
        $readFile = fopen("ShoesSale.txt", "r") or die("File does not exist");
        while(($line = fgets($readFile)) !== false) {
            $allData = explode(",", $line);
            if($query == $allData[3]) {
                echo $query . " found: " . $allData[3];
                fclose($readFile);
                Header("Location: details.php?product_num=" . $query);
                exit();
            }
        }
        $searchError = $query . " does not exist.";
    }
    ?>
    <form method="get">
        <p>Search product number: <input type="text" name="search"><input type="submit"><span class="error_msg" id="search_error"><?php echo $searchError;?></span></p>
    </form>
    <table border="1" cellspacing="0" cellpadding="5">
        <tr>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>Product Number</th>
            <th>Type</th>
            <th>Brand</th>
            <th>Characteristics</th>
            <th>Condition</th>
            <th>Description</th>
        </tr>
        <?php
            $readFile = fopen("ShoesSale.txt", "r") or die("File does not exist");
            while(($line = fgets($readFile)) !== false) {
                $allData = explode(",", $line);
                echo "<tr>";
                foreach($allData as $data) {
                    echo "<td>$data</td>";
                }
                echo "</tr>";
            }
            fclose($readFile);
        ?>
    </table>
</body>
