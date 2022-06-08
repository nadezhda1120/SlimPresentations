<?php
require_once "php/config.php";
$sql = "SELECT id, name, data FROM presentations";
$result = $mysqli->query($sql);;

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
            $('.button').click(function(){
                var clickBtnValue = $(this).val();
                var ajaxurl = 'php/updatePresentation.php',
                    data =  {'action': clickBtnValue};
                $.post(ajaxurl, data, function (response) {
                    // Response div goes here.
                    alert("action performed successfully");
                });
            });
        });
    </script>
</head>
<body>
<header>
    <h2>Web Slides</h2>
    <nav>
        <input placeholder="topic"/>
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
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($result as $res) {
                echo "<tr>";
                echo "<td>".$res["id"]."</td>";
                echo "<td>".$res["name"]."</td>";
                echo "<td><button class='button'><i class=\"fa-brands fa-sistrix\"></i></button><button><i class=\"fa-solid fa-pen-to-square\"></i></button></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </section>
</main>

</body>
</html>