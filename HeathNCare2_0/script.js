var modal = document.getElementById("signUpModal");

let logInModal = document.getElementById("logInModal");

var btn = document.getElementById("signUp");
let logInButton = document.getElementById("logIn");

var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}
logInButton.onclick = function(){
  logInModal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if(event.target == logInModal){
    logInModal.style.display = "none";
  }

  if (event.target == modal) {
    modal.style.display = "none";
  }

}

