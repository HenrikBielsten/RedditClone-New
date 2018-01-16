'use strict';
const usernameField = document.querySelector('.usernameField');
const alreadyExists = document.querySelector('.alreadyExists');
const button = document.querySelector('.create-account-button');


let usernameSearch = () => {
  let searchUser = usernameField.value;

  fetch(`../../app/auth/compareUsername.php?username=${searchUser}`)
  .then(response => {
    return response.json()
  })
  .then(response => {
    console.log(response);
    if (response.length && searchUser.toLowerCase() === response[0].username.toLowerCase()) {
      console.log("if");
      alreadyExists.textContent = "That name is taken!";
      button.disabled = true;
    } else {
      console.log("else");
      alreadyExists.textContent = ""
      button.disabled = false;
    }
  })
}
usernameField.addEventListener('keyup', usernameSearch);
