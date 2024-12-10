<?php
include("dbconnect.php");

session_start();

// Error voor geen gebruikersnaam
const NO_USERNAME = "Deelnemer";
const INVALID_FILE = "Dit type bestand is niet ondersteund.";

$errors = [];
$inputs = [];

global $db;

try {
    if(isset($_POST['opslaan'])) {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $profilePicture = filter_input(INPUT_POST, "profilePicture", FILTER_SANITIZE_SPECIAL_CHARS);

        if(isset($_SESSION['userId'])) {
            $userId = $_SESSION['userId'];
            $query = $db->prepare("UPDATE users SET username = :username WHERE id = :id");
            $query->bindParam("username", $username);
            $query->bindParam("id", $userId, PDO::PARAM_INT);
//            $query->bindParam("profilePicture", $profilePicture);

            if($query -> execute()) {
                echo "
                    <div class='container-fluid'>
                        <div class='row text-center header-bg text-light'>
                            <h2>Gebruikersnaam gewijzigd!</h2>
                        </div>
                    </div>
                ";
                $_SESSION['username'] = $username;
            } else {
               echo "
                   <div class='container-fluid'>
                        <div class='row text-center header-bg text-light'>
                            <h2>Err</h2>
                        </div>
                    </div>
               ";
            }
        } else {
            echo "userid niet gevonden";
        }
    }
} catch(PDOException $e) {
    die("Database error: " . $e->getMessage());
}
?>


<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <link rel="stylesheet" href="style.css" defer>
</head>

<body>
<header>
    <nav class="navbar header-bg">
        <div class="container-fluid">
            <div class="col-1 d-flex align-items-end">
            </div>
            <div class="col-2 d-flex">
                <a href="home.php" class="logo">
                    <h1 class="pt-5 text-light d-flex align-items-end">MelleSpellen</h1>
                </a>

            </div>
            <div class="col-6 d-flex"></div>
            <a href="#">
                <button class="btn btn-lg header-btn text-light">Over ons</button>
            </a>
            <a href='logout.php'>
                <button class='btn btn-lg login-btn text-light'>Log Uit</button>
            </a>
            <div class="col-1 d-flex"></div>
            <div class="d-flex justify-content-end align-self-end text-light">
                <!-- nav hier -->
            </div>
        </div>
    </nav>
</header>
<main>

    <div class="container-lg">
        <div class="row">
            <div class="col">
                <div class="container-lg mt-5">
                    <img src="img/profile_pictures/aap.png" class="img-thumbnail" alt="aap">
                </div>
                <div class="container-lg fs-2 text-light mt-4">
                    <p>Hallo, <?=$_SESSION['username']?>  !</p>
                </div>
            </div>
        </div>
            <div class="col fs-4 mt-5 text-light">
                <form method="post">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Wijzig Gebruikersnaam</label>
                        <input type="username" class="form-control" name="username" id="exampleInputUsername1">
                    </div>

                    <div class="mb-3">
                        <a class="text-light" href="">Wijzig Wachtwoord</a>
                    </div>

                    <div class="mb-3">
                        <input class="btn btn-md login-btn text-light" type="submit" name="opslaan" value="Sla wijzigingen op">
                    </div>
                </form>
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="image">
                    <input type="submit" name="upload" value="upload">
                </form>
            </div>
        </div>
</main>
<!-- Bootstrap JavaScript Libraries -->
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
></script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"
></script>
</body>
</html>