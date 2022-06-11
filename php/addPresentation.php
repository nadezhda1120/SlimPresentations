<?php
require_once "config.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../css/index.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <!-- <script defer src="javascript/send_user_data.js"></script> -->
    <title>Система за генериране на презентации</title>
    <script>
        $(document).ready(function(){
            $('.button').click(function(){
                var id = this.id.replace("updateButton#", "");
                location.href = "php/updatePresentation.php?id=" + id;
            });
        });
        $(document).ready(function(){
            $('.add_new').click(function(){
                var id = this.id.replace("updateButton#", "");
                location.href = "php/addPresentation.php";
            });
        });
    </script>
</head>
<body>
<header>
    <h2>Web Slides</h2>
    <nav>
        <button class="save" style="background-color: #0298cf">Save</button>
    </nav>
</header>
<main>
</main>

</body>
</html>