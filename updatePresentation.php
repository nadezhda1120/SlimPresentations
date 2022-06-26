<?php
require_once "php/config.php";

$id = $_GET["id"];
$data = "";
foreach ($result as $row) {
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
        $(document).ready(function () {
            // On tab add two spaces
            const textarea = document.querySelector('textarea')
            textarea.addEventListener('keydown', (e) => {
                if (e.keyCode === 9) {
                    e.preventDefault();
                    textarea.setRangeText('  ', textarea.selectionStart, textarea.selectionStart, 'end');
                }
            });

            $('#validate').click(function () {
                var data = btoa(unescape(encodeURIComponent(document.getElementById("presentationTextArea").value)))
                var json = {
                    id: <?php echo $id; ?>,
                    data: data
                };

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "http://localhost:3000");
                const params = new URLSearchParams();
                params.set("data", data);
                xhr.onload = function () {
                    if (this.response === "SUCCESS") {
                        $.ajax({
                            type: "POST",
                            beforeSend: function (request) {
                                request.setRequestHeader("Content-Type", "application/json");
                            },
                            url: "php/update.php",
                            data: JSON.stringify(json),
                            success: function (data) {
                                alert("OKEY");
                                window.location.href = "index.php";
                            },
                            error: function (error) {
                                alert("NOTOEKY");
                            }
                        });
                    } else {
                        alert(this.response);
                    }
                }
                xhr.send(params);
            });
        });
    </script>
</head>
<body>
<header>
    <h2><a style="text-decoration: none; color: inherit" href="index.php">Web Slides</a></h2>
    <button id="validate">Update</button>
</header>
<main>
    <label for="presentationTextArea">ADD CHANGES YOU WANT TO SEE</label>
    <br>
    <textarea id="presentationTextArea" name="w3review" class=".textarea"><?php echo $data; ?></textarea>

</main>

</body>
</html>