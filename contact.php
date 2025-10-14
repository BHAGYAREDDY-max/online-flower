<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flourishing Florals</title>
    <link rel="stylesheet" href="contact.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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

    <body>
        <section class="contact">
            <div class="c-box">
                <div class="cbox1">
                    <h2>Contact Us </h2>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Esse dicta saepe velit vel rerum
                        architecto tempore, provident impedit eligendi exercitationem earum odit quia sunt deserunt
                        aspernatur? Accusantium nisi amet beatae!
                    </p>
                </div>
            </div>
            <div class="service">
                <h2>Our Service</h2>
                <p>Just a few click to make the reservation online for saving time and money</p>
            </div>

            <div class="ship">
                <div class="freeship">
                    <img src="daisybouqu2.jpg" alt="">
                    <h2>Freeshipping</h2>
                </div>

                <div class="freeship">
                    <img src="daisybouqu2.jpg" alt="">
                    <h2>Money Back Guarantee</h2>
                </div>

            </div>
            <div class="contact">
                <h2>Our Contact Details </h2>

            </div>

            <div class="Contact-box2">

                <div class="freeship two">
                    <img src="location.png" alt="">
                    <div class="Contact-box">
                        <h3>Address</h3>
                        <p>abc complex<br>
                            mallikatte<br>
                            mangalore
                        </p>
                    </div>

                </div>

                <div class="freeship two">
                    <img src="phone-call.png" alt="">
                    <div class="Contact-box">
                        <h3>Phone number</h3>
                        <p>778899664455</p>
                        <P>9483084528</P>

                    </div>

                </div>

                <div class="freeship two">
                    <img src="mail.png" alt="">
                    <div class="Contact-box">
                        <h3>Email</h3>
                        <p>ashwinifloral123@gmail.com</p>
                        <p>Bhagya123@gmail.com</p>
                    </div>

                </div>
            </div>
        </section>

        <script>
function toggleUserDropdown() {
    const dropdown = document.getElementById('user-dropdown');
    dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
}
        </script>
        
    </body>

</html>