<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);
require_once('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About the Developer</title>
  <!-- Use Bootstrap from CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <h1>About the Developer</h1>
    <div class="row">
      <div class="col-md-4">
        <!-- Developer's Picture -->
        <img src="images/developer.jpg" class="img-fluid img-thumbnail" alt="Developer's Picture" style="max-width: 100%;">
      </div>
      <div class="col-md-8">
        <h2>Bionote</h2>
        <ul class="list-unstyled">
          <li><strong>Full Name:</strong> Rohna Mae Maraon</li>
          <li><strong>Contact:</strong> rohnamae@gmail.com</li>
          <li><strong>Address:</strong> 123 Developer Lane, City, Country</li>
          <li><strong>Programming Languages Used/Expert:</strong> 
            <ul>
              <li>PHP</li>
              <li>JavaScript</li>
              <li>HTML & CSS</li>
              <li>Python</li>
              <li>SQL</li>
            </ul>
          </li>
          <li><strong>System/Project Developed and Accomplished:</strong> 
            <ul>
              <li>Inventory Management System</li>
              <li>E-commerce Website</li>
              <li>Customer Ticketing System</li>
            </ul>
          </li>
          <li><strong>Other Information:</strong> A passionate developer focused on creating innovative solutions using open-source technologies.</li>
        </ul>
      </div>
    </div>
  </div>
</body>
</html>