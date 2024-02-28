let searchbar = document.querySelector("#search")
let contacts = document.querySelectorAll(".newContacts > a")
let recentContacts = document.querySelectorAll(".recentContacts > a")
let contactsDiv = document.querySelector(".newContacts")
let recentContactsDiv = document.querySelector(".recentContacts")

searchbar?.addEventListener("input", () => {
    regexps = searchbar.value.split(" ")
    contactsDiv.innerHTML = ""
    contacts.forEach(contact => {
        hasPassedRegexps = true
        regexps.forEach(regexp => {
            if(!RegExp(regexp.toLocaleLowerCase()).test(contact.querySelector(".box-contact > .nom").innerHTML.toLocaleLowerCase())) {
                hasPassedRegexps = false;
                return;
            }
        })
        if(hasPassedRegexps) {
            contactsDiv.appendChild(contact)
        }
    })
    recentContactsDiv.innerHTML = ""
    recentContacts.forEach(contact => {
        hasPassedRegexps = true
        regexps.forEach(regexp => {
            if(!RegExp(regexp.toLocaleLowerCase()).test(contact.querySelector(".box-contact > .nom").innerHTML.toLocaleLowerCase())) {
                hasPassedRegexps = false;
                return;
            }
        })
        if(hasPassedRegexps) {
            recentContactsDiv.appendChild(contact)
        }
    })
})