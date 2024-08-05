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

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $fName = $_POST["fName"];
        $lName = $_POST["lName"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Validate inputs
        // Check if email is already in database. Return 1 if yes, 0 if no
        $sql = "SELECT EXISTS(SELECT 1 FROM person WHERE email = ?) AS emailNo";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);

        $stmt->execute();

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if($row["emailNo"] == 1){
            echo "Email exists: " . $row['emailNo'] . "<br>";
        }
        
        else if ($row["emailNo"] == 0){
            echo $row["emailNo"];
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $sql= "INSERT INTO person(fName, lName, email, `password`) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $fName, $lName, $email, $hashedPassword);
            $stmt->execute();

            $_SESSION["personId"] = $conn->insert_id;
            header("Location: userProfile.php");
            $stmt->close();
            $conn->close();
            exit();
        }
    }
?>