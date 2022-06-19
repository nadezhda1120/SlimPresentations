<?php
error_reporting(E_ERROR | E_PARSE);
require_once "php/config.php";

$data = base64_decode($_GET["data"]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/createSlide.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <!-- <script defer src="javascript/send_user_data.js"></script> -->
    <title>Система за генериране на презентации</title>
    <script type="text/javascript">
        $(document).ready(function(){
            $(".merge").on('click', function(){
                $input_name = $("#input_name").val();
                $input_tag = $("#input_tag").val();
                var data = document.getElementById("input_data").value;
                var json = {
                    name: $input_name,
                    tag: $input_tag,
                    data: data
                }
                $.ajax({
                type: "POST",
                url:  "php/add.php",
                data: JSON.stringify(json),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    alert("Presentation saved");
                    window.location.href="index.php";
                },
                error: function (error) {
                    alert(console.log(error));
                }
            });
        });
    });
  </script>
</head>
<body>
<header>
    <h2>Web Slides</h2>
    <nav>
        <button class="merge">Merge</button>
    </nav>
</header>
<main>
</main>
    <label id="inf"> CREATE NEW PRESENTATION BY MERGING THE CHOSEN SLIDES </label>
    <form class="container">
        <label for="input_name">Add new name:</label>
        <input id="input_name" name="input_name" class="addInfoFiled" type="text" placeholder="Enter some title...">

        <label for="input_tag">Add new tags:</label>
        <input id="input_tag" name="input_tag" class="addInfoFiled" type="text" placeholder="Enter tags separated by commas">

        <label for="input_data">Data:</label>
        <textarea id="input_data" name="input_data" style="height:300px" class="addInfoFiled">
            <?php echo $data; ?>
        </textarea>
        </form>
</body>
</html>