<?php
    $servername = "localhost";
    $username = "root";
    $password = "student";
    $dbname = "healthncare2_0";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $personSql = "";

    $sql = "SELECT recipeName FROM recipe JOIN personRecipe JOIN person ON recipe.recipeID = personrecipe.
    recipeID AND personrecipe.personID = person.personId;";
    $result = $conn->query($sql);
    $recipeArray = array();

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $recipeArray[] = $row["recipeName"];
    }
    } else {
        echo "0 results";
    }

    header("Content-Type: application/json");
    echo json_encode($recipeArray);
    exit();
?>