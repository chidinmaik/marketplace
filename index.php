<?php
session_start();
require 'config.php';

// Handle newsletter subscription
$newsletter_message = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['subscribe'])) {
    $email = $conn->real_escape_string($_POST['email']);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $conn->query("INSERT INTO newsletters (email) VALUES ('$email')");
        $newsletter_message = 'Thank you for subscribing!';
    } else {
        $newsletter_message = 'Please enter a valid email address.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jmart - Your Online Marketplace</title>
    <link rel="stylesheet" href="css/index.css">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="homepage-header">
        <div class="container">
            <div class="header-content">
                <h1 class="logo">Jmart</h1>
                <button class="hamburger" aria-label="Toggle Navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <nav class="header-nav">
                    <?php if (isset($_SESSION['username'])): ?>
                        <span class="welcome-text">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                        <a href="<?php echo $_SESSION['role'] == 'admin' ? 'admin_dashboard.php' : 'dashboard.php'; ?>" class="nav-button">Go to Dashboard</a>
                        <a href="logout.php" class="nav-button secondary">Logout</a>
                    <?php else: ?>
                        <a href="register.php" class="nav-button">Register</a>
                        <a href="login.php" class="nav-button secondary">User Login</a>
                        <a href="admin_login.php" class="nav-button secondary">Admin Login</a>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1 class="hero-title">Welcome to Jmart</h1>
            <p class="hero-subtitle">Explore our curated selection of social media accounts, streaming services, and VPNs.</p>
            <a href="<?php echo isset($_SESSION['username']) ? ($_SESSION['role'] == 'admin' ? 'admin_dashboard.php' : 'dashboard.php') : 'register.php'; ?>" class="cta-button">Get Started</a>
        </div>
        <!-- Floating Icons -->
        <div class="floating-icons">
            <i class="fas fa-users floating-icon icon-1"></i>
            <i class="fas fa-video floating-icon icon-2"></i>
            <i class="fas fa-shield-alt floating-icon icon-3"></i>
        </div>
    </section>

    <!-- Service Section -->
    <section class="services">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <div class="services-grid">
                <div class="service-card" data-animate="fadeInUp">
                    <i class="fas fa-users service-icon"></i>
                    <h3 class="service-title">Social Media Accounts</h3>
                    <p class="service-description">Buy and sell verified social media accounts with ease and security.</p>
                </div>
                <div class="service-card" data-animate="fadeInUp">
                    <i class="fas fa-video service-icon"></i>
                    <h3 class="service-title">Streaming Services</h3>
                    <p class="service-description">Access premium streaming accounts for your favorite shows and movies.</p>
                </div>
                <div class="service-card" data-animate="fadeInUp">
                    <i class="fas fa-shield-alt service-icon"></i>
                    <h3 class="service-title">VPNs</h3>
                    <p class="service-description">Secure your online presence with top-tier VPN services.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about-us">
        <div class="container">
            <h2 class="section-title">About Us</h2>
            <div class="about-content">
                 <div class="about-image">
                    <img src="images/about-us.jpeg" alt="About Jmart">

                </div>
                <div class="about-text">
                    <p class="about-description">Jmart is your trusted online marketplace, dedicated to providing high-quality digital services. We connect buyers and sellers globally, ensuring secure transactions and exceptional customer support. Join our community today and explore a world of opportunities.</p>
                </div>
             
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">What Our Customers Say</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <p class="testimonial-text">"Jmart made it so easy to find a verified social media account. The process was secure and hassle-free!"</p>
                    <p class="testimonial-author">— Sarah K.</p>
                </div>
                <div class="testimonial-card">
                    <p class="testimonial-text">"I love the streaming accounts I purchased through Jmart. Great prices and excellent support."</p>
                    <p class="testimonial-author">— Michael T.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call-to-Action Section -->
    <section class="cta-section">
        <div class="container">
            <h2 class="cta-title">Ready to Get Started?</h2>
            <p class="cta-subtitle">Join Jmart today and discover a world of digital services.</p>
            <a href="register.php" class="cta-button">Join Now</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="homepage-footer">
        <div class="container">
            <!-- Newsletter Subscription -->
            <div class="newsletter">
                <h3 class="newsletter-title">Stay Updated</h3>
                <p class="newsletter-subtitle">Subscribe to our newsletter for the latest offers.</p>
                <form method="POST" action="" class="newsletter-form">
                    <input type="email" name="email" placeholder="Enter your email" required>
                    <button type="submit" name="subscribe">Subscribe</button>
                </form>
                <?php if ($newsletter_message): ?>
                    <p class="newsletter-message <?php echo strpos($newsletter_message, 'Thank you') !== false ? 'success' : 'error'; ?>">
                        <?php echo $newsletter_message; ?>
                    </p>
                <?php endif; ?>
            </div>
            <p>Jmart © <?php echo date('Y'); ?></p>
        </div>
    </footer>

    <!-- JavaScript for Hamburger Menu and Animations -->
    <script>
        // Hamburger Menu Toggle
        const hamburger = document.querySelector('.hamburger');
        const nav = document.querySelector('.header-nav');

        hamburger.addEventListener('click', () => {
            nav.classList.toggle('active');
            const icon = hamburger.querySelector('i');
            icon.classList.toggle('fa-bars');
            icon.classList.toggle('fa-times');
        });

        // Scroll Animation for Service Cards
        const animateOnScroll = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const cards = entry.target.querySelectorAll('[data-animate]');
                    cards.forEach((card, index) => {
                        card.style.animation = `${card.dataset.animate} 1s ease-out ${index * 0.2}s forwards`;
                    });
                    observer.unobserve(entry.target);
                }
            });
        };

        const observer = new IntersectionObserver(animateOnScroll, {
            threshold: 0.2
        });

        document.querySelectorAll('.services').forEach(section => {
            observer.observe(section);
        });
    </script>
</body>
</html>