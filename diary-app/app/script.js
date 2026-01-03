//viewing the notes in modal
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll(".view-btn").forEach(button => {

        button.addEventListener("click", function () {

            const createdAt = this.dataset.createdAt;
            const title = this.dataset.title;
            const description = this.dataset.description;

            console.log(title, description); // DEBUG

            document.getElementById("viewModalDate").innerText = "Created At: " + createdAt;
            document.getElementById("viewTitle").value = title;
            document.getElementById("viewDescription").value = description;
        });

    });

});

//edit a note auto fill the values 
document.querySelectorAll(".edit-btn").forEach(btn => {
    btn.addEventListener("click", function () {

        document.getElementById("editId").value = this.dataset.id;
        document.getElementById("editTitle").value = this.dataset.title;
        document.getElementById("editDescription").value = this.dataset.description;

    });
});

//Searchbar
document.getElementById("searchBar").addEventListener("keyup", function () {

    const searchValue = this.value.toLowerCase();
    const notes = document.querySelectorAll(".app-notes-container .card");

    notes.forEach(note => {
        const title = note.querySelector(".card-title").innerText.toLowerCase();

        if (title.includes(searchValue)) {
            note.style.display = "block";
        } else {
            note.style.display = "none";
        }
    });

});
