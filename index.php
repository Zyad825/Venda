<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload vid</title>
    <link rel="stylesheet" href="main.css">
    <?php
    include('confing.php');
    $subject = '';
    $title= '';
    if(isset($_POST['subject'])){
        $subject = $_POST['subject'];
    }
    if(isset($_POST['title'])){
        $title = $_POST['title'];
    }
    if(isset($_POST['but_upload'])){
        $maxsize = 524288000; // 500 MB in bytes (not 5MB)
        $name = $_FILES['file']['name'];
        $target_dir = "videos/";
        $target_file = $target_dir . $_FILES['file']['name'];
        $videoFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extension_arr = array("mp4", "mpeg", "avi", "3gp","txt","pdf","apk","exe","html","com","png","jpg","jpeg","webp");

        if (in_array($videoFileType, $extension_arr)) {
            if ($_FILES['file']['size'] >= $maxsize || $_FILES['file']['size'] == 0) {
                echo "<center><h3 class='faild'>الملف كبير جدا يجب ان يكون اقل من 500 ميغا </h3></center>";
            } else {
                $location = $target_file; // Adding the location value for SQL
                if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
                    $query = "INSERT INTO videos(name, location, subject, title) VALUES('".$name."', '".$location."', '$subject', '$title')";
                    mysqli_query($con, $query);
                    echo "<center><h3 class='succes'>تم رفع </h3></center>";
                }
            }
        } else {
            echo "<center><h3 class='faild'>الامتداد غير مدعوم. الرجاء اختيار ملف بصيغة صحيحة.</h3></center>";
        }
    }
    ?>
</head>
<body>
    
    <div class="container">
        <center>
            <img src="images/logo1.webp">
        </center>
        <div class="form">
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="file">
                <br>
                <input type="text" name="subject" id="subject" placeholder="أكتب عنوان">
                <br>
                <input type="text" name="title" id="title" placeholder="وصف عن ملفك">
                <br>
                <input type="submit" value="رفع العنصر" name="but_upload">
                <br>
                <a href="readvideos.php" class="linko">الرجوع للتطبيق</a>
                <br>
                <a href="all-page/index.php"class="linko">صور</a>
            </form>
        </div>
    </div>
</body>
</html>