<?php
    include("dbconnect.php");
    session_start();

    //Errors voor het inlog formulier
    const WRONG_USERNAME_OR_PASSWORD = 'Ongeldige login.';
    const USERNAME_REQUIRED = 'Voer een gebruikersnaam in.';
    const PASSWORD_REQUIRED = 'Vul een wachtwoord in';

    $errors = [];
    $inputs = [];

    global $db;



    try {
        if(isset($_POST["login"])){
            $username = filter_input(INPUT_POST,"username", FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_SPECIAL_CHARS);

            // check of $username & password niet leeg zijn
            if(empty($username)) {
                $errors['username'] = USERNAME_REQUIRED;
            }

            if(empty($password)) {
                $errors['password'] = PASSWORD_REQUIRED;
            }

            $query = $db->prepare("SELECT * FROM users WHERE username = :username");

            $query->bindParam(":username", $username);

            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);

            //Als het ww uit de database overeenkomt met het ww dat je invoert log je in
            if ($result && password_verify($password, $result['password'])) {
                    $_SESSION["userId"] = $result["id"];
                    $_SESSION["username"] = $result["username"];
                    $_SESSION['login'] = true;
                    header("Location: home.php");
            }
            else {
                //Anders error
                $errors['username'] = WRONG_USERNAME_OR_PASSWORD;
                $errors['password'] = WRONG_USERNAME_OR_PASSWORD;
            }

        }
    } catch(PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
?>


<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
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
            <a href='registreer.php'>
                <button class='btn btn-lg login-btn text-light'>Registreer</button>
            </a>
            <div class="col-1 d-flex"></div>
        </div>
    </nav>
</header>
<main>
    <div class="container-fluid">
            <div class="row">
<!--                LOGIN FORM-->
                <div class="col-md-12">
                    <form method="post" class="row mt-5">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="col-6">
                                <label for="username" class="form-label">Gebruikersnaam</label>
                                <input type="text" class="form-control" id="username" name="username"
                                       value="<?= $inputs['username'] ?? '' ?>">
                                <div class="form-text text-danger">
                                    <?= $errors['username'] ?? '' ?>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="col-6">
                                <label for="password" class="form-label">Wachtwoord</label>
                                <input type="text" class="form-control" id="password" name="password"
                                       value="<?= $inputs['password'] ?? '' ?>">
                                <div class="form-text text-danger">
                                    <?= $errors['password'] ?? '' ?>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <input type="submit" class="btn btn-dark col-6" name="login" value="Login">
                        </div>
                    </form>
                </div>
            </div>
        <br>
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-6 text-center">
                <?php
                    $number = 69;
                    $randomnumber = rand(1, 100);
                    if($randomnumber == $number) {
                        echo "
                            <H1>!!SINTERKLAAS EVENT!!</H1>
                            <iframe
                                width='640' height='480' src='https://www.youtube.com/embed/bf3TG3YuA-U' title='' frameborder='0'
                                allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share'
                                referrerpolicy='strict-origin-when-cross-origin'
                                allowfullscreen>
                            </iframe>
                        ";
                    }
                ?>
            </div>
            <div class="col-3">
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