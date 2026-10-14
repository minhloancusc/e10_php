<?php
session_start();
require_once './config/myconnection.php';
require_once './model/productclass.php';
$conn = MyConnection::connectDatabase();
$product = new ProductClass();
?>
<?php
//remove cart
if (isset($_GET['action']) && $_GET['action'] == "remove") {
    foreach ($_SESSION["cart"] as $key => $value) {
        if ($_GET["id"] == $key)
            unset($_SESSION["cart"][$key]);
        if (empty($_SESSION["cart"]))
            unset($_SESSION["cart"]);
    }
}
if (isset($_GET['action']) && $_GET['action'] == "empty") {
    unset($_SESSION["cart"]);
}
?>  

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="style.css" rel="stylesheet"/>
        <title>Cart Shopping</title>
    </head>
    <body>
        <div id="shopping-cart">
            <div class="txt-heading">Shopping Cart</div>
            <a id="btnEmpty" href="cart_process.php?action=empty">Empty Cart</a>
            <?php
            if (isset($_SESSION["cart"])) {
                $total_quantity = 0;
                $total_price = 0;
                ?>	
                <table class="tbl-cart" cellpadding="10" cellspacing="1">
                    <tbody>
                        <tr>
                            <th style="text-align:left;">Product ID</th>
                            <th style="text-align:left;">Product Name</th>
                            <th style="text-align:right;" width="5%">Quantity</th>
                            <th style="text-align:right;" width="10%">Unit Price</th>
                            <th style="text-align:right;" width="10%">Price</th>
                            <th style="text-align:center;" width="5%">Remove</th>
                        </tr>	
                        <?php
                        foreach ($_SESSION["cart"] as $item => $value) {
                            $item_price = $value["quantity"] * $value["price"];
                            ?>
                            <tr>
                                <td><img src="<?php echo $value["image"]; ?>" class="cart-item-image" /><?php echo $item; ?></td>
                                <td><?php echo $value["name"]; ?></td>
                                <td style="text-align:right;"><?php echo $value["quantity"]; ?></td>
                                <td  style="text-align:right;"><?php echo "$ " . $value["price"]; ?></td>
                                <td  style="text-align:right;"><?php echo "$ " . number_format($item_price, 2); ?></td>
                                <td style="text-align:center;"><a href="?action=remove&id=<?php echo $item; ?>" class="btnRemoveAction"><img src="images/icons/icondelete.png" alt="Remove Item" width="16px" /></a></td>
                            </tr>
                            <?php
                            $total_quantity += $value["quantity"];
                            $total_price += ($value["price"] * $value["quantity"]);
                        }
                        ?>

                        <tr>
                            <td colspan="2" align="right">Total:</td>
                            <td align="right"><?php echo $total_quantity; ?></td>
                            <td align="right" colspan="2"><strong><?php echo "$ " . number_format($total_price, 2); ?></strong></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>		
                <?php
            } else {
                ?>
                <div class="no-records">Your Cart is Empty</div>

                <?php
            }
            ?>
            <div class="no-records">
                <p class="card-text">
                    <a href="product_list.php" class="btn btn-primary btn-sm">
                        CONTINUOUS SHOPPING
                    </a>
                </p>
            </div>
        </div>
    </body>
</html>