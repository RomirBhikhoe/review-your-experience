<?php
    include("dbconnect.php");
    session_start();
    const USERNAME_REQUIRED = 'Vul een gebruikersnaam in';
    const  USERNAME_INUSE = 'Gebruikersnaam is al in gebruik';
    const PASSWORD_REQUIRED = 'Vul een wachtwoord in';

    $errors = [];
    $inputs = [];

    global $db;

    try {
        if(isset($_POST["registreer"])){
            $username = filter_input(INPUT_POST,"username", FILTER_SANITIZE_SPECIAL_CHARS);
            $username = trim($username);
            $password = $_POST["password"];
            $profilePicture = $_POST["profile_picture"];

            if(empty($username)){
                $errors['username'] = USERNAME_REQUIRED;
            }

            if(empty($password)){
                $errors['password'] = PASSWORD_REQUIRED;
            }

            $query = $db->prepare("SELECT * FROM users WHERE username = :username");
            $query->bindParam(":username", $username);

            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);



            if ($result) {
                $errors['username'] = USERNAME_INUSE;
                echo "
                    <div class='container-fluid'>
                        <div class='row text-center header-bg text-light'>
                            <h2>Registratie mislukt.</h2>
                        </div>
                    </div>
                ";
            } else {
                $passwordInHash = password_hash($password, PASSWORD_DEFAULT );

                $query = $db->prepare("INSERT INTO users(username, password, profile_picture)
                        VALUES (:username, :password, :profile_picture)");

                $query->bindParam(":username", $username);
                $query->bindParam(":password", $passwordInHash);
                $query->bindParam(":profile_picture", $profilePicture);

                $query->execute();
                $result = $query->fetch(PDO::FETCH_ASSOC);
                echo "
                    <div class='container-fluid'>
                        <div class='row text-center header-bg text-light'>
                            <h2>Je hebt je geregistreerd!</h2>
                        </div>
                    </div>
                ";
                session_start();
                $_SESSION['hashed-pass'] = $passwordInHash;
                $_SESSION['pass'] = $password;
            }
            $profile_picture = filter_input(INPUT_POST,"profile_picture", FILTER_SANITIZE_STRING);
        }
    } catch(PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
?>


<!doctype html>
<html lang="en">

<head>
    <title>Registreer</title>
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
        <?php
        if(isset($_SESSION['username'])) {
            echo "<h2 class='header-bg text-light'>Welkom terug, " . $_SESSION["username"] . "</h2>";
        }
        ?>
        <div class="container-fluid">
            <div class="col-1 d-flex align-items-end">
            </div>
            <div class="col-2 d-flex">
                <a href="home.php" class="logo">
                    <h1 class="pt-5 text-light d-flex align-items-end">MelleSpellen</h1>
                </a>
            </div>
            <div class="col-6 d-flex"></div>
            <?php
            if(isset($_SESSION['username'])) {
                echo "
                        <a href='logout.php'>
                            <button class='btn btn-lg login-btn text-light'>Log Uit</button>
                        </a>
                    ";
            } else {
                echo "
                        <a href='logout.php'>
                            <button class='btn btn-lg login-btn text-light'>Log in</button>
                        </a>
                    ";
            }
            ?>
            <div class="col-1 d-flex"></div>
        </div>
    </nav>
</header>
<main>
    <div class="container-fluid">
        <div class="row">
            <form method="post" class="row mt-5">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col-6">
                        <label for="username" class="form-label">Gebruikersnaam</label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="<?= $inputs['usernames'] ?? '' ?>">
                        <div class="form-text text-danger">
                            <?= $errors['username'] ?? '' ?>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col-6">
                        <label for="password" class="form-label">Wachtwoord</label>
                        <input type="text" class="form-control" id="password" name="password"
                               value="<?= $inputs['passwords'] ?? '' ?>">
                        <div class="form-text text-danger">
                            <?= $errors['passwords'] ?? '' ?>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col-6">
                        <label for="profile_picture" class="form-label">Profielfoto</label>
                        <select name="profile_picture" class="form-select" aria-label="Default select-example" id="profile_picture">
                            <option selected>Kies een profielfoto uit</option>
                            <option value="aap.png">Aap</option>
                        </select>
                    </div>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <input type="submit" class="btn btn-dark col-6" name="registreer" value="Registreer">
                </div>
            </form>
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