<?php
session_start();
require_once './config/myconnection.php';
require_once './model/productclass.php';
$conn = MyConnection::connectDatabase();
$product = new ProductClass();
?>
<?php
//add cart
if (isset($_GET['action']) && $_GET['action'] == "add") {
    $id = intval($_GET['id']);
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity']++;
    } else {
        $result = $product->findProductsbyID($conn, $id);
        $row = $result->fetch_assoc();
        if (isset($row['ProductID'])) {
            $_SESSION['cart'][$row['ProductID']] = array("name" => $row['ProductName'], "quantity" => 1, "price" => $row['UnitPrice'], "image" => $row['ImageURL']);
        } else {
            $message = "This product id is invalid!";
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="style.css" rel="stylesheet"/>
        <title>View Product</title>

    </head>
    <body>
        <a href="cart_process.php"><img src="./images/icons/iconshoppingcart.png" width="50px"/>GO TO THE CART</a>        
        <?php
        if (isset($_SESSION['cart'])) {
            $total_quantity = 0;
            $total_price = 0;
            foreach ($_SESSION['cart'] as $x => $value) {
                $total_quantity += intval($value["quantity"]);
                $total_price += doubleval($value["price"]) * intval($value["quantity"]);
            }
            echo "<p>Number of product in cart: " . $total_quantity . "</p>";
            echo "<p>Total price: $" . $total_price . "</p>";
        } else {
            echo '<p>Cart is empty</p>';
        }
        ?>
        <?php
        $result = $product->showAllProducts($conn);
        if ($result->num_rows > 0) {
            ?>
            <div class="row">
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-3  mt-2">
                        <div class="card">
                            <a href="">
                                <img src="./<?= $row['imageURL'] ?>" width="100px"/>

                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="">
                                        ID: <?php echo $row['ProductID'] ?>
                                    </a>
                                </h5>
                                <strong>$<?php echo $row['UnitPrice'] ?></strong>

                                <p class="card-t">
                                    <?php echo $row['ProductName'] ?>
                                </p>
                                <p class="card-text">
                                    <a href="product_view.php?action=add&id=<?php echo $row['ProductID'] ?>" class="btn btn-primary btn-sm">
                                        Add Cart
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>

    </body>
</html>