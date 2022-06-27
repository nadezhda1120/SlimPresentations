<?php
require_once "php/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/createPresentation.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <title>Система за генериране на презентации</title>

    <script>
        $(document).ready(function(){
            $('#get_presentation_file').click(function(){
                var input = document.getElementById("tags").value;//check if tag exist
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
                    //check if tag not found
                    url: "php/getPresentationDataFilterByTags.php?tags=" + input,
                    success: function (data) {
                        if(data != ""){
                            save("presentation.slim", data);
                            $("#result").html("Successful");
                        } else {
                            alert("Invalid tag");
                        }
                        
                    },
                    error: function (error) {
                        alert("Error occur while trying to generate presentation");
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
    <h2><a style="text-decoration: none; color: inherit;font-size: 40px;" href="index.php">Web Slides</a></h2>
    <button id="get_presentation_file" >Build</button>
</header>
<main>
    <section id='left'>
        <label id="tag-header" for="tags">Tags:</label>
        <textarea id="tags" type="text" placeholder="Enter tags separated with commas"></textarea>
    </section>
    <section id='right'>
        <label id="tags-example">Tags to choose from:</label>
        <br>
        <table>
            <tbody>
                <?php
                        $arr = array();
                        foreach ($result as $res) {
                            $arr[] = $res["tags"];
                        }
                        $unique = array_unique($arr);

                        foreach ($unique as $u) {
                            echo "<tr>";
                            echo "<td>".$u."</td>";
                            echo "</tr>";
                        }
                ?>
            </tbody>
        </table>
    </section>

</main>

</body>
</html>

