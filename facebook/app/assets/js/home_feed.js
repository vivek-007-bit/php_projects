//removing suggested users in shared post 
let suggestedUsers = document.querySelectorAll(".suggested-users");
suggestedUsers.forEach(item => {
    if (item.innerHTML.trim() == "" || item.textContent.trim() == "") {
        item.style.display = "none";
        item.style.height = "0px";
    }
    else {
        item.style.display = "flex";
    }
});

//shared post modal 
let sharedPostBtn = Array.from(document.getElementsByClassName("share-post-btn"));
let sharedPostModal = document.getElementById("sharePostModal");
let sharedPostURLContainer = document.getElementById("share-post-url");
let sharedPostURl;

let CopyTextMsg = document.getElementById("copy-btn-text");

sharedPostBtn.forEach(item => {
    item.addEventListener("click", (e) => {

        sharedPostURl = e.currentTarget.dataset.link;
        //console.log(sharedPostURl);
    });
});

//add the links when the modal has been opened
sharedPostModal.addEventListener('shown.bs.modal', () => {

    sharedPostURLContainer.textContent = sharedPostURl;

});

//remove the links after the modal has been closed
sharedPostModal.addEventListener('hidden.bs.modal', () => {

    sharedPostURLContainer.textContent = "";
    CopyTextMsg.textContent = "";

});

//copy button 
let copyBtn = document.getElementById("modal-copy-link");
copyBtn.addEventListener("click", () => {

    navigator.clipboard.writeText(sharedPostURl);
    CopyTextMsg.textContent = "Link Copied Successfully!";
});



/*endless scroll using ajax and php
function endlessScroll() {
    let endlessScroll = document.querySelectorAll(".endless-scroll")[0];
    let content = Array.from(document.querySelectorAll(".suggested-posts"));

    content.forEach(item => {
        endlessScroll.appendChild(item.cloneNode(true));
    });
}

document.addEventListener("DOMContentLoaded", () => {
    endlessScroll();

    window.scroll({
        top: 0,
        left: 0,
        behavior: "auto"
    })
});*/
