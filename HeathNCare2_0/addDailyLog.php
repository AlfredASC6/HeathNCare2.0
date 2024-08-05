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
  $personID = $_SESSION['personID'];
  $date1 = $_POST["date"];
  $caloricLimit = $_POST["caloricLimit"];
  $weightLimit = $_POST["weightLimit"];
  $food = $_POST["food"];
  $servings = $_POST["servings"];
  // prepare and bind

  $sql = "INSERT INTO dailyLog (date1, caloricLimit, weightLimit, food, servings) VALUES (?, ?, ? , ? , ?  )";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sssss", $date1, $caloricLimit, $weightLimit, $food, $servings);

  $stmt -> execute();

  $stmt->close();
  // $conn->close();

  $sql2 = "INSERT INTO persondailylog VALUES((SELECT personID FROM person WHERE personid = ?), (SELECT dailylogid FROM dailylog WHERE date1 = ? AND food = ?))";
  
  $stmt = $conn->prepare($sql2);
  $stmt->bind_param("sss", $personID, $date1,$food, );
  $stmt->execute();

  $stmt->close();
  $conn->close();
  header("HTTP/1.1 204 No Content");
  exit();
?>