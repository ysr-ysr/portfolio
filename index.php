<?php
session_start();
include 'config/db.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $subject = htmlspecialchars($_POST['subject']);
  $message = htmlspecialchars($_POST['message']);

  $stmt = $conn->prepare("INSERT INTO contacts(name, email, subject, message) VALUES (?, ?, ?, ?)");
  if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
  }
  $stmt->bind_param("ssss", $name, $email, $subject, $message);
  $stmt->execute();


  $stmt->close();
  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Youssra Zahaf - Web Developer & AI Enthusiast</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: "SF Pro Display", -apple-system, BlinkMacSystemFont,
        "Segoe UI", Roboto, sans-serif;
      background: #0f0a0f;
      color: #ffffff;
      overflow-x: hidden;
      line-height: 1.6;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 20px;
    }

    /* Animated Background */
    .animated-bg {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      background: radial-gradient(circle at 20% 50%,
          rgba(147, 112, 219, 0.3) 0%,
          transparent 50%),
        radial-gradient(circle at 80% 20%,
          rgba(138, 43, 226, 0.3) 0%,
          transparent 50%),
        radial-gradient(circle at 40% 80%,
          rgba(221, 160, 221, 0.4) 0%,
          transparent 50%),
        radial-gradient(circle at 60% 30%,
          rgba(255, 255, 255, 0.1) 0%,
          transparent 50%);
      animation: float 20s ease-in-out infinite;
    }

    @keyframes float {

      0%,
      100% {
        transform: translateY(0px) rotate(0deg);
      }

      33% {
        transform: translateY(-20px) rotate(1deg);
      }

      66% {
        transform: translateY(10px) rotate(-1deg);
      }
    }

    /* Navigation */
    nav {
      position: fixed;
      top: 20px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 1000;
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 50px;
      padding: 10px 30px;
    }

    nav ul {
      list-style: none;
      display: flex;
      gap: 30px;
    }

    nav a {
      color: #ffffff;
      text-decoration: none;
      font-weight: 500;
      transition: all 0.3s ease;
      position: relative;
    }

    nav a:hover {
      color: #9370db;
    }

    nav a::after {
      content: "";
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background: linear-gradient(90deg, #8a2be2, #9370db, #ffffff);
      transition: width 0.3s ease;
    }

    nav a:hover::after {
      width: 100%;
    }

    /* Hero Section */
    .hero {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 100px 0;
    }

    .hero-content {
      flex: 1;
      max-width: 600px;
    }

    .hero-title {
      font-size: 4rem;
      font-weight: 700;
      background: linear-gradient(135deg, #8a2be2, #9370db, #dda0dd, #ffffff);
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      margin-bottom: 20px;
      animation: slideInLeft 1s ease-out;
    }

    .hero-subtitle {
      font-size: 1.5rem;
      color: #a0a0a0;
      margin-bottom: 30px;
      animation: slideInLeft 1s ease-out 0.3s both;
    }

    .hero-description {
      font-size: 1.1rem;
      color: #c0c0c0;
      margin-bottom: 40px;
      animation: slideInLeft 1s ease-out 0.6s both;
    }

    .hero-avatar {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      animation: fadeIn 1s ease-out 0.9s both;
    }

    .avatar {
      width: 300px;
      height: 300px;
      border-radius: 50%;
      background: linear-gradient(135deg, #8a2be2, #9370db, #dda0dd, #ffffff);
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      animation: pulse 4s ease-in-out infinite;
    }

    .avatar::before {
      content: "";
      position: absolute;
      top: -10px;
      left: -10px;
      right: -10px;
      bottom: -10px;
      border-radius: 50%;
      background: linear-gradient(135deg, #8a2be2, #9370db, #dda0dd, #ffffff);
      opacity: 0.3;
      z-index: -1;
      animation: rotate 10s linear infinite;
    }

    .avatar-inner {
      width: 280px;
      height: 280px;
      border-radius: 50%;
      background: #1a0f1a;
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
    }

    .avatar-image {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
      transition: transform 0.3s ease;
    }

    .avatar-inner:hover .avatar-image {
      transform: scale(1.1);
    }

    .avatar-placeholder {
      position: absolute;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #1a0f1a, #2d1b2d);
      color: #9370db;
      font-size: 2rem;
      border-radius: 50%;
    }

    @keyframes pulse {

      0%,
      100% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.05);
      }
    }

    @keyframes rotate {
      from {
        transform: rotate(0deg);
      }

      to {
        transform: rotate(360deg);
      }
    }

    @keyframes slideInLeft {
      from {
        transform: translateX(-100px);
        opacity: 0;
      }

      to {
        transform: translateX(0);
        opacity: 1;
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(50px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Buttons */
    .btn {
      padding: 15px 35px;
      border: none;
      border-radius: 50px;
      font-size: 1rem;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .btn-primary {
      background: linear-gradient(135deg, #8a2be2, #9370db, #dda0dd);
      color: white;
      box-shadow: 0 10px 30px rgba(138, 43, 226, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-3px);
      box-shadow: 0 20px 40px rgba(138, 43, 226, 0.4);
    }

    .btn-secondary {
      background: rgba(255, 255, 255, 0.1);
      color: white;
      border: 1px solid rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(10px);
    }

    .btn-secondary:hover {
      background: rgba(255, 255, 255, 0.2);
      transform: translateY(-3px);
    }

    /* Sections */
    section {
      padding: 100px 0;
    }

    .section-title {
      font-size: 3rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 20px;
      background: linear-gradient(135deg, #8a2be2, #9370db, #dda0dd, #ffffff);
      background-clip: text;
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .section-subtitle {
      text-align: center;
      color: #a0a0a0;
      font-size: 1.2rem;
      margin-bottom: 60px;
    }

    /* Skills Section */
    .skills-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 30px;
      margin-top: 60px;
    }

    .skill-card {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 30px;
      text-align: center;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .skill-card:hover {
      transform: translateY(-10px);
      border-color: #9370db;
      box-shadow: 0 20px 40px rgba(147, 112, 219, 0.2);
    }

    .skill-card::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg,
          transparent,
          rgba(255, 255, 255, 0.1),
          transparent);
      transition: left 0.5s ease;
    }

    .skill-card:hover::before {
      left: 100%;
    }

    .skill-icon {
      font-size: 3rem;
      margin-bottom: 20px;
      color: #9370db;
    }

    .skill-name {
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .skill-level {
      color: #a0a0a0;
    }

    /* Projects Section */
    .projects-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
      gap: 40px;
      margin-top: 60px;
    }

    /* Certifications Section */
    .certifications {
      background: rgba(255, 255, 255, 0.02);
    }

    .certifications-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin-top: 60px;
    }

    .certification-card {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 30px;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .certification-card:hover {
      transform: translateY(-10px);
      border-color: #9370db;
      box-shadow: 0 20px 40px rgba(147, 112, 219, 0.2);
    }

    .certification-card::before {
      content: "";
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg,
          transparent,
          rgba(255, 255, 255, 0.1),
          transparent);
      transition: left 0.5s ease;
    }

    .certification-card:hover::before {
      left: 100%;
    }

    .certification-badge {
      font-size: 3rem;
      text-align: center;
      margin-bottom: 20px;
      filter: drop-shadow(0 0 20px rgba(147, 112, 219, 0.5));
    }

    .certification-content {
      text-align: center;
    }

    .certification-name {
      font-size: 1.3rem;
      font-weight: 600;
      margin-bottom: 10px;
      color: #9370db;
    }

    .certification-issuer {
      color: #c0c0c0;
      font-weight: 500;
      margin-bottom: 8px;
    }

    .certification-date {
      color: #a0a0a0;
      font-size: 0.9rem;
      margin-bottom: 15px;
    }

    .certification-skills {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      justify-content: center;
    }

    .skill-tag {
      background: linear-gradient(135deg,
          rgba(138, 43, 226, 0.2),
          rgba(147, 112, 219, 0.2),
          rgba(255, 255, 255, 0.1));
      border: 1px solid rgba(147, 112, 219, 0.3);
      padding: 4px 12px;
      border-radius: 20px;
      font-size: 0.8rem;
      color: #ffffff;
      font-weight: 500;
    }

    .project-card {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .project-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
    }

    .project-image {
      width: 100%;
      height: 200px;
      background: linear-gradient(135deg, #1a0f1a, #2d1b2d);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      color: #9370db;
      overflow: hidden;
      position: relative;
    }

    .project-icon {
      width: 100%;
      height: 100%;
      object-fit: cover;
      /* mmmm */
      transition: all 0.3s ease;
    }

    .project-card:hover .project-icon {
      transform: scale(1.1);
    }

    .project-icon-fallback {
      font-size: 3rem;
      color: #9370db;
    }

    .project-content {
      padding: 30px;
    }

    .project-title {
      font-size: 1.5rem;
      font-weight: 600;
      margin-bottom: 15px;
      color: #9370db;
    }

    .project-description {
      color: #c0c0c0;
      margin-bottom: 25px;
      line-height: 1.6;
    }

    .project-buttons {
      display: flex;
      gap: 15px;
    }

    /* About Section */
    .about {
      background: rgba(255, 255, 255, 0.02);
    }

    .about-content {
      max-width: 800px;
      margin: 0 auto;
      text-align: center;
    }

    .about-text {
      font-size: 1.2rem;
      line-height: 1.8;
      color: #c0c0c0;
      margin-bottom: 40px;
    }

    /* Contact Section */
    .contact-container {
      max-width: 600px;
      margin: 0 auto;
    }

    .contact-form {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(20px);
      border: 1px solid rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 40px;
      margin-bottom: 40px;
    }

    .form-group {
      margin-bottom: 25px;
    }

    .form-group label {
      display: block;
      margin-bottom: 8px;
      color: #c0c0c0;
      font-weight: 500;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 15px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 10px;
      color: white;
      font-size: 1rem;
      transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
      outline: none;
      border-color: #9370db;
      box-shadow: 0 0 20px rgba(147, 112, 219, 0.2);
    }

    .form-group textarea {
      resize: vertical;
      min-height: 120px;
    }

    .social-links {
      display: flex;
      justify-content: center;
      gap: 30px;
    }

    .social-link {
      width: 60px;
      height: 60px;
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      text-decoration: none;
      font-size: 1.5rem;
      transition: all 0.3s ease;
      overflow: hidden;
      position: relative;
    }

    .social-icon {
      width: 32px;
      height: 32px;
      object-fit: contain;
      filter: brightness(0) saturate(100%) invert(100%);
      transition: all 0.3s ease;
    }

    .social-link:hover .social-icon {
      filter: brightness(0) saturate(100%) invert(100%);
      transform: scale(1.1);
    }

    .social-icon-fallback {
      font-size: 1.5rem;
      color: white;
    }

    .social-link:hover {
      background: linear-gradient(135deg, #8a2be2, #9370db, #dda0dd);
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(147, 112, 219, 0.3);
    }

    /* Footer */
    footer {
      padding: 40px 0;
      text-align: center;
      color: #666;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .hero {
        flex-direction: column;
        text-align: center;
      }

      .hero-title {
        font-size: 2.5rem;
      }

      .hero-subtitle {
        font-size: 1.2rem;
      }

      .avatar {
        width: 200px;
        height: 200px;
      }

      .avatar-inner {
        width: 180px;
        height: 180px;
        font-size: 3rem;
      }

      .section-title {
        font-size: 2rem;
      }

      nav {
        position: relative;
        transform: none;
        margin-bottom: 20px;
      }

      nav ul {
        flex-wrap: wrap;
        justify-content: center;
        gap: 20px;
      }
    }

    /* Scroll animations */
    .fade-up {
      opacity: 0;
      transform: translateY(50px);
      transition: all 0.6s ease;
    }

    .fade-up.visible {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</head>

<body>
  <div class="animated-bg"></div>

  <nav>
    <ul>
      <li><a href="#home">Home</a></li>
      <li><a href="#skills">Skills</a></li>
      <li><a href="#certifications">Certifications</a></li>
      <li><a href="#projects">Projects</a></li>
      <li><a href="#about">About</a></li>
      <li><a href="#contact">Contact</a></li>
    </ul>
  </nav>

  <section id="home" class="hero">
    <div class="container">
      <div style="display: flex; align-items: center; gap: 60px">
        <div class="hero-content">
          <h1 class="hero-title">Youssra Zahaf</h1>
          <h2 class="hero-subtitle">Web Developer & AI Enthusiast</h2>
          <p class="hero-description">
            Crafting innovative digital experiences with cutting-edge
            technology. Passionate about creating solutions that push the
            boundaries of what's possible.
          </p>
          <a href="#contact" class="btn btn-primary">Contact Me ✨</a>
        </div>
        <div class="hero-avatar">
          <div class="avatar">
            <div class="avatar-inner">
              <!-- Replace 'your-photo.jpg' with your actual image path -->
              <img
                src="assets/avatar.jpg"
                alt="Youssra"
                class="avatar-image"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
              <div class="avatar-placeholder" style="display: none"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="skills" class="skills">
    <div class="container">
      <h2 class="section-title fade-up">Skills & Expertise</h2>
      <p class="section-subtitle fade-up">
        Technologies I work with to bring ideas to life
      </p>

      <div class="skills-grid">
        <div class="skill-card fade-up">
          <div class="skill-icon">🌐</div>
          <h3 class="skill-name">Frontend</h3>
          <p class="skill-level">HTML, CSS, JavaScript, PHP</p>
        </div>
        <div class="skill-card fade-up">
          <div class="skill-icon">🐍</div>
          <h3 class="skill-name">Python</h3>
          <p class="skill-level">Backend Development</p>
        </div>
        <div class="skill-card fade-up">
          <div class="skill-icon">💻</div>
          <h3 class="skill-name">Vibe coding</h3>
          <p class="skill-level">Claude, Gemini</p>
        </div>
        <div class="skill-card fade-up">
          <div class="skill-icon">🤖</div>
          <h3 class="skill-name">AI & Automation</h3>
          <p class="skill-level">n8n</p>
        </div>
      </div>
    </div>
  </section>

  <section id="certifications" class="certifications">
    <div class="container">
      <h2 class="section-title fade-up">Certifications & Achievements</h2>
      <p class="section-subtitle fade-up">
        Professional credentials and continuous learning journey
      </p>

      <div class="certifications-grid">
        <div class="certification-card fade-up">
          <div class="certification-badge">🎓</div>
          <div class="certification-content">
            <h3 class="certification-name">
              Virtual Assistant Certification
            </h3>
            <p class="certification-issuer">ALX</p>
            <p class="certification-date">2024</p>
            <div class="certification-skills">
              <span class="skill-tag">Google workspace</span>
              <span class="skill-tag">managing tasks</span>
            </div>
          </div>
        </div>

        <div class="certification-card fade-up">
          <div class="certification-badge">🤖</div>
          <div class="certification-content">
            <h3 class="certification-name">Ai Starter Kit</h3>
            <p class="certification-issuer">ALX</p>
            <p class="certification-date">2025</p>
            <div class="certification-skills">
              <span class="skill-tag">AI tools</span>
              <!-- <span class="skill-tag">Python</span> -->
            </div>
          </div>
        </div>

        <div class="certification-card fade-up">
          <div class="certification-badge">💻</div>
          <div class="certification-content">
            <h3 class="certification-name">Prompt Engineering</h3>
            <p class="certification-issuer">Alison</p>
            <p class="certification-date">2025</p>
            <div class="certification-skills">
              <span class="skill-tag">AI</span>
              <span class="skill-tag">Prompt Engineering</span>
            </div>
          </div>
        </div>

        <div class="certification-card fade-up">
          <div class="certification-badge">🎨</div>
          <div class="certification-content">
            <h3 class="certification-name">Social Media Marketing</h3>
            <p class="certification-issuer">HP</p>
            <p class="certification-date">2025</p>
            <div class="certification-skills">
              <span class="skill-tag">Social Media</span>
              <span class="skill-tag">Marketing</span>
            </div>
          </div>
        </div>

        <div class="certification-card fade-up">
          <div class="certification-badge">✨</div>
          <div class="certification-content">
            <h3 class="certification-name">
              Use Generative AI for Software Development
            </h3>
            <p class="certification-issuer">Google</p>
            <p class="certification-date">2025</p>
            <div class="certification-skills">
              <span class="skill-tag">AI</span>
              <span class="skill-tag">Software Development</span>
            </div>
          </div>
        </div>

        <!-- <div class="certification-card fade-up">
                    <div class="certification-badge">⚡</div>
                    <div class="certification-content">
                        <h3 class="certification-name">Python for Data Science</h3>
                        <p class="certification-issuer">IBM</p>
                        <p class="certification-date">2022</p>
                        <div class="certification-skills">
                            <span class="skill-tag">Python</span>
                            <span class="skill-tag">Data Analysis</span>
                        </div>
                    </div>
                </div> -->
      </div>
    </div>
  </section>

  <section id="projects" class="projects">
    <div class="container">
      <h2 class="section-title fade-up">Featured Projects</h2>
      <p class="section-subtitle fade-up">
        Some of my recent work that showcases my skills
      </p>

      <div class="projects-grid">
        <div class="project-card fade-up">
          <div class="project-image">
            <img
              src="assets/image.png"
              alt="AI Web App"
              class="project-icon"
              onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" />
            <div class="project-icon-fallback" style="display: none">🚀</div>
          </div>
          <div class="project-content">
            <h3 class="project-title">ToDoLuna</h3>
            <p class="project-description">
              An AI-powered task management web application built with
              HTML/CSS, Python and integrated with Gemini API for intelligent
              task suggestions and prioritization.
            </p>
            <div class="project-buttons">
              <a href="https://github.com/ysr-ysr/todo_ai_agent_app" class="btn btn-primary">Github</a>
            </div>
          </div>
        </div>

        <!-- <div class="project-card fade-up">
            <div class="project-image">
              <img
                src="assets/clay.png"
                alt="Automation Dashboard"
                class="project-icon"
                onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
              />
              <div class="project-icon-fallback" style="display: none">⚡</div>
            </div>
            <div class="project-content">
              <h3 class="project-title">Clay Whimsy</h3>
              <p class="project-description">
                A creative website showcasing handmade air-dry clay designs. I
                handled the entire project from including the visual design,
                front-end development, and online promotion. This project helped
                me combine artistic creativity with web development skills.
              </p>
              <div class="project-buttons">
                <a href="#" class="btn btn-primary">View Project</a>
              </div>
            </div>
          </div> -->

        <div class="project-card fade-up">
          <div class="project-image">
            <img
              src="assets/csharp.png"
              alt="Interactive Portfolio"
              class="project-icon"
              onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" />
            <div class="project-icon-fallback" style="display: none">🔮</div>
          </div>
          <div class="project-content">
            <h3 class="project-title">Student Manager</h3>
            <p class="project-description">
              A desktop application that manages student records (add, update, delete, search).
              This project strengthened my skills in C# and Windows Forms.
            </p>
            <div class="project-buttons">
              <a href="https://github.com/ysr-ysr/students-app" class="btn btn-primary">Github</a>

            </div>
          </div>
        </div>

        <div class="project-card fade-up">
          <div class="project-image">
            <img
              src="assets/lumi.png"
              alt="Interactive Portfolio"
              class="project-icon"
              onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" />
            <div class="project-icon-fallback" style="display: none">🔮</div>
          </div>
          <div class="project-content">
            <h3 class="project-title">LumiTech</h3>
            <p class="project-description">
              An e-commerce platform focused on cute and aesthetic tech accessories.
              I built the website using modern HTML/CSS standards, implemented product pages, and optimized user experience.
              The project reflects both my design sense and my understanding of user-centric development.
            </p>
            <div class="project-buttons">
              <a href="https://github.com/ysr-ysr/lumi_tech" class="btn btn-primary">Github</a>

            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <section id="about" class="about">
    <div class="container">
      <h2 class="section-title fade-up">About Me</h2>
      <div class="about-content">
        <p class="about-text fade-up">
          I'm a passionate web developer and AI enthusiast who thrives on
          turning complex problems into elegant, user-friendly solutions. With
          expertise spanning from frontend technologies to backend systems and
          artificial intelligence, I bring a holistic approach to every
          project.
        </p>
        <p class="about-text fade-up">
          My journey in technology is driven by curiosity and a desire to
          create meaningful impact. Whether it's building responsive web
          applications, automating workflows, or exploring the latest AI
          technologies, I'm always eager to push the boundaries of what's
          possible and deliver solutions that exceed expectations.
        </p>
        <a href="assets/youssra_zahaf.pdf" download="assets/youssra_zahaf.pdf" class="btn btn-primary fade-up">Here is my CV 🚀</a>
      </div>
    </div>
  </section>

  <section id="contact" class="contact">
    <div class="container">
      <h2 class="section-title fade-up">Get In Touch</h2>
      <p class="section-subtitle fade-up">
        Ready to bring your ideas to life? Let's connect!
      </p>

      <div class="contact-container">
        <form class="contact-form fade-up" method="POST">
          <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Your Name" required />
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Your Email" required />
          </div>
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" placeholder="Subject" required />
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" placeholder="Your Message" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary" style="width: 100%">
            Send Message ✉️
          </button>
        </form>

        <div class="social-links fade-up">
          <a href="https://www.linkedin.com/in/zyoussra" class="social-link" title="LinkedIn">
            <img
              src="assets/linkedin.png"
              alt="LinkedIn"
              class="social-icon"
              onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" />
            <div class="social-icon-fallback" style="display: none">💼</div>
          </a>
          <a href="https://github.com/ysr-ysr" class="social-link" title="GitHub">
            <img
              src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/github/github-original.svg"
              alt="GitHub"
              class="social-icon"
              onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" />
            <div class="social-icon-fallback" style="display: none">🐙</div>
          </a>
          <a href="https://wa.me/+212602740801" class="social-link" title="Whatsapp">
            <img
              src="assets/whatsapp.png"
              alt="Whatsapp"
              class="social-icon"
              onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" />
            <div class="social-icon-fallback" style="display: none">📞</div>
          </a>
          <a href="mailto:youssrazahafy@gmail.com" class="social-link" title="Email">
            <img
              src="https://img.icons8.com/material-outlined/96/ffffff/email.png"
              alt="Email"
              class="social-icon"
              onerror="this.style.display='none'; this.nextElementSibling.style.display='block';" />
            <div class="social-icon-fallback" style="display: none">📧</div>
          </a>
        </div>
      </div>
    </div>
  </section>

  <footer>
    <div class="container">
      <p>
        &copy; 2025 Youssra Zahaf | Think & Built with ❤️
      </p>
    </div>
  </footer>

  <script>
    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
      anchor.addEventListener("click", function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
          target.scrollIntoView({
            behavior: "smooth",
            block: "start",
          });
        }
      });
    });

    // Scroll animations
    const observerOptions = {
      threshold: 0.1,
      rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
        }
      });
    }, observerOptions);

    document.querySelectorAll(".fade-up").forEach((el) => {
      observer.observe(el);
    });

    
    // Contact form submission animation
document.querySelector(".contact-form").addEventListener("submit", function(e) {
  // Prevent the form from being submitted
  e.preventDefault();

  // On laisse l'envoi se faire normalement
  const button = this.querySelector('button[type="submit"]');
  const originalText = button.textContent;

  // Change visual immediately
  button.textContent = "Sending...";
  button.style.opacity = "0.7";

  // Submit the form using AJAX or fetch
  const formData = new FormData(this);
  fetch(this.action, {
    method: this.method,
    body: formData
  })
  .then(response => {
    // Animation "Message Sent" after a small delay
    setTimeout(() => {
      button.textContent = "Message Sent! ✅";
      button.style.background = "linear-gradient(135deg, #10b981, #059669)";

      // Change the button back to the original state after 2s
      setTimeout(() => {
        button.textContent = originalText;
        button.style.background = "";
        button.style.opacity = "";
        this.reset();
      }, 2000);
    }, 1500);
  })
  .catch(error => {
    console.error("Error:", error);
  });
});
 


  // Add some interactive particles on mouse move
  document.addEventListener("mousemove", (e) => {
  if (Math.random() > 0.98) {
  createParticle(e.clientX, e.clientY);
  }
  });

  function createParticle(x, y) {
  const particle = document.createElement("div");
  particle.style.cssText = `
  position: fixed;
  left: ${x}px;
  top: ${y}px;
  width: 4px;
  height: 4px;
  background: linear-gradient(135deg, #8a2be2, #9370db, #dda0dd);
  border-radius: 50%;
  pointer-events: none;
  z-index: 9999;
  animation: particleFloat 2s ease-out forwards;
  `;

  document.body.appendChild(particle);

  setTimeout(() => {
  particle.remove();
  }, 2000);
  }

  // Add particle animation
  const style = document.createElement("style");
  style.textContent = `
  @keyframes particleFloat {
  0% {
  transform: translateY(0) scale(1);
  opacity: 1;
  }
  100% {
  transform: translateY(-100px) scale(0);
  opacity: 0;
  }
  }
  `;
  document.head.appendChild(style);
  </script>
</body>

</html>