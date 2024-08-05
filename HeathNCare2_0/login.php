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
    
    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $email = $_POST["username"];
        $userPassword = $_POST["knownPassword"];
    
        // SQL query to check if the user exists, returns one if yes
        $sql = "SELECT EXISTS(SELECT 1 FROM person WHERE email = ? AND `password` = ?) AS num";
    
        $stmt = $conn->prepare($sql);    
        $stmt->bind_param("ss", $email, $userPassword);
    
        // Execute the statement
        $stmt->execute();
    
        // Bind the result
        $stmt->bind_result($num);
        $stmt->fetch();
        //closing the statement so I can reuse it in a bit
        $stmt->close();

        // Check if the user exists
        if ($num) {
            $_SESSION['loggedIn'] = "1";
            echo $num;
            $sql1 = "SELECT personID FROM person WHERE email = ?";
            $stmt1 = $conn->prepare($sql1);    
            $stmt1->bind_param("s", $email);
            
            $stmt1->execute();

           
            $stmt1->bind_result($id);
            $stmt1->fetch();
            $_SESSION['personID'] = strval($id);

            $stmt1->close();
            $conn->close();
            header("Location: userProfile.php");
            exit();
        } else {
            $_SESSION['loggedIn'] = "0";

            $stmt->close();
            $conn->close();
            header("Location: index.html");
            exit();
        }
    }
?>