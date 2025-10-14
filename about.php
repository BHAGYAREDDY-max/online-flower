<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="about.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
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

    <section class="about">
        <div class="about1">
            <img src="bg-img.jpg">
        </div>
        <section class="desc">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellendus ea amet atque labore et non
                sapiente velit quisquam odio omnis animi delectus suscipit vitae culpa eligendi, consectetur quia
                corporis ut.</p>


        </section>
        <section class="mission">
            <h2 style="text-align: center;">our mission</h2>
            <p style="text-align: center;"> fresh flower at your doorstep</p>
            <div class="flowers">
                <img src="rosebouquet.jpg">


                <div class="flowdesc">
                    <h2>Fresh flowers</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, saepe recusandae maxime
                        molestiae nulla eum quam tempore officiis cumque nobis quibusdam sapiente ipsam magni quod
                        doloribus inventore, ipsum praesentium ratione!</p>
                </div>

            </div>


            <div class="flowers">
                <img src="rosebouquet.jpg">
                <div class="flowdesc">
                    <h2>Delivery in 24 hours</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, saepe recusandae maxime
                        molestiae nulla eum quam tempore officiis cumque nobis quibusdam sapiente ipsam magni quod
                        doloribus inventore, ipsum praesentium ratione!</p>
                </div>
            </div>

            <div class="flowers">
                <img src="rosebouquet.jpg">
                <div class="flowdesc">
                    <h2>order online</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi, saepe recusandae maxime
                        molestiae nulla eum quam tempore officiis cumque nobis quibusdam sapiente ipsam magni quod
                        doloribus inventore, ipsum praesentium ratione!</p>
                </div>

            </div>
        </section>

    </section>
    <script>
function toggleUserDropdown() {
    const dropdown = document.getElementById('user-dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}
    </script>
    
</body>

</html>