function validateForm() {
    var name = document.querySelector("#name").value.trim();
    var username = document.querySelector("#username").value.trim();
    var password = document.querySelector("#password").value.trim();
    var cpassword = document.querySelector("#cpassword").value.trim();

    var error = document.querySelector(".error-msg");

    if (name === "" || username === "" || password === "" || cpassword === "") {
        error.innerHTML = `<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                             <strong>Error: </strong> Title and Description cannot be empty!
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label=Close'></button>
                            </div>`
        return false;
    }
    return true;
}