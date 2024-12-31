<?php
include('confing.php'); // تأكد أن اسم الملف صحيح: 'config.php'
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Z-Videos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="app-vedio">
        <?php
        $fetchAllVideos = mysqli_query($con, "SELECT * FROM videos ORDER BY id DESC");
        while ($row = mysqli_fetch_assoc($fetchAllVideos)) {
            $location = $row['location'];
            $subject = $row['subject'];
            $title = $row['title'];
            echo '<div class="vedio">';
            echo '<iframe src="' . $location . '" class="vedio-player"loop=""frameborder=0 width=510 height=500 scrolling=no allowfullscreen=allowfullscreen></iframe>';
            echo '<div class="footer">';
            echo '<div class="footer-text">';
            echo '<h3>Zyad Ahmed</h3>';
            echo '<p class="description">' . $subject . '</p>';
            echo '<div class="img-marq">';
            echo '<a href="index.php"><img src="images/add.png"></a>';
            echo '<marquee direction="right">' . $title . '</marquee>'; // تعديل دمج النصوص
            echo '</div>';
            echo '</div>';
            echo '<img src="images/play.png" class="image-play">';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
    <script>
        const videos = document.querySelectorAll('.vedio-player'); // تعديل التسمية إلى "videos"
        for (const video of videos) {
            video.addEventListener('click', function () {
                if (video.paused) {
                    video.play();
                } else {
                    video.pause();
                }
            });
        }
    </script>
</body>
</html>