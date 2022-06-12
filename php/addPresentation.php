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
    <script type="text/javascript">
        $(document).ready(function(){
            $(".save").on('click', function(){
                $input_name = $("#input_name").val();
                $input_tag = $("#input_tag").val();
                $input_data = $("#input_data").val();
                var json = {
                    name: $input_name,
                    tag: $input_tag,
                    data: $input_data
                }
                $.ajax({
                type: "POST",
                url:  "add.php",
                data: JSON.stringify(json),
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    alert("Presentation saved");
                    window.location.href="../index.php";
                },
                error: function (error) {
                    alert(console.log(error));
                }
            });
        });
    });
  </script>

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
    <h3> Add the folowing information for new presentation: </h2>
    <form class="container">
        <label for="input_name">Name:</label>
        <input id="input_name" name="input_name" class="addInfoFiled" type="text" placeholder="Enter some text...">

        <label for="input_tag">Tags:</label>
        <input id="input_tag" name="input_tag" class="addInfoFiled" type="text" placeholder="Enter some text...">

        <label for="input_data">Data:</label>
        <textarea id="input_data" name="input_data" style="height:300px" class="addInfoFiled" placeholder="Enter some text..."></textarea>
        </form>
</body>
</html>