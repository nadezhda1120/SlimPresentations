<?php
require_once "php/config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/index.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <!-- <script defer src="javascript/send_user_data.js"></script> -->
    <title>Система за генериране на презентации</title>
    <script>
        $(document).ready(function(){
            $('.add_new').click(function(){
                location.href = "php/addPresentation.php";
            });
        });
        $(document).ready(function(){
            $('.create_presentation').click(function(){
                location.href = "createPresentation.php";
            });
        });
        $(document).ready(function(){
            $('.updateButton').click(function(){
                var id = this.id.replace("updateButton#", "");
                location.href = "updatePresentation.php?id=" + id;
            });
        });
        $(document).ready(function(){
            $('.deleteButton').click(function(){
                var id = this.id.replace("deleteButton#", "");
                $.ajax({
                    type: "GET",
                    beforeSend: function (request) {
                        request.setRequestHeader("Content-Type", "application/json");
                    },
                    url: "php/delete.php?id=" + id,
                    success: function (data) {
                        location.reload();
                        alert("Successfully deleted");
                        $("#result").html("Successful");
                    },
                    error: function (error) {
                        alert("Something when wrong while trying to delete");
                    }
                });
            });
        });

        $(document).ready(function(){
            $('.create_slides_checked').click(function(){
                var newData = "";
                var chosenSlides = 0;
                $('input[type="checkbox"]:checked').each(function() {
                    newData += decodeURIComponent(escape(window.atob(this.value)));
                    newData += "\n";
                    chosenSlides++;
                });
                if(newData != "" && chosenSlides > 1) {
                    save("presentation.slim", newData);
                 } else if (chosenSlides <= 1) {
                      alert("Choose at least two slides in order to create new presentation!");
                 }
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
    <nav>
        <button class="create_presentation">Combine Slides by TAG</button>
        <button class="add_new">Create Slide</button>
        <button class='create_slides_checked'>Merge Slides</button>
    </nav>

</header>
<main>
    <section class="table-section">
        <table>
            <thead>
            <tr>
                <th>Add</th>
                <th>ID</th>
                <th>Topic</th>
                <th>Tags</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($result as $res) {
                echo "<tr>";
                echo "<td><input type='checkbox' 
                name='checkbox[]'
                id='checkbox' value='".$res["data"]."'></td>";
                echo "<td>".$res["id"]."</td>";
                echo "<td>".$res["name"]."</td>";
                echo "<td>".$res["tags"]."</td>";
                echo "<td>
                        <button id='updateButton#{$res["id"]}' class='updateButton'><i class=\"fa-solid fa-pen-to-square\"></i></button>
                        <button id='deleteButton#{$res["id"]}' class='deleteButton'><i class=\"fa-solid fa-trash\"></i></button> 
                      </td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </section>
</main>

</body>
</html>