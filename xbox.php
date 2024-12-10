<?php
    include("dbconnect.php");
    session_start();
?>

<!doctype html>
<html lang="en">

<head>
    <title>Xbox</title>
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
    <div class="container-fluid main-bg">
        <br>
        <div class="row justify-content-between">
            <div class="col-2 d-flex justify-content-center">

            </div>
            <div class="col-2 d-flex justify-content-center">
                <!-- voer hier de link van de spellen-->
                <a href="switch.php">
                    <button class="btn btn-lg main-btn text-light">Switch</button>
                </a>
            </div>
            <div class="col-2 d-flex justify-content-center">
                <a href="ps.php">
                    <button class="btn btn-lg main-btn text-light">PlayStation</button>
                </a>
            </div>
            <div class="col-2 d-flex justify-content-center">
            </div>
            <div class="col-2 d-flex justify-content-center">

            </div>
        </div>
        <br>
        <div class="row text-light text-center">
            <h1>Top games voor XBOX</h1>
        </div>
        <div class="row justify-content-between g-4">
            <!-- 6 games hier-->
            <?php
            include("dbconnect.php");
            global $db;
            $query = $db->prepare("SELECT * FROM games WHERE console_id = 2");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $data) {
                    echo
                        "
                    <div class='col-4 d-flex justify-content-center'>
                        <div class='card p-3' style='width: 18rem;'>
                        <img src='img/" . $data['image'] . "'class='card-img-top' alt='...'>
                        <div class='card-body text-center'>
                            <h4 class='text-dark'>" . $data['name'] . "</h4>
                            <a href='gameinfo.php" . $data['id'] . "'class='btn btn-dark'>BEKIJK</a>
                        </div>
                        </div>
                     </div>
                    ";
                }
            ?>
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