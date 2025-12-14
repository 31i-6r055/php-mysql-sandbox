# PHP/MySQL Sandbox Project

A full-stack PHP practice project demonstrating form handling, session management, database storage, responsive design, and secure patterns.

## Live Demo
- Main site: https://elijahgross.rf.gd  
  (Note: Free hosting may show a false Google warning — safe to bypass via "Details > Visit site")

## Features
- Responsive layout with sticky header and mobile-friendly design
- Form submission with validation
- Data persisted in MySQL database
- Flash messages and one-time reward popup after submission
- Post/Redirect/Get pattern to prevent form resubmission
- Clean separation of PHP logic, HTML, CSS, and JavaScript
- Cross-browser compatible (Chrome, Edge, Safari, Firefox)

## Technologies Used
- PHP 8+
- MySQL (PDO for secure queries)
- HTML5, CSS3 (Grid/Flexbox, media queries)
- JavaScript (vanilla — scroll effects, popup animation)

## Setup (Run Locally)
1. Place files in your web server root (e.g., XAMPP htdocs)
2. Import the database:
   ```sql
   CREATE DATABASE php_sandbox;
   USE php_sandbox;
   CREATE TABLE submissions (
       id INT AUTO_INCREMENT PRIMARY KEY,
       message VARCHAR(255) NOT NULL,
       submitted_at DATETIME NOT NULL
   );
3. Update db.php with your local credentials (default XAMPP: root / empty password)
4. Open XAMPP then in browser open http://localhost/your-folder/index.php

## Project Purpose
This is a personal learning sandbox to practice full-stack PHP development, including:

Secure form processing
Database integration
Responsive UI/UX
Best practices (PRG pattern, prepared statements, separation of concerns)

Thanks for reviewing my code!
Elijah G.
