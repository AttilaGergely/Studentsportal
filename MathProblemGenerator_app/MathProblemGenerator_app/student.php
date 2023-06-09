<?php
require_once 'backend/connection.php';

session_start();

// Check if the user is logged in as an admin
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    if (basename($_SERVER['PHP_SELF']) !== 'admin.php') {
        header("Location: admin.php");
        exit();
    }
} elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Check if the user is logged in as a basic user
    if (basename($_SERVER['PHP_SELF']) !== 'student.php') {
        header("Location: student.php");
        exit();
    }
} else {
    // If the user is not logged in, redirect them to the index.php page
    if (basename($_SERVER['PHP_SELF']) !== 'index.php') {
        header("Location: index.php");
        exit();
    }
}

require_once 'backend/fetch_user_data.php';
?>

<!DOCTYPE html> 
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Student page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="final.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Math Gen app</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" href="student.php">Profile</a> 
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="readme_student.php">Tutorial</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="math_problems.php">Excercises</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="backend/logout.php">Log out</a>
                        </li>
                        <li class="nav-item">
                            <a href="slovak/student_sk.php">
                                <img src="Flag_of_Slovakia.png" alt="Slovak Flag" style="height:30px; width:45px;">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="container">
        <h1 style="font-size:60px">Welcome, <?php echo htmlspecialchars($_SESSION['firstname'] . ' ' . $_SESSION['lastname']); ?>!</h1>
        <?php
        if($rightAnswer == 0 && $answered == 0) {
        ?>
            <h3 style="font-size:30px">You havent done any excercises yet. To start, head into the "Excercises" section please.</h3>
        <?php
        } else {
        ?>
            <h3 style="font-size:30px">You answered <?php echo $rightAnswer; ?>/<?php echo $answered; ?> questions correctly!</h3>
        <?php
        }
        ?>
        </div>
        <audio autoplay>
        <source src="welcome.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
        </audio>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    </body>
</html>