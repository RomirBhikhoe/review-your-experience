<?php
    include("dbconnect.php");
    global $db;
    session_start();

    if (!isset($_SESSION['uploadedFiles'])) {
        $_SESSION['uploadedFiles'] = array();
    }

    if(isset($_POST["upload"])) {
        if (isset($_FILES["image"])) {
            $targetDir = "img/profile_pictures/";
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $upload0k = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $check = getImageSize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
//                echo "File is an image - " . $check["mime"] . ".";
                $upload0k = 1;
            } else {
//                echo "File is not an image.";
                $upload0k = 0;
            }

            if (file_exists($targetFile)) {
                echo "<div class='container-fluid'>
                            <div class='row text-center header-bg text-light'>
                                <h2>File already exists</h2>
                            </div>
                        </div>";
                $upload0k = 0;
            }

            if ($_FILES["image"]["size"] > 1000000) {
                echo "Size is larger than 500KB.";
                $upload0k = 0;
            }

            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG and GIF files are allowed.";
                $upload0k = 0;
            }

            $fileName = htmlspecialchars(basename($_FILES["image"]["name"]));

            if ($upload0k == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    $uploadProfilepicture = $db->prepare("UPDATE users SET profile_picture = :profilePicture WHERE id = :userId");
                    $uploadProfilepicture->bindParam(':profilePicture', $profilePicture, PDO::PARAM_STR);
                    $uploadProfilepicture->bindParam(':userId', $_SESSION['userId'], PDO::PARAM_INT);

                    $uploadProfilepicture->execute();
                    echo "<div class='container-fluid'>
                            <div class='row text-center header-bg text-light'>
                                <h2>The File $fileName has been uploaded.</h2>
                            </div>
                        </div>";

                    $_SESSION["pfp"] = $fileName;
                    $_SESSION['uploadedFiles'][] = $fileName;
                } else {
                    echo "<div class='container-fluid'>
                            <div class='row text-center header-bg text-light'>
                                <h2>Sorry, there was an error uploading your file.</h2>
                            </div>
                        </div>";
                }
            }
        }
    }

    if(isset($_POST["kies"])) {
        $profilePicture = $_POST["profile_picture"];

        $updateProfilePicture = $db->prepare("UPDATE users SET profile_picture = :profilePicture WHERE id = :userId");
        $updateProfilePicture->bindParam(':profilePicture', $profilePicture, PDO::PARAM_STR);
        $updateProfilePicture->bindParam(':userId', $_SESSION['userId'], PDO::PARAM_INT);
        $updateProfilePicture->execute();

        $_SESSION['pfp'] = $profilePicture;
    }
?>

<!doctype html>
<html lang="en">
<?="<pre>". var_dump($_SESSION['uploadedFiles']) ."</pre>" ?>
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
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="image" class="btn btn-dark">
                    <input type="submit" name="upload" class="btn btn-dark" value="Upload">
                    <select name="profile_picture" class="form-select" aria-label="Default select-example" id="profile_picture">
                        <option selected>Of kies eerder geuploade profielfotos</option>
                        <option value="aap.png">Aap</option>
                        <?php
                            foreach ($_SESSION['uploadedFiles'] as $file) {
                                echo "<option value='" . $file . "'>" . $file . "</option>";
                            }
                        ?>
                    </select>
                    <input type="submit" name="kies" class="btn btn-dark" value="Kies">
                </form>
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