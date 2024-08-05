let domUserRecipes = document.getElementById("tbPlaced");
let left = document.getElementById("left");

function getUserRecipes(){
    var xhr = new XMLHttpRequest();
        xhr.open("GET", "getRecipe.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                let data = JSON.parse(xhr.responseText);
                for(let key in data){
                    let userRecipes = document.createElement("p");

                    let text = document.createTextNode(data[key]);
                    userRecipes.appendChild(text);

                    domUserRecipes.appendChild(userRecipes);
                }
            }
        };
    xhr.send();
}


window.onload = getUserRecipes();

$( function() {
    $( "#accordion" ).accordion({
        // collapsible: true
    });
} );



function removeDailyLog(){
    event.preventDefault();
    let newModal = document.createElement("div");
    let modalContent = document.createElement("div");
    let newForm = document.createElement("form");
    let span = document.createElement("span");
    span.innerHTML = "&times;"
    span.className = "close";
    newForm.setAttribute("id", "newForm");
    span.onclick = function() {
        newModal.remove();
    }

    modalContent.className = "modal-content";
    newModal.className = "modal";
    modalContent.appendChild(span);
    let date2 = encodeURIComponent(document.getElementById("removeDLDate").value);


    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "getDailyLog.php", false);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    // xhttp.onreadystatechange
    xhttp.onload = function() {
        // if (this.readyState == 4 && this.status == 200) {
            console.log(xhttp.responseText);
            let data = JSON.parse(xhttp.responseText);
            for(let i = 0; i < data.length; i++){   
                
                let dailyLog = document.createElement("input");
                newForm.appendChild(dailyLog);

                dailyLog.setAttribute("type", "radio");
                dailyLog.setAttribute("class", i + "dl");
                dailyLog.setAttribute("name", "choice");
                let dl = data[i];
                let radioString = "";
                for (let key in dl){
                    let value = dl[key];
                    let dailyLogTextNode = document.createTextNode(value + " ");
                    let newLabel = document.createElement("label");
                    newLabel.setAttribute("for", dailyLog);
                    newLabel.setAttribute("class", i + "dl");
                    newLabel.appendChild(dailyLogTextNode);
                    newForm.appendChild(newLabel);
                    radioString += String(value) + ",";
                }
                dailyLog.setAttribute("value", radioString);
                let br = document.createElement("br");
                newForm.appendChild(br);
                modalContent.appendChild(newForm);
                newModal.appendChild(modalContent);
                radioString = "";
            }
            let submit = document.createElement("input");
            

            submit.setAttribute("type", "submit");
            submit.setAttribute("id", "removeSubmit");
            left.appendChild(newModal);
            newForm.appendChild(submit);
            newForm.setAttribute("id", "newFormRemove");
            let choices = document.getElementsByName("choice");

            document.getElementById("newFormRemove").onsubmit = function(event){
                event.preventDefault();
                for(let i = 0; i < choices.length; i++){
                    if(choices[i].checked){
                        let rmXHTTP = new XMLHttpRequest();
                        console.log(choices[0]);
                        let info = choices[i].value.split(",");
                        rmXHTTP.open("POST", "removeDailyLog.php", true);

                        let params = "getDate=" + encodeURIComponent(info[0]) + "&food=" + encodeURIComponent(info[3]) + "&servings=" + encodeURIComponent(info[4]);
                        console.log(params);
                        rmXHTTP.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        rmXHTTP.onreadystatechange = function(){
                            if(this.readyState == 4 && this.status == 200){
                                console.log("Successfully removed a Daily Log!");
                            }
                        }

                        rmXHTTP.send(params);
                    }
                }
            }
                

            
            
    };

    xhttp.send("date1=" + date2);
}

function editDailyLog(){
    event.preventDefault();
    let newModal = document.createElement("div");
    let modalContent = document.createElement("div");
    let newForm = document.createElement("form");
    let span = document.createElement("span");
    span.innerHTML = "&times;"
    span.className = "close";
    newForm.setAttribute("id", "newFormEdit");
    span.onclick = function() {
        newModal.remove();
    }

    modalContent.className = "modal-content";
    newModal.className = "modal";
    modalContent.appendChild(span);
    let date2 = encodeURIComponent(document.getElementById("editDLDate").value);

    let xhttp = new XMLHttpRequest();
    xhttp.open("POST", "getDailyLog.php", false);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhttp.onload = function(){
        let data = JSON.parse(xhttp.responseText);
            for(let i = 0; i < data.length; i++){   
                let dailyLog = document.createElement("input");
                newForm.appendChild(dailyLog);

                dailyLog.setAttribute("type", "radio");
                dailyLog.setAttribute("class", i + "dl");
                dailyLog.setAttribute("name", "choice");
                let dl = data[i];
                let radioString = "";
                for (let key in dl){
                    let value = dl[key];
                    let dailyLogTextNode = document.createTextNode(value + " ");
                    let newLabel = document.createElement("label");
                    newLabel.setAttribute("for", dailyLog);
                    newLabel.setAttribute("class", i + "dl");
                    newLabel.appendChild(dailyLogTextNode);
                    newForm.appendChild(newLabel);
                    radioString += String(value) + ",";
                }
                dailyLog.setAttribute("value", radioString);
                let br = document.createElement("br");
                newForm.appendChild(br);
                modalContent.appendChild(newForm);
                newModal.appendChild(modalContent);
                radioString = "";
            }
            let submit = document.createElement("input");
            

            submit.setAttribute("type", "submit");
            submit.setAttribute("id", "editSubmit");

            left.appendChild(newModal);
            newForm.appendChild(submit);

            document.getElementById("editSubmit").onclick = function(event){
                event.preventDefault();
                let thirdModal = document.createElement("div");
                let thirdModalContent = document.createElement("div");
                let thirdForm = document.createElement("form");
                let editSubmit = document.createElement("input");
                editSubmit.setAttribute("id", "editSubmit1");
                editSubmit.setAttribute("type", "submit");
                thirdModal.appendChild(span);

                for(let i = 0; i < 5; i++){
                    let newLabel = document.createElement("label");
                    let newInput = document.createElement("input");

                    switch(i){
                        case 0:
                            // newLabel.setAttribute("date1", "newDate");
                            newLabel.appendChild(document.createTextNode("Enter if you would like to modify the date: "));
                            newInput.setAttribute("for", "newDate");
                            newInput.setAttribute("id", "newDate");
                            thirdForm.appendChild(newLabel);
                            thirdForm.appendChild(newInput);
                            break;
                        case 1:
                            // newLabel.setAttribute("id", "newFood");
                            newLabel.appendChild(document.createTextNode("Enter the food you would like to change:"));
                            newInput.setAttribute("for", "newFood");
                            newInput.setAttribute("id", "newFood");
                            thirdForm.appendChild(newLabel);
                            thirdForm.appendChild(newInput);
                            break;
                        case 2:
                            // newLabel.setAttribute("id", "newCalories");
                            newLabel.appendChild(document.createTextNode("Enter the new maximum number of calories you would like to eat: "));
                            newInput.setAttribute("for", "newCalories");
                            newInput.setAttribute("id", "newCaloricLimit");
                            thirdForm.appendChild(newLabel);
                            thirdForm.appendChild(newInput);
                            break;
                        case 3:
                            // newLabel.setAttribute("id", "newWeight");
                            newLabel.appendChild(document.createTextNode("Enter the new weight for today: "));
                            newInput.setAttribute("for", "newWeight");
                            newInput.setAttribute("id", "newWeight");
                            thirdForm.appendChild(newLabel);
                            thirdForm.appendChild(newInput);
                            break;
                        case 4:
                            // newLabel.setAttribute("id", "newServings");
                            newLabel.appendChild(document.createTextNode("Enter the number of servings of the food: "));
                            newInput.setAttribute("for", "newServings");
                            newInput.setAttribute("id", "newServings");
                            thirdForm.appendChild(newLabel);
                            thirdForm.appendChild(newInput);
                            break;
                    }
                }
                thirdForm.appendChild(editSubmit);
                thirdModalContent.appendChild(thirdForm);
                thirdModal.appendChild(thirdModalContent);
                thirdModal.setAttribute("class", "modal");
                thirdModalContent.setAttribute("class", "modal-content");
                left.appendChild(thirdModal);

                document.getElementById("editSubmit1").onclick = function(event){
                    event.preventDefault();
                    let newDate = document.getElementById("newDate").value;
                    let newFood = document.getElementById("newFood").value;
                    let newWeight = document.getElementById("newWeight").value;
                    let newCaloricLimit = document.getElementById("newCaloricLimit").value;
                    let newServings = document.getElementById("newServings").value;
                    
                    let oldDate = document.getElementById("")
                    let oldString = "";
                    let editString = "date1="+newDate + "&caloricLimit=" + newCaloricLimit + "&weightLimit=" + newWeight + "&food=" + newFood + "&servings="+newServings;
                    console.log(editString);
                }
            }
    }

    xhttp.send("date1="+date2);
}