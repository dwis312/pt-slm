const userInput = document.getElementById("username");
const emailInput = document.getElementById("email");
const nipInput = document.getElementById("nip");
const passwordInput = document.getElementById("password");
const cpasswordInput = document.getElementById("cpassword");


userInput.addEventListener('keyup', ()=> {
    userInput.classList.remove('shake');
    userInput.classList.remove('is-invalid');
})
emailInput.addEventListener('keyup', ()=> {
    emailInput.classList.remove('shake');
    emailInput.classList.remove('is-invalid');
})
nipInput.addEventListener('keyup', ()=> {
    nipInput.classList.remove('shake');
    nipInput.classList.remove('is-invalid');
})
passwordInput.addEventListener('keyup', ()=> {
    passwordInput.classList.remove('shake');
    passwordInput.classList.remove('is-invalid');
})
cpasswordInput.addEventListener('keyup', ()=> {
    cpasswordInput.classList.remove('shake');
    cpasswordInput.classList.remove('is-invalid');
})

