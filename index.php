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
                        alert("OKEY");
                        $("#result").html("Successful");
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
    <nav>
        <button class="create_presentation" style="background-color: #0298cf">Create presentation</button>
        <button class="add_new">+ Add New</button>
    </nav>

</header>
<main>
    <section class="table-section">
        <table>
            <thead>
            <tr>
                <th>#</th>
                <th>Topic</th>
                <th>Tags</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($result as $res) {
                echo "<tr>";
                echo "<td>".$res["id"]."</td>";
                echo "<td>".$res["name"]."</td>";
                echo "<td>".$res["tags"]."</td>";
                echo "<td>
                        <button id='updateButton#{$res["id"]}' class='updateButton'><i class=\"fa-solid fa-pen-to-square\"></i></button>
                        <button id='deleteButton#{$res["id"]}' class='deleteButton'>Delete</button> <!-- TODO: CHANGE ICON. THIS IS DELETE BUTTON -->
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