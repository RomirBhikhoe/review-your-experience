<?php



?>


<!doctype html>
<html lang="en">
<head>
    <title>Login</title>
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

    <link rel="stylesheet" href="style.css" defer>
</head>

<body>
<header>
    <div class="container-fluid">
        <div class="col-12">
            <div class="row center">
                <h1>MelleSpellen</h1>
            </div>
        </div>
    </div>
</header>
<main>

    <form method="post" action="login-success.php">
        <div class="mb-3">
        <label>Email-adres</label>
        <input type="email" name="email"
        value="<?php echo $inputs['email'] ?? '' ?>">

        <div class="form-text text-danger">
            <?=$errors['email'] ?? '' ?>
        </div>
        </div>

        <div class="mb-3">
        <label>Wachtwoord</label>
        <input type="password" name="password"
        value=">
        <br>

        <input type="submit" name="inloggen" value="Inloggen">
        </div>
    </form>

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
<?php
