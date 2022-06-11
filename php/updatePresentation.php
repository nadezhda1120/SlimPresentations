<?php
require_once "config.php";

$id = $_GET["id"];
mysqli_data_seek($result, $id - 1);
$data = mysqli_fetch_array($result)['data'];
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
    <title>Система за генериране на презентации</title>
    <script type="module" src="/js/presentations.mjs"></script>
    <script>
        $(document).ready(function(){
            $('#validate').click(function(){
                var data = document.getElementById("presentationTextArea").textContent;
                if (validateOnUpdate(data)) {
                    alert("Uspeshno");
                } else {
                    alert("Neupeshno")
                }
            });
        });
    </script>
</head>
<body>
<header>
    <h2>Web Slides</h2>
</header>
<main>
    <textarea id="presentationTextArea" name="w3review" rows="4" cols="50" class=".textarea"><?php echo $data; ?></textarea>
    <button id="validate" style="background-color: red">Update</button>
</main>

</body>
</html>
