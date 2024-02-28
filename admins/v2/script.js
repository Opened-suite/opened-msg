let divs = document.querySelectorAll(".show");
let buttons = document.querySelectorAll(".fhidden")

buttons.forEach(button => {
    button.onclick = () => {
        for(let i = 0; i < divs.length; i++) {
            divs[i].classList.remove("hidden");
            buttons[i].classList.add("hidden");
        }
    }
})