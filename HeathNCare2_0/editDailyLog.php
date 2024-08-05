<?php

    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "student";
    $dbname = "healthncare2_0";
  
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
  
    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    $sql = "UPDATE dailylog SET date1 = ?,caloricLimit =  ?, weightLimit = ?, food = ?, servings = ?  WHERE  date1 = ? AND food = ? AND servings = ?";
    
    $date1 = $_POST['date1'];
    $caloricLimit = $_POST['caloricLimit'];
    $weightLimit = $_POST['weightLimit'];
    $food = $_POST['food'];
    $servings = $_POST['servings'];

    $oldDate = $_POST['oldDate'];
    $oldFood = $_POST['oldFood'];
    $oldServings = $_POST['oldServings'];

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssss", $date1, $caloricLimit,$weightLimit, $food, $servings, $oldDate, $oldFood, $oldServings);
    $stmt->execute();
  
    $stmt->close();
    $conn->close();
    header("HTTP/1.1 204 No Content");
    exit();

?>