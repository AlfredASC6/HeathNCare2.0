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
 
     $sql ="DELETE dailylog, persondailylog 
        FROM dailylog 
        JOIN persondailylog ON dailylog.dailylogid = persondailylog.dailylogid 
        JOIN person ON persondailylog.personid = person.personid 
        WHERE person.personid = ? AND date1 = ? AND food = ? AND servings = ?";

    $personID = $_SESSION['personID'];
    $date1 = $_POST['getDate'];
    $food = $_POST['food'];
    $servings = $_POST['servings'];
    
    echo $personID . $date1 . $food . $servings; 
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssss", $personID, $date1, $food, $servings);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    header("HTTPS/1.1 204 No Content");
    exit();
    
?>