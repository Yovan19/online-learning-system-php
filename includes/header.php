<?php
// Include the database connection
include 'config.php';
// Any other common setup code (e.g., session start)
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Primary meta tag -->
  <title>EduWeb - The Best Program to Enroll for Exchange</title>
  <meta name="title" content="EduWeb - The Best Program to Enroll for Exchange">
  <meta name="description" content="This is an education HTML template made by Yovan">

  <!-- Favicon -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- Custom CSS links -->
  <link rel="stylesheet" href="./public/frontend/css/style.css">
  <link rel="stylesheet" href="./public/frontend/css/custom_styles.css">

  <!-- Google Font links -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@400;500;600;700;800&family=Poppins:wght@400;500&display=swap" rel="stylesheet">

  <!-- Preload images -->
  <link rel="preload" as="image" href="./public/frontend/images/hero-bg.svg">
  <link rel="preload" as="image" href="./public/frontend/images/hero-banner-1.jpg">
  <link rel="preload" as="image" href="./public/frontend/images/hero-banner-2.jpg">
  <link rel="preload" as="image" href="./public/frontend/images/hero-shape-1.svg">
  <link rel="preload" as="image" href="./public/frontend/images/hero-shape-2.png">
</head>

<body id="top">

  <!-- Header -->
  <header class="header" data-header>
    <div class="container">

      <!-- Logo -->
      <a href="#" class="logo">
        <img src="./public/frontend/images/logo.svg" width="162" height="50" alt="EduWeb logo">
      </a>

      <!-- Navbar -->
      <nav class="navbar" data-navbar>
        <div class="wrapper">
          <a href="#" class="logo">
            <img src="./public/frontend/images/logo.svg" width="162" height="50" alt="EduWeb logo">
          </a>

          <button class="nav-close-btn" aria-label="close menu" data-nav-toggler>
            <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
          </button>
        </div>

        <ul class="navbar-list">
          <li class="navbar-item">
            <a href="#courses" class="navbar-link" data-nav-link>Courses</a>
          </li>
          <li class="navbar-item">
            <a href="#about" class="navbar-link" data-nav-link>About</a>
          </li>
          <li class="navbar-item">
            <!-- Header Actions -->
            <div class="header-actions">
              <a href="#" class="btn has-before">
                <ion-icon name="person-add-outline" aria-hidden="true"></ion-icon>
                <span class="span">Sign Up / Sign In</span>
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <div class="overlay" data-nav-toggler data-overlay></div>

    </div>
  </header>

  <!-- Main content START -->
  <main>