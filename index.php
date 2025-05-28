<?php include('includes/config.php'); ?>
<?php include('includes/header.php'); ?>


<div class="container mt-5">
    <!-- Hero Section -->
    <section class="hero-section text-center mb-5">
        <div class="container">
            <h1 class="display-4 mb-4 animate-on-scroll">Explore Development Service</h1>
            <p class="lead mb-4 animate-on-scroll" style="animation-delay: 0.2s">Transform Your Vision into Stunning Web Experiences</p>
            <div class="animate-on-scroll" style="animation-delay: 0.4s">
                <a class="btn btn-gradient btn-lg" href="services.php" role="button">
                    Explore Our Services <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Services Preview -->
    <h2 class="text-center mb-5 display-4">Our Expertise</h2>
    <div class="row">
        <div class="col-md-4 mb-4 animate-on-scroll">
            <div class="card h-100 p-3">
                <div class="card-body text-center">
                    <i class="fas fa-paint-brush service-icon"></i>
                    <h5 class="card-title mb-3">Frontend Development</h5>
                    <p class="card-text text-muted">Crafting pixel-perfect interfaces with modern interactivity</p>
                    <ul class="list-unstyled text-left">
                        <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>HTML</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>CSS</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Bootstrap</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Javascript</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4 animate-on-scroll" style="animation-delay: 0.2s">
            <div class="card h-100 p-3">
                <div class="card-body text-center">
                    <i class="fas fa-server service-icon"></i>
                    <h5 class="card-title mb-3">Backend Development</h5>
                    <p class="card-text text-muted">Building scalable architecture for complex systems</p>
                    <ul class="list-unstyled text-left">
                        <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>Node.js / Python / PHP</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>API Development / MySql</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Cloud Integration</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4 animate-on-scroll" style="animation-delay: 0.4s">
            <div class="card h-100 p-3">
                <div class="card-body text-center">
                    <i class="fas fa-code service-icon"></i>
                    <h5 class="card-title mb-3">Full Stack Solutions</h5>
                    <p class="card-text text-muted">End-to-end development for complete web solutions</p>
                    <ul class="list-unstyled text-left">
                        <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>MERN Stack </li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success mr-2"></i>PHP Lamp</li>
                        <li><i class="fas fa-check-circle text-success mr-2"></i>Laravel</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <section class="cta-section animate-on-scroll">
        <div class="container text-center">
            <h3 class="mb-4">Start Your Digital Journey Today</h3>
            <p class="mb-4 lead">Get exclusive access to our premium development services</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="register.php" class="btn btn-gradient px-4 py-2">
                    <i class="fas fa-rocket mr-2"></i>Launch Project
                </a>
                <a href="contact.php" class="btn btn-outline-primary px-4 py-2">
                    <i class="fas fa-comments mr-2"></i>Consultation
                </a>
            </div>
        </div>
    </section>
</div>



<style>
    :root {
        --primary-color: #2A2A72;
        --secondary-color: #009FFD;
        --gradient: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    }

    .hero-section {
        background: var(--gradient) center/cover;
        color: white;
        padding: 6rem 0;
        border-radius: 15px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }

    .card {
        border: none;
        transition: transform 0.3s, box-shadow 0.3s;
        border-radius: 15px;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .service-icon {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: var(--primary-color);
    }

    .cta-section {
        background: #f8f9fa;
        padding: 4rem 0;
        border-radius: 15px;
        margin: 4rem 0;
    }

    .btn-gradient {
        background: var(--gradient);
        color: white;
        border: none;
        padding: 0.8rem 2rem;
        border-radius: 30px;
        transition: transform 0.3s;
    }

    .btn-gradient:hover {
        color: white;
        transform: translateY(-2px);
    }

    .animate-on-scroll {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s ease-out;
    }

    .animate {
        opacity: 1;
        transform: translateY(0);
    }
</style>

<script>
    // Intersection Observer for scroll animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.animate-on-scroll').forEach((element) => {
        observer.observe(element);
    });
</script>

<?php include('includes/footer.php'); ?>