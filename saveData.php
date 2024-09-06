
<?php
include "connection.php";

if(isset($_GET['city'])) {
    $city = $_GET['city'];

    $check_url = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=".$city."&appid=6aa91911a619bdc12c872d6ed280f5c9";
    $check_response = @file_get_contents($check_url);

    if($check_response === false) {
        echo "<h2>Please enter a valid city name.</h2>";
    } else {
        
        $fetch_query = "SELECT * FROM weather WHERE city = '{$city}' and weather_when >= DATE_SUB(NOW(), INTERVAL 1 HOUR) ORDER BY weather_when DESC LIMIT 1";
        $result = mysqli_query($conn,$fetch_query);

        
        $url = "https://api.openweathermap.org/data/2.5/weather?units=metric&q=".$city."&appid=6aa91911a619bdc12c872d6ed280f5c9";
        $urlTest = @file_get_contents($url);

        if($urlTest == false){
            echo "Error fetching weather data.";
        } else {
            $json = json_decode($urlTest, true);
            $temp = $json["main"]["temp"];
            $type = $json["weather"][0]["description"];

            
            if($result->num_rows == 0){
                $insert_query = "INSERT INTO weather(`city`,`temp`,`weatherType`) VALUES('{$city}','{$temp}','{$type}')";
                mysqli_query($conn, $insert_query);
            }

            
            function display($city){
                include "connection.php";
                $fetch_query = "SELECT * FROM weather WHERE city = '{$city}'";
                $result = mysqli_query($conn,$fetch_query);
                $row = mysqli_fetch_array($result);

                echo 
                "<div class='weather'>
                    <h1 id='city'>City: {$row["city"]}</h1>
                    <h1 id='temp'>Temperature: {$row["temp"]}°C</h1>
                    <h1 id='weatherType'>Description: {$row["weatherType"]}</h1>
                </div>";
            }

            display($city);
        }
    }
}
?>
