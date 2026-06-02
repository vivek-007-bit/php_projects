
//search bar function
const searchBar = document.getElementById("searchbar");
const contacts = document.querySelectorAll(".contacts");

searchBar.addEventListener("keyup", function () {

    const searchText = searchBar.value.toLowerCase();

    contacts.forEach(function (contact) {

        let username = contact.dataset.user.toLowerCase();

        if (username.includes(searchText)) {
            contact.style.display = "flex";
        }
        else {
            contact.style.display = "none";
        }
    });
});


//updating the header details after the user contact list has been clicked
let links = Array.from(document.querySelector(".contact-list").getElementsByTagName("button"));
let headerName = document.getElementById("header-name");
let headerProfilePic = document.getElementById("user-profile-pic");
let chatsContainer = document.querySelectorAll(".chats")[0];

if (headerProfilePic.src == "") {
    headerProfilePic.style.display = "none";
}

else {
    headerProfilePic.style.display = "block";
}

links.forEach(item => {
    item.addEventListener("click", (e) => {
        //console.log(e.target);

        const username = (e.target.dataset.user);
        const user_dp = (e.target.dataset.profilepic);

        console.log("contact-list-dp", user_dp);

        headerName.innerHTML = username;
        headerProfilePic.src = user_dp;

        chatsContainer.innerHTML = `
                                     <div class="message-received">Hii</div>
                                `;
    });
});


let inputMsg = document.querySelectorAll(".input-message")[0];
let sendMsgBtn = document.querySelectorAll(".send-message")[0];
async function main() {
    
    sendMsgBtn.addEventListener("click", ()=>{
        
        console.log(inputMsg.value);
            chatsContainer.innerHTML += `<div class="message-send">${inputMsg.value}</div>`;

    });

}

main()