<?php
// Commend the next 4 lines if mongodb is not setup
$SCHEMA_AND_COLLECTION ='webproject.presentations';
$manager = new MongoDB\Driver\Manager;
$cursor = $manager->executeQuery($SCHEMA_AND_COLLECTION, new MongoDB\Driver\Query([]));
$result = $cursor->toArray();

// Remove commends from the following lines if mongodb is not setup
//$obj = new stdClass();
//$obj->name = "HTML";
//$obj->data = "=slide.. =slide..";
//$result = [];
//$result[0] = $obj;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>
    <!-- <script defer src="javascript/send_user_data.js"></script> -->
    <title>Система за генериране на презентации</title>
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
                echo "<td>".$res->name."</td>";
                echo "<td>".$res->data."</td>";
                echo "<td><button><i class=\"fa-brands fa-sistrix\"></i></button><button><i class=\"fa-solid fa-pen-to-square\"></i></button></td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
    </section>
</main>

</body>


</html>