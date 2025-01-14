<?php
include ("dbconnect.php");

session_start();

global $db;
$id=$_GET["id"];
$query = $db->prepare( "SELECT * FROM games WHERE id=:id");
$query->bindParam(":id", $id);
$query->execute();
$gameData = $query->fetch( PDO::FETCH_ASSOC);

$reviewQuery = $db->prepare("SELECT * FROM review WHERE game_id = $id");
$reviewQuery->execute();
$review = $reviewQuery->fetchAll(PDO::FETCH_ASSOC);

const TITLE_REQUIRED = 'Titel invullen';
const REVIEW_REQUIRED = 'Review invullen';
const LOGIN_REQUIRED = 'Moet ingelogd zijn';

$errors = [];
$inputs = [];

try {
    if(isset($_POST['verzenden'])) {
        $titel = filter_input(INPUT_POST, "titel", FILTER_SANITIZE_SPECIAL_CHARS);
        $titel = trim($titel);
        if (empty($titel)) {
            $errors['titel'] = TITLE_REQUIRED;
        } elseif(isset($_SESSION['userId']) != 1) {
            $errors['titel'] = LOGIN_REQUIRED;
        } else {
            $inputs['titel'] = $titel;
        }

        $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_SPECIAL_CHARS);
        $text = trim($text);
        if (empty($text)) {
            $errors['text'] = REVIEW_REQUIRED;
        } elseif(isset($_SESSION['userId']) != 1) {
            $errors['text'] = LOGIN_REQUIRED;
        } else {
            $inputs['text'] = $text;
        }

        $game = $id;
        $score = filter_input(INPUT_POST, "score", FILTER_SANITIZE_NUMBER_FLOAT
            , FILTER_FLAG_ALLOW_FRACTION);

        if(count($errors) === 0) {
            global $db;

            $query = $db->prepare("INSERT INTO review(titel, text, game_id, score, username, profile_picture)
                                                VALUES (:titel, :text, :game_id, :score, :username, :profile_picture)");
            $query->bindParam(":titel", $titel);
            $query->bindParam(":text", $text);
            $query->bindParam(":game_id", $game, PDO::PARAM_INT );
            $query->bindParam(":score", $score, PDO::PARAM_INT);
            $query->bindParam(":username", $_SESSION['username'], PDO::PARAM_STR);
            $query->bindParam(":profile_picture", $_SESSION['profile_picture'], PDO::PARAM_STR);

            $result=$query->execute();

            echo "<h2 class='text-light'>". $_SESSION["username"] . "</h2>>";

            echo "    
                    <div class='container-fluid'>
                        <div class='row text-center header-bg text-light'>
                            <h2>Je review is geplaatst!</h2>
                        </div>
                    </div>
                ";
        } else {
            echo "
                    <div class='container-fluid'>
                        <div class='row text-center header-bg text-light'>
                            <h2>Oops, je review is niet geplaatst.</h2>
                        </div>
                    </div>
                ";
        }
    }
} catch(PDOException $e) {
    die("Database error: " . $e->getMessage());
}

?>

<!doctype html>
<html lang="en">
<head>
    <title><?php echo $gameData['name']?></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css">
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
    <div class="container-fluid main-bg">
        <div class="row">
            <div class="col-12" style="height: 100px;">
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-1"></div>
            <div class="card mb-10 header-bg text-light" style="max-width: 1000px;">
                <div class="row g-0">
                    <div class="col-md-4 mt-5 mb-5 ml-2">
                        <img src="img/<?php echo $gameData['image']?>" class="img-fluid rounded-start" alt="<?php echo $result['image']?>">
                    </div>
                    <div class="col-md-8 header-bg">
                        <div class="card-body header-bg p-5">
                            <h1><?php echo $gameData['name'] ?></h1>
                            <br>
                            <p class="card-text"><?php echo $gameData['description']?></p>
                            <p class="card-text h4">€<?=$gameData['price']?> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
        <br>
        <div class="row">
            <!--Hier komen de reviews-->
            <div class="col-1"></div>
            <div class="col-10">
                <h2 class="text-center">Reviews</h2>
                <hr>
                <div class="container-fluid">
                    <div class="row gap-3 d-flex justify-content-center">
                        <?php
                        foreach($review as $reviewData) {
                            echo
                                "
                                             <div class='card mb-3' style='max-width: 400px;'>
                                                <div class='row g-0'>
                                                    <div class='col-md-2'>
                                                        <img src='img/profile_pictures/" . $reviewData['profile_picture'] . "' class='img-fluid rounded-circle mx-auto d-block pt-3' style='max-width: 50px;' alt=''...''>
                                                    </div>
                                                    <div class='col-md-10'>
                                                        <div class='card-body'>
                                                            <h5 class='card-title'>" . $reviewData['titel'] . "</h5>
                                                            <h6 class='card-text'>Cijfer: " . $reviewData['score'] . "</h6>
                                                            <p class='card-text'>" . $reviewData['text'] . "</p>
                                                            <b><p class='card-text'>Geschreven door: " . $reviewData['username'] . "</p></b>
                                                            <p class='card-text'><small class='text-muted'>" . $reviewData['time'] . "</small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            ";
                        }
                        ?>
                    </div>
                    <br>
                    <div class="row d-flex justify-content-center">
                        <h2 class="text-center">Plaats je eigen review!</h2>
                        <hr>
                        <?php

                        ?>
                        <form action="" class="row" method="post">
                            <div class="col-md-6">
                                <label for="t" class="form-label">Titel</label>
                                <input type="text" class="form-control" id="t" placeholder="Super leuk!" name="titel"
                                       value="<?= $inputs['titel'] ?? ''?>">
                                <div class="form-text text-danger">
                                    <?= $errors['titel'] ?? '' ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="reviewScore" class="form-label">Welk cijfer?</label>
                                <select name="score" class="form-select" aria-label="Default select-example" id="reviewScore">
                                    <option selected>Kies een score van 1 tot 10</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="reviewText">Jouw mening</label>
                                <textarea class="form-control" placeholder="Laat ons weten wat je van dit spel vond!"
                                          id="reviewText" name="text" rows="3" required>
                                            <?= $inputs['text'] ?? ''?>
                                            </textarea>
                                <div class="form-text text-danger">
                                    <?= $errors['text'] ?? ''?>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-dark" name="verzenden" value="Plaats review">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-1"></div>
        </div>
    </div>
</main>
<footer>
    <!-- place footer here -->
</footer>
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
