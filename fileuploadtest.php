<?php
    var_dump($_FILES);
    if(isset($_POST["submit"])) {
        //Check image using getimagesize function and get size
        //if a valid number is got then uploaded file is an image
        if (isset($_FILES["image"])) {
            //directory name to store the uploaded image files
            //this should have sufficient reat/write/execute permissions
            //if not already exists, please create it in the root of the
            //project folder
            $targetDir = "img/profile_pictures/";
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $upload0k = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $check = getImageSize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $upload0k = 1;
            } else {
                echo "File is not an image.";
                $upload0k = 0;
            }

            //Check if the file already exists in the same path
            if (file_exists($targetFile)) {
                echo "File already exists.";
                $upload0k = 0;
            }

            //Check file size and throw error if it is greater that
            //the predefined value, here it is 500000
            if ($_FILES["image"]["size"] > 500000) {
                echo "Size is larger than 500KB.";
                $upload0k = 0;
            }

            //Check for uploaded file formats and allow only
            //jpg, png, jpeg and gif
            //If you want to allow more formats, declare it here
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG and GIF files are allowed.";
                $upload0k = 0;
            }

            //Check if $upload0k is set to 0 by an error
            if ($upload0k == 0) {
                echo "Sorry, your file was not uploaded.";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    echo "The file " . htmlspecialchars( basename( $_FILES["image"]["name"])) .
                        " has been uploaded.";
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
    <title>Fileupload</title>
</head>
<body>
    <div>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="image">
            <input type="submit" name="submit" value="Upload">
        </form>
    </div>
    <div>
        <h2>Display uploaded image:</h2>
        <?php if (isset($_FILES["image"]) && $upload0k == 1) : ?>
            <img src="<?php echo $targetFile; ?>" alt="Uploaded image" width="300">
        <?php endif; ?>
    </div>
</body>
</html>
