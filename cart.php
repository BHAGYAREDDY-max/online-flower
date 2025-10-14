<?php
session_start();
require 'config.php'; // DB connection file

// Hide PHP errors for cleaner AJAX responses
ini_set('display_errors', 0);
error_reporting(0);

if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    echo "login_required";
    exit;
}


$user_id = $_SESSION['user_id'];


// --- Handle AJAX actions ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    $id = isset($_POST['id']) ? (int) $_POST['id'] : null;
    $name = $_POST['name'] ?? null;
    $price = $_POST['price'] ?? null;
    $image = $_POST['image'] ?? null;

    // Quantity updates
    if ($action && $id) {
        if ($action === 'increase') {
            $conn->query("UPDATE cart_items SET quantity = quantity + 1 WHERE id = $id AND user_id = $user_id");
        } elseif ($action === 'decrease') {
            $conn->query("UPDATE cart_items SET quantity = GREATEST(quantity - 1, 1) WHERE id = $id AND user_id = $user_id");
        } elseif ($action === 'remove') {
            $conn->query("DELETE FROM cart_items WHERE id = $id AND user_id = $user_id");
        }
        exit;
    }

    // Add to cart
    if ($name && $price && $image) {
        $stmt = $conn->prepare("SELECT id FROM cart_items WHERE user_id = ? AND product_name = ?");
        $stmt->bind_param("is", $user_id, $name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $cid = $row['id'];
            $conn->query("UPDATE cart_items SET quantity = quantity + 1 WHERE id = $cid");
        } else {
            $qty = 1;
            $stmt = $conn->prepare("INSERT INTO cart_items (user_id, product_name, price, quantity, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("isdss", $user_id, $name, $price, $qty, $image);
            $stmt->execute();
        }

        echo "$name added to cart.";
        exit;
    }

    echo "Invalid data.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .cart-container {
            max-width: 500px;
            margin:30px auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        }
        .cart-li {
            list-style: none;
            padding: 15px;
            border-bottom: 1px solid #ccc;
        }
        .qty-btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 16px;
        }
        .clear-btn {
            margin-top: 20px;
            background-color: red;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
        header {
            background-color: pink;
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 50px;

        }

        ul .links {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-right: 90px;

        }

        nav ul {
            list-style: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 20px;

        }

        li a {
            text-align: center;
            text-decoration: none;
            color: black;
        }

        li a:hover {
            color: blanchedalmond;

        }

        .Icons {
            display: flex;
            align-items: center;
            gap: 15px;
            /* spacing between icons */
        }

        .user-menu {
            display: inline-block;
            position: relative;
        }

        .user-menu i {
            cursor: pointer;
        }

        .dropdown {
            position: absolute;
            top: 120%;
            /* adjust vertical offset if needed */
            right: 0;
            background: #fff;
            padding: 10px;
            border: 1px solid #ccc;
            z-index: 999;
            width: 150px;
        }
        .chck-btn {
            background-color: green;
            margin-top: 20px;
            color: white;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

<header>
        <div class="logo">Flourishing Florals</div>

        <nav>
            <ul>
                <div class="links">
                    <li><a href="index.php">Home</a> </li>
                    <li><a href="about.php">About us</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="order_history.php">Order</a></li>
                    <li><a href="contact.php">Contact us</a></li>

                </div>

                <li class="Icons">
                    <a href="wishlist.php"><i class="fa-solid fa-heart"></i></a>
                    <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>

                    <div class="user-menu">
                        <i class="fa-solid fa-user" onclick="toggleUserDropdown()"></i>
                        <div id="user-dropdown" class="dropdown" style="display: none;">
                            <?php if (isset($_SESSION['user'])): ?>
                                <p>Hello, <strong><?= htmlspecialchars($_SESSION['user']) ?></strong></p>
                                <a href="logout.php">Logout</a>
                            <?php else: ?>
                                <a href="login.php">Login</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </li>

            </ul>

        </nav>

    </header>


    <h2 style="margin-top: 30px;">Your Cart</h2>

    <div class="cart-container">
        <h3>Cart Items:</h3>
        <ul>
            <?php
            $stmt = $conn->prepare("SELECT * FROM cart_items WHERE user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0):
                while ($item = $result->fetch_assoc()):
                    $total = $item['price'] * $item['quantity'];
                    ?>
                    <li class="cart-li" id="item-<?= $item['id'] ?>">
                        <img src="<?= htmlspecialchars($item['image']) ?>" width="60" height="60"
                            style="vertical-align: middle;">
                        <strong><?= htmlspecialchars($item['product_name']) ?></strong><br>
                        ₹<?= htmlspecialchars($item['price']) ?> × <?= $item['quantity'] ?> =
                        <strong>₹<?= number_format($total, 2) ?></strong><br>

                        Quantity:
                        <button class="qty-btn" onclick="updateQuantity(<?= $item['id'] ?>, 'decrease')">−</button>
                        <?= $item['quantity'] ?>
                        <button class="qty-btn" onclick="updateQuantity(<?= $item['id'] ?>, 'increase')">+</button>
                        <br><br>
                        <button class="clear-btn" onclick="removeItem(<?= $item['id'] ?>)">Remove</button>
                    </li>
                    
                <?php endwhile; else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </ul>
        </ul>
        <?php if ($result->num_rows > 0): ?>
            <a href="checkout.php"><button class="chck-btn">Proceed to Checkout</button></a>
        <?php endif; ?>
    </div>

    <script>
        function updateQuantity(id, action) {
            const formData = new URLSearchParams();
            formData.append('id', id);
            formData.append('action', action);

            fetch('cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: formData
            }).then(() => location.reload());
        }

        function removeItem(id) {
            const formData = new URLSearchParams();
            formData.append('id', id);
            formData.append('action', 'remove');

            fetch('cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: formData
            }).then(() => location.reload());
        }

        function toggleUserDropdown() {
            const dropdown = document.getElementById('user-dropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }
    </script>

</body>

</html>