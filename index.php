<?php 
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $siteSettings['site_description']; ?>">
    <title><?php echo $siteSettings['site_title']; ?></title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/images/logo.png">
    <link rel="shortcut icon" type="image/png" href="assets/images/logo.png">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="#home" class="logo"><?php echo $personalInfo['name']; ?></a>
            
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <ul class="nav-menu" id="navMenu">
                <li><a href="#home" class="nav-link">Home</a></li>
                <li><a href="#about" class="nav-link">About</a></li>
                <li><a href="#skills" class="nav-link">Skills</a></li>
                <li><a href="#projects" class="nav-link">Projects</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1 class="hero-title">Hi, I'm <span class="highlight"><?php echo $personalInfo['name']; ?></span></h1>
                    <h2 class="hero-subtitle"><?php echo $personalInfo['title']; ?></h2>
                    <p class="hero-tagline"><?php echo $personalInfo['tagline']; ?></p>
                    
                    <div class="hero-buttons">
                        <a href="#projects" class="btn btn-primary">View My Work</a>
                        <a href="#contact" class="btn btn-secondary">Get In Touch</a>
                    </div>
                    
                    <div class="social-links">
                        <?php foreach($socialLinks as $platform => $url): ?>
                            <a href="<?php echo $url; ?>" target="_blank" class="social-icon" aria-label="<?php echo ucfirst($platform); ?>">
                                <i class="fab fa-<?php echo $platform; ?>"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="hero-image">
                    <div class="profile-image-container">
                        <img src="<?php echo $personalInfo['profile_image']; ?>" 
                             alt="<?php echo $personalInfo['name']; ?>" 
                             class="profile-image"
                             onerror="this.src='https://ui-avatars.com/api/?name=<?php echo urlencode($personalInfo['name']); ?>&size=400&background=ef4444&color=fff&bold=true'">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <h2 class="section-title">About Me</h2>
            <div class="about-content">
                <div class="about-image">
                    <img src="assets/images/yamamoto.jpg" 
                         alt="About <?php echo $personalInfo['name']; ?>" 
                         class="about-img"
                         onerror="this.src='https://images.unsplash.com/photo-1498050108023-c5249f4df085?w=600&h=400&fit=crop'">
                </div>
                <div class="about-text">
                    <h3 class="about-subtitle">Who I Am</h3>
                    <p><?php echo $about['description']; ?></p>
                    <a href="<?php echo $about['resume_link']; ?>" class="btn btn-outline" download>
                        <i class="fas fa-download"></i> Download Resume
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="skills">
        <div class="container">
            <h2 class="section-title">My Skills</h2>
            <div class="skills-grid">
                <?php foreach($skills as $category => $skillList): ?>
                    <div class="skill-category">
                        <h3 class="skill-category-title"><?php echo $category; ?></h3>
                        <div class="skill-tags">
                            <?php foreach($skillList as $skill): ?>
                                <span class="skill-tag"><?php echo $skill; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="projects">
        <div class="container">
            <h2 class="section-title">My Projects</h2>
            <div class="projects-grid">
                <?php 
                $projectCount = 0;
                foreach($projects as $project): 
                    $projectCount++;
                    $hiddenClass = ($projectCount > 5) ? 'project-hidden' : '';
                ?>
                    <div class="project-card <?php echo $hiddenClass; ?>">
                        <div class="project-image">
                            <img src="<?php echo $project['image']; ?>" alt="<?php echo $project['title']; ?>" onerror="this.src='mypicture.jpg=<?php echo urlencode($project['title']); ?>'">
                            <div class="project-overlay">
                                <a href="<?php echo $project['demo_link']; ?>" class="project-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Demo
                                </a>
                                <a href="<?php echo $project['github_link']; ?>" class="project-link" target="_blank">
                                    <i class="fab fa-github"></i> Code
                                </a>
                            </div>
                        </div>
                        <div class="project-info">
                            <h3 class="project-title"><?php echo $project['title']; ?></h3>
                            <p class="project-description"><?php echo $project['description']; ?></p>
                            <div class="project-tech">
                                <?php foreach($project['technologies'] as $tech): ?>
                                    <span class="tech-tag"><?php echo $tech; ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <?php if(count($projects) > 5): ?>
                <div class="show-more-container">
                    <button id="showMoreBtn" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Show More Projects
                    </button>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2 class="section-title">Get In Touch</h2>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>Email</h4>
                            <a href="mailto:<?php echo $personalInfo['email']; ?>"><?php echo $personalInfo['email']; ?></a>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h4>Phone</h4>
                            <p><?php echo $personalInfo['phone']; ?></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h4>Location</h4>
                            <p><?php echo $personalInfo['location']; ?></p>
                        </div>
                    </div>
                </div>
                
                <form class="contact-form" id="contactForm" action="api/contact.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="name" class="form-input" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-input" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="subject" class="form-input" placeholder="Subject" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" class="form-input" rows="5" placeholder="Your Message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                    <div id="formMessage" class="form-message"></div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo $siteSettings['copyright_year']; ?> <?php echo $personalInfo['name']; ?>. All rights reserved.</p>
            <div class="footer-social">
                <?php foreach($socialLinks as $platform => $url): ?>
                    <a href="<?php echo $url; ?>" target="_blank" class="social-icon" aria-label="<?php echo ucfirst($platform); ?>">
                        <i class="fab fa-<?php echo $platform; ?>"></i>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </footer>

    <!-- Custom JavaScript -->
    <script src="assets/js/script.js"></script>
</body>
</html>
