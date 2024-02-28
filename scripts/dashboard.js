// Gets the toggle table button and store it in the toggleTableButton variable
let toggleTableButton = document.querySelector("button#toggletables")
let toggleUsersButton = document.querySelector("button#toggleusers")
let iframe = document.querySelector("iframe")

// Adds an event that toggles the class "hidden" on the elements with the class discussions.
toggleTableButton.onclick = () => {
    document.querySelector(".discussions").classList.remove("hidden")
    document.querySelector(".users").classList.add("hidden")
}

toggleUsersButton.onclick = () => {
    document.querySelector(".users").classList.remove("hidden")
    document.querySelector(".discussions").classList.add("hidden")
}

// This function changes the source of the iframe and removes the element with the id "contacts"
function putIframe(link) {
    // Gets the iframe and store it in the variable iframe
    iframe.style.boxShadow = "-50px 0px 50px var(--mixed-light-color-1)"
    document.querySelector("#close").classList.remove("hidden")
    document.querySelector(".actions").style.width = "50%"
    document.querySelector(".content").style.width = "40%"
    // Changes the source of the Iframe to be the contact that got loaded
    iframe.src = `/home/index.php?table=${link}`
    // Adds an event when the Iframe finished loading that automatically removes the div with the id "contacts"
    iframe.onload = () => {
        iframe.contentWindow.document.querySelector("div#contacts").remove()
        iframe.contentWindow.document.querySelector("div#discussion").style.width = "100vw"
        iframe.contentWindow.document.querySelector("div#messages").style.width = "100vw"
    }

}

document.querySelector("div#close").addEventListener("click", () => {
    document.querySelector("#close").classList.add("hidden")
    iframe.src = ""
    iframe.style.boxShadow = ""
    document.querySelector(".actions").style.width = "50%"
    document.querySelector(".content").style.width = "90%"
})