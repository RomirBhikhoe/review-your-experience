<?php
session_start(); // Start a session to store uploaded file names

// Initialize the array to store uploaded file names


echo "<pre>";
var_dump($_FILES);
echo "</pre>";

if (isset($_POST["submit"])) {
    if (isset($_FILES["image"])) {
        $targetDir = "uploads/";
        $targetFile = $targetDir . basename($_FILES["image"]["name"]);
        $upload0k = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $upload0k = 1;
        } else {
            echo "File is not an image.";
            $upload0k = 0;
        }

        if (file_exists($targetFile)) {
            echo "File already exists.";
            $upload0k = 0;
        }

        if ($_FILES["image"]["size"] > 100000) {
            echo "Size is larger than 1GB.";
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
                echo "The file " . $fileName . " has been uploaded.";
                // Add the uploaded file name to the session array

            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>File Upload</title>
</head>
<body>
<div>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image">
        <input type="submit" name="submit" value="Upload">
    </form>
</div>
<div>
    <h2>Uploaded Images:</h2>
    <ul>
        <?php
        if (!empty($_SESSION['uploadedFiles'])) {
            foreach ($_SESSION['uploadedFiles'] as $uploadedFile) {
                echo "<li><img src='uploads/$uploadedFile' alt='$uploadedFile' width='300'></li>";
            }
        } else {
            echo "<li>No images uploaded yet.</li>";
        }
        ?>
    </ul>
    <a href="index.php">Home</a>
</div>
</body>
</html>
