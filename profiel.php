<?php
    include("dbconnect.php");
    global $db;
    session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Profiel beheer</title>
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
            <a href='logout.php'>
                <button class='btn btn-lg login-btn text-light'>Log Uit</button>
            </a>
            <div class="col-1 d-flex"></div>
        </div>
    </nav>
</header>
<main>
    <div class="container-lg">
        <div class="row">
            <div class="col-12 d-flex align-items-end">
                <img src="img/profile_pictures/<?= $_SESSION['pfp'] ?>" class="mt-5 w-25"  alt="Profiel_foto">
                <button type="button" class="btn btn-dark">Profiel Foto Wijzigen</button>
            </div>
            <div class="col-12">
                <h2>Welkom terug, <?= $_SESSION['username'] ?>!</h2>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label for="username" class="form-label">Nieuwe username</label>
                <input type="text" class="form-control" id="username" name="username"
                       value="<?= $inputs['username'] ?? '' ?>">
                <div class="form-text text-danger">
                    <?= $errors['username'] ?? '' ?>
                </div>
            </div>
            <div class="col-6">
                <label for="password" class="form-label">Nieuw Wachtwoord</label>
                <input type="text" class="form-control" id="password" name="password"
                       value="<?= $inputs['password'] ?? '' ?>">
                <div class="form-text text-danger">
                    <?= $errors['password'] ?? '' ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <button type="button" class="btn btn-dark">Gebruikersnaam wijzigen</button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-dark">Wachtwoord wijzigen</button>
            </div>
        </div>
    </div>
</main>
<footer>
    <!-- place footer here -->
</footer>
<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>