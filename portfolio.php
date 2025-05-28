<?php include('includes/config.php'); ?>
<?php include('includes/header.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Portfolio</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    /* Base Styles */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Arial', sans-serif; line-height: 1.6; }

    /* Hero Section */
    .hero {
      height: 100vh;
      background: linear-gradient(45deg, #2c3e50, #3498db);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
    .hero h1 { font-size: 4rem; margin-bottom: 20px; }
    .hero p { font-size: 1.5rem; margin-bottom: 30px; }
    .cta-button {
      padding: 15px 30px;
      background: #e74c3c;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: 0.3s;
    }
    .cta-button:hover { background: #c0392b; }

    /* Projects Grid */
    .projects {
      padding: 50px 20px;
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      background: #f9f9f9;
    }
    .project-card {
      background: white;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
      transition: 0.3s;
    }
    .project-card:hover { transform: translateY(-10px); }

    /* Skills Section */
    .skills {
      padding: 50px 20px;
      background: #fff;
      text-align: center;
    }
    .skill-icon {
      font-size: 2.5rem;
      margin: 15px;
      color: #3498db;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .hero h1 { font-size: 2.5rem; }
      .projects { grid-template-columns: 1fr; }
    }
  </style>
</head>
<body>
  <!-- Hero Section -->
  <section class="hero">
    <div>
      <h1>Hi, I'm Noman Riaz</h1>
      <p>A passionate developer building awesome things.</p>
      <button class="cta-button">Explore My Work</button>
    </div>
  </section>

  <!-- Projects Grid -->
  <section class="projects">
    <div class="project-card">
      <h3>Project 1</h3>
      <p>A responsive web app built with React and Node.js.</p>
      <a href="#">Live Demo</a>
      <a href="#">GitHub</a>
    </div>
    <!-- Add more project cards -->
  </section>

  <!-- Skills Section -->
  <section class="skills">
    <h2>Skills</h2>
    <i class="fab fa-html5 skill-icon"></i>
    <i class="fab fa-css3 skill-icon"></i>
    <i class="fab fa-js skill-icon"></i>
    <i class="fab fa-react skill-icon"></i>
  </section>
</body>
</html>

<?php include('includes/footer.php'); ?>