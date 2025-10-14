<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
        echo "login_required";
        exit;
    }

    $name = $_POST['name'] ?? null;
    $price = $_POST['price'] ?? null;
    $image = $_POST['image'] ?? null;

    if ($name && $price && $image) {
        if (!isset($_SESSION['wishlist']) || !is_array($_SESSION['wishlist'])) {
            $_SESSION['wishlist'] = [];
        }

        $exists = false;
        foreach ($_SESSION['wishlist'] as $item) {
            if ($item['name'] === $name) {
                $exists = true;
                break;
            }
        }

        if (!$exists) {
            $_SESSION['wishlist'][] = [
                'name' => $name,
                'price' => $price,
                'image' => $image
            ];
        }

        echo "$name added to wishlist.";
    } else {
        echo "Invalid product data.";
    }

    exit; // 🛑 Stop HTML from loading!
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flourishing Florals</title>
    <link rel="stylesheet" href="shop.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            text-align: center;
        }

        h2 {
            margin-top: 30px;
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .pbox {
            width: 220px;
            border: 1px solid #000;
            padding: 10px;
            margin: 10px;
            background: #f0ffff;
            text-align: center;
        }

        .pbox img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .buttons button {
            margin: 6px;
            padding: 6px 12px;
            font-family: Arial, sans-serif;
            cursor: pointer;
        }

        .icon-buttons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin-top: 10px;
        }

        .icon-buttons button {
            background: none;
            border: none;
            cursor: pointer;
        }

        .icon-buttons i {
            font-size: 20px;
        }



        .shopbutton {
            margin-top: 15px;
            display: flex;
            gap: 15px;
        }

        .shopbutton form {
            display: inline-block;
        }

        .shopbutton button {
            background-color: #fbb;
            border: 1px solid #000;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
        }
    </style>
    <style>
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
    </style>


</head>

<body>
    <header>
        <div class="logo">Online Flower Shop</div>

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

    <section class="shop">
        <div class="rose">
            <div class="image-box">
                <img src="rosebouquet.jpg" alt="">
                <p class="price">Price : ₹250</p>
            </div>

            <div class="redrose">
                <h2>Red Roses</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit quo natus autem? Iusto magnam,
                    similique corporis, quia quos temporibus vel accusantium amet.</p>

                <div class="shopbutton">
                    <form onsubmit="addToCart(event, 'Rose Bouquet', 250, 'rosebouquet.jpg')">
                        <button type="submit">Add to cart</button>
                    </form>
                    <form onsubmit="addToWishlist(event, 'Rose Bouquet', 250, 'rosebouquet.jpg')">
                        <button type="submit">Add to wishlist</button>
                    </form>
                </div>
            </div>
        </div>

        <?php
        // Array of 24 products with names and prices
        $products = [
            // Section 1: Similar Products
            ['name' => 'Rose Mix', 'price' => 250],
            ['name' => 'Tulip Bunch', 'price' => 320],
            ['name' => 'Lily Love', 'price' => 270],
            ['name' => 'Sunflower Joy', 'price' => 300],

            // Section 2: Flowers with Bouquet
            ['name' => 'Romantic Roses', 'price' => 450],
            ['name' => 'Blush Bouquet', 'price' => 400],
            ['name' => 'Mixed Charm', 'price' => 420],
            ['name' => 'Valentine Special', 'price' => 499],

            // Section 3: Flowers with Vase
            ['name' => 'Vase of Beauty', 'price' => 550],
            ['name' => 'Elegant Display', 'price' => 600],
            ['name' => 'Fresh Vibes', 'price' => 575],
            ['name' => 'Pastel Vase', 'price' => 620],

            // Section 4: Top Seasonal Picks
            ['name' => 'Spring Blossom', 'price' => 330],
            ['name' => 'Winter White', 'price' => 390],
            ['name' => 'Autumn Glow', 'price' => 365],
            ['name' => 'Summer Splash', 'price' => 410],

            // Additional Products
            ['name' => 'Pink Paradise', 'price' => 370],
            ['name' => 'Orchid Fantasy', 'price' => 520],
            ['name' => 'Carnation Magic', 'price' => 430],
            ['name' => 'Peach Bloom', 'price' => 290],
            ['name' => 'Golden Love', 'price' => 540],
            ['name' => 'White Elegance', 'price' => 580],
            ['name' => 'Charming Blooms', 'price' => 360],
            ['name' => 'Floral Delight', 'price' => 395],
        ];

        // Heading mapping
        $sections = [
            0 => "Similar Products",
            4 => "Flowers with Bouquet",
            8 => "Flowers with Vase",
            12 => "Top Seasonal Picks"
        ];

        // Render products
        foreach ($products as $i => $product):
            if (isset($sections[$i]))
                echo "<h2>{$sections[$i]}</h2><div class='products'>";
            ?>

            <div class="pbox">
                <img src="rosebouquet.jpg" alt="<?= htmlspecialchars($product['name']) ?>">
                <div class="buttons">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <p>Price: ₹<?= htmlspecialchars($product['price']) ?></p>
                    <button>Buy Now</button>

                    <div class="icon-buttons">
                        <form
                            onsubmit="addToWishlist(event, '<?= $product['name'] ?>', <?= $product['price'] ?>, 'rosebouquet.jpg')">
                            <button type="submit"><i class="fa-solid fa-heart" style="color: red;"></i></button>
                        </form>
                        <form
                            onsubmit="addToCart(event, '<?= $product['name'] ?>', <?= $product['price'] ?>, 'rosebouquet.jpg')">
                            <button type="submit"><i class="fa-solid fa-cart-shopping" style="color: green;"></i></button>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            // close row after section ends
            $next = $i + 1;
            if (isset($sections[$next]) || $next === count($products))
                echo "</div>";
        endforeach;
        ?>

    </section>
    <script>
        const isLoggedIn = <?= isset($_SESSION['user']) ? 'true' : 'false' ?>;
    </script>
    <script>

        function addToWishlist(event, name, price, image) {
            event.preventDefault();

            const formData = new URLSearchParams();
            formData.append('name', name);
            formData.append('price', price);
            formData.append('image', image);

            fetch('wishlist.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: formData
            })
                .then(res => res.text())
                .then(response => {
                    if (response === 'login_required') {
                        alert("Please log in to add items to wishlist.");
                    } else {
                        alert(response);
                    }
                });
        }

    </script>

    <script>
        function addToCart(event, name, price, image) {
            event.preventDefault();

            const formData = new URLSearchParams();
            formData.append('name', name);
            formData.append('price', price);
            formData.append('image', image);

            fetch('cart.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: formData
            })
                .then(res => res.text())
                .then(response => {
                    if (response === 'login_required') {
                        alert("Please log in to add items to cart.");
                    } else {
                        alert(response); // e.g., "Rose Bouquet added to cart."
                    }
                });
        }
        function toggleUserDropdown() {
            const dropdown = document.getElementById('user-dropdown');
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        }


    </script>

</body>

</html>