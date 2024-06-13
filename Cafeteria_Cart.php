<?php
session_start();


$foodItems = [
    1 => ['name' => 'Budget plate english breakfast', 'price' => 'R45.00', 'image' => 'budget plate english breakfast.jpg'],
    2 => ['name' => 'Budget plate rice and stew', 'price' => 'R45.00', 'image' => 'budget plate rice and stew.jpg'],
    3 => ['name' => 'sandwich chicken', 'price' => 'R45.00', 'image' => 'sandwich chicken.jpg'],
    4 => ['name' => 'Coca-cola', 'price' => 'R25.00', 'image' => 'coca-cola.jpg'],
    5 => ['name' => 'Orange Juice', 'price' => 'R20.00', 'image' => 'orange-juice.jpg'],
    6 => ['name' => 'Lays', 'price' =>'R20.00' , 'image' => 'lays.jpg'],
    7 => ['name' => 'Doritos', 'price' => 'R20.00', 'image' => 'doritosjpg'],
    8 => ['name' => 'standard plate english breakfast', 'price' => 'R55.00', 'image' => 'standard plate english breakfast.jpg'],
    9 => ['name' => 'standard plate rice and stew ', 'price' => 'R55.00', 'image' => 'standard plate rice and stew.jpg'],
    10 => ['name' => 'Cookies', 'price' => 'R45.00', 'image' => 'cookies.jpg'],
];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['remove'])) {
        $id = $_POST['remove'];
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
    }
}

// Calculating total items and total price
$totalItems = 0;
$totalPrice = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalItems += $item['quantity'];
    $totalPrice += $item['quantity'] * $item['price'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <style>
        .cart-item {
            display: flex;
            align-items: center;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        .cart-item img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }
        .cart-item .info {
            flex-grow: 1;
        }
        .cart-item .remove-btn {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .cart-summary {
            text-align: center;
            margin-top: 20px;
        }
        .proceed-btn {
            background-color: green;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
        }
    </style>
</head>
<body>

<h1>My Cart</h1>

<?php if (!empty($_SESSION['cart'])): ?>
    <?php foreach ($_SESSION['cart'] as $id => $item): ?>
        <div class="cart-item">
            <img src="images/<?php echo $item['image']; ?>" alt="<?php echo $item['name']; ?>">
            <div class="info">
                <p><?php echo $item['name']; ?> - $<?php echo $item['price']; ?> x <?php echo $item['quantity']; ?></p>
                <p>Total: $<?php echo $item['price'] * $item['quantity']; ?></p>
            </div>
            <form method="post">
                <button class="remove-btn" type="submit" name="remove" value="<?php echo $id; ?>">Remove</button>
            </form>
        </div>
    <?php endforeach; ?>
    <div class="cart-summary">
        <p>Total Items: <?php echo $totalItems; ?></p>
        <p>Total Price: $<?php echo $totalPrice; ?></p>
    </div>
    <form method="post" action="payment.php">
        <button class="proceed-btn" type="submit">Proceed to Payment</button>
    </form>
<?php else: ?>
    <p>Your cart is empty.</p>
<?php endif; ?>

</body>
</html>
