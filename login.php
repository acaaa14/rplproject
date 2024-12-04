<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Pop - Login</title>
    <link rel="stylesheet" href="assets/css/sytleslogin.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
    <header>
    <div class="header-logo">
        <img src="assets/images/gambarlogo.png" alt="Logo CakePop" class="logo-img">
        <h1 class="logo">Cake <span>Pop</span></h1>
    </div>
    <nav>
        <ul class="nav-links">
            <li><a href="#">Home</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">Contact Us</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <li><a href="logout.php">Logout</a></li> <!-- Logout jika sudah login -->
            
            <?php endif; ?>
        </ul>
    </nav>
    
</header>


        <main>
            <div class="login-box">
                <h2>Login</h2>
                <form action="login_process.php" method="POST">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Email" required>

                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>

                    <div class="remember-me">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">Remember Me</label>
                    </div>

                    <button type="submit" class="btn-login">Login</button>
                </form>
                <p class="register-link">Don't have an account? <a href="register.php">Register here.</a></p>
            </div>
        </main>

        <!-- Footer Section -->
        <footer>
            <div class="footer-container">
                <div class="footer-brand">
                    <h3>Cake <span>Pop</span></h3>
                    <p>Delicious freshly baked cakes for every occasion.</p>
                    <div class="social-links">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-instagram"></i></a>
                    </div>
                </div>
                <div class="footer-links">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>
                <div class="newsletter">
                    <h4>Newsletter</h4>
                    <form>
                        <input type="email" placeholder="Your email">
                        <button type="submit" class="btn btn-green">Sign Up</button>
                    </form>
                </div>
            </div>
            <p>&copy; 2024 Cake Pop. All Rights Reserved.</p>
        </footer>
    </div>
</body>
</html>
