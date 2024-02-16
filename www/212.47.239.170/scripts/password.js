function passwordStrength(password) {
    return (
        (
            Number(/[a-zA-Z]/.test(password)) +
            Number(!/^[A-Za-z0-9_-]*$/.test(password)) +
            Number(/[0-9]/.test(password))+
            Number((password != password.toLocaleLowerCase() && password != password.toLocaleUpperCase()))+
            Number(password.length > 9)+
            Number(password.length > 14)
        )
        *
        Number(password.length > 5)
        *
        Number(!(!/[A-Za-z]/.test(password) && /^[A-Za-z0-9_-]*$/.test(password)))
    )
}

let passwordText = document.querySelector("p#passwordStrength")
let passwordField = document.querySelector(`input[type="password"]`)

passwordField.addEventListener("input", () => {
    accountValidationButton = document.querySelector("#passwordSend")
    let strength = passwordStrength(passwordField.value)
    if(strength <= 2) {
        passwordText.style.color = "red"
        //accountValidationButton.disabled = "true"
        accountValidationButton.removeAttribute("disabled")
        accountValidationButton.style.cursor = "not-allowed"
    } else if(strength > 2 && strength <= 4) {
        passwordText.style.color = "yellow"
        accountValidationButton.removeAttribute("disabled")
        accountValidationButton.style.cursor = "pointer"
    } else {
        passwordText.style.color = "green"
        accountValidationButton.removeAttribute("disabled")
        accountValidationButton.style.cursor = "pointer"
    }
    passwordText.innerHTML =  `Force du mot de passe: ${strength}/3`
})