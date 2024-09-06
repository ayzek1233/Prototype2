<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PROTOTYPE 2</title>
</head>
<style>.search { margin-bottom: 50px;}

</style>

<body>
    <div class="container">
        <div class="search">
            <form action="" method="get">
                <input type="text" name="city" placeholder="Enter the city name" spellcheck="false">
                <button name="btn" id="searchBtn"><img src="photo/photo_2024-02-02 09.26.27.jpeg" alt=""></button>
            </form>
        </div>
        <?php
        if (isset($_GET["btn"])) {
            include "saveData.php";
        }
        ?>
    </div>
</body>

</html>

