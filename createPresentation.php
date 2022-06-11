<?php
require_once "php/config.php";
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

    <script>
        $(document).ready(function(){
            $('#get_presentation_file').click(function(){
                var input = document.getElementById("tags").value;
                var tags = input.split(',');

                for(var i = 0; i < tags.length; i++) {
                    // Trim the excess whitespace.
                    tags[i] = tags[i].replace(/^\s*/, "").replace(/\s*$/, "");
                    // Add additional code here, such as:
                }

                $.ajax({
                    type: "GET",
                    beforeSend: function (request) {
                        request.setRequestHeader("Content-Type", "application/json");
                    },
                    url: "php/getPresentationDataFilterByTags.php?tags=" + input,
                    success: function (data) {
                        save("presentation.slim", data);
                        $("#result").html("Successful");
                    },
                    error: function (error) {
                        alert("NOTOEKY");
                    }
                });
            });
        });
        function save(filename, data) {
            const blob = new Blob([data], {type: 'text/csv'});
            if(window.navigator.msSaveOrOpenBlob) {
                window.navigator.msSaveBlob(blob, filename);
            }
            else{
                const elem = window.document.createElement('a');
                elem.href = window.URL.createObjectURL(blob);
                elem.download = filename;
                document.body.appendChild(elem);
                elem.click();
                document.body.removeChild(elem);
            }
        }
    </script>
</head>
<body>
<header>
    <h2>Web Slides</h2>
</header>
<main>
    <label for="tags">Tags:</label>
    <input id="tags" type="text" placeholder="Enter tags separated with commas"/>
    <button id="get_presentation_file" style="background-color: #0298cf">Build</button>
</main>

</body>
</html>

