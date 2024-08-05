<?php 
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

    $sql = "INSERT INTO recipe (recipeName, recipeDesc) VALUES(?, ?)";
    $recipeName = $_POST["recipeName"];
    $recipeDesc = $_POST["recipeDesc"];
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $recipeName, $recipeDesc);
    $stmt->execute();

    $stmt->close();
    $conn->close();
    header("HTTP/1.1 204 No Content");
    exit();

?>