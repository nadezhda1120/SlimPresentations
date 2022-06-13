<?php
require_once "php/config.php";

$id = $_GET["id"];
$data = "";
foreach($result as $row) {
    if ($row['id'] == $id) {
        $data = base64_decode($row['data']);
        break;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/updatePresentation.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <title>Система за генериране на презентации</title>

    <script>
        $(document).ready(function(){
            $('#validate').click(function(){
                var data = btoa(unescape(encodeURIComponent(document.getElementById("presentationTextArea").value)))
                var json = {
                    id: <?php echo $id; ?>,
                    data: data
                };
                $.ajax({
                    type: "POST",
                    beforeSend: function (request) {
                        request.setRequestHeader("Content-Type", "application/json");
                    },
                    url: "php/update.php",
                    data: JSON.stringify(json),
                    success: function (data) {
                        alert("OKEY");
                        window.location.href="../index.php";
                    },
                    error: function (error) {
                        alert("NOTOEKY");
                    }
                });
            });
        });
    </script>
</head>
<body>
<header>
    <h2>Web Slides</h2>
    <button id="validate">Update</button>
</header>
<main>
    <label for="presentationTextArea">ADD CHANGES YOU WANT TO SEE</label>
    <br>
    <textarea id="presentationTextArea" name="w3review" class=".textarea">
        <?php echo $data; ?>
    </textarea>
    
</main>

</body>
</html>