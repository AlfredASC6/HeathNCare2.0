<?php
    session_start(); 

    if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== "1") {
        header("Location: index.html"); 
        exit();
    }
    // if($_SERVER["HTTPS"] != "on")
    // {
    //     //header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
    //     echo "You must be using HTTPS to access this application";
    //     exit();
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User profile template</title>
    <link rel = "stylesheet" href = "userProfile.css">
    <script src = "userProfile.js" defer></script> 
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.14.0-beta.1/jquery-ui.js" integrity="sha256-390Nb0oEUjfIhOVv5Kf7AT67XcmRlWvHElliqkERbnM=" crossorigin="anonymous"></script>

</head>
<body>
    <section id = "profileDisplay">
        <section id = "left">

            <div id = "accordion">
                <h3 class = "over">Add Daily Log</h3>
                <div id = "addDL">
                    <form action="addDailyLog.php"  method = "POST" class = "modifyDL">
                        <label for="date">Insert the date for the daily log you would like to add:</label>
                        <input type="text" name = "date">
                        
                        <label for="caloricLimit">Enter the number of maximun number of calories you would like to consume in a day:</label>
                        <input type="text" name = "caloricLimit">

                        <label for="weightLimit">Enter the maximun number of pounds you would like to weigh that day</label>
                        <input type="text" name = "weightLimit">

                        <label for="food">Enter a meal you have eaten for this day:</label>
                        <input type="text" name = "food">

                        <label for="servings">Enter the number of servings you have eaten for this meal:</label>
                        <input type="text" name = "servings">


                        <input type="submit">
                    </form>
                </div>
                <h3 class = "over">Edit Daily Log</h3>
                <div id = "editDL" class = "modifyDL">
                    <form class = "modifyDL" onsubmit="editDailyLog();">
                        <label for="getDate">Enter the date of the daily log you would like to modify</label>
                        <input type="text" name = "getDate" id = "editDLDate">
                        <input type="submit">
                    </form>
                </div>

                <h3 class = "over"> Remove Daily Log</h3>
                <div id = "removeDL" class = "modifyDL">
                    <form onsubmit="removeDailyLog();" class = "modifyDL">
                        <label for="rmDL">Enter the date of the daily log you would like to remove:</label>
                        <input type="text" id = "removeDLDate" name = "rmDL">
                        <input type="submit">
                    </form>
                </div>
            </div>

            <div id = "addRecipe">
                <h4>Add recipe:</h4>
                <form action="addRecipe.php" method = "POST" class = "modifyDL" onsubmit="getDailyLogs()"> 
                    <label for="recipeName">Enter the name of your recipe</label>
                    <input type="text" name = "recipeName">

                    <label for="recipeDesc">A small description describing your recipe (under 100 characers)</label>
                    <input type="text" name = "recipeDesc">

                    <input type="submit" class = "phpSubmit">
                </form>
            </div>

            <div class = "dropdown" id = "userRecipes">
                <button class = "dropbtn" onclick = "getUserRecipes();">Recipes</button>
                <div class = "dropdown-content" id = "tbPlaced">
                    
                </div>
            </div>
        </section>


        <section id = "right">
            <section id = "lineGraph">
                some text where line graph is supposed to go 
            </section>

            <section id = "weightProgression">
                this is where a user can see the progress of the weight that they've been doing
            </section>

        </section>
    </section>

</body>
</html>
