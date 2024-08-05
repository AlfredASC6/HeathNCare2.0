<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "student";
    $dbname = "healthncare2_0";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT date1, caloricLimit, weightLimit, food, servings FROM dailyLog JOIN personDailyLog ON dailylog.dailylogid = persondailylog.dailylogid JOIN person ON persondailylog.personid = person.personid WHERE person.personId = ? AND date1 = ?";
    $personID = $_SESSION['personID'];
    $date1 = $_POST['date1'];
    // echo $date1;
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ss", $personID, $date1);
    $stmt->execute();

    $result = $stmt->get_result();

    // echo $result;
    $dailyLogs = array();

    if ($result->num_rows > 0) {
        // output data of each row
        $counter = 1;
        while($row = $result->fetch_row()) {
            $dailyLogs[] = $row;
            $counter++;
        }
    } 
    else {
        echo "0 results";
    }  
    $stmt->close();
    $conn->close();
    
    header("Content-Type: application/json");
    echo json_encode($dailyLogs);
    exit();
?>
