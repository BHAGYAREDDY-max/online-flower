<?php
session_start();
$_SESSION['cart'] = [];  // Clear the cart
header("Location: cart.php"); // Redirect to cart page
exit();
?>
