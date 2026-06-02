console.log("loaded");

const myModal = new bootstrap.Modal(document.getElementById('postPreviewModal'));

let SearchedPosts = Array.from(document.querySelectorAll(".searched-post"));

SearchedPosts.forEach(item =>{
    //console.log(item);

    item.addEventListener("click", (e)=>{
        //console.log("clicked", item);
        let user = e.currentTarget.dataset.user;
        let src = e.currentTarget.src;
        let caption = e.currentTarget.dataset.caption;
        let date = e.currentTarget.dataset.date;

        document.querySelectorAll(".modalUserName")[0].innerHTML = user;
        document.getElementById("post-src").innerHTML = src;
        document.getElementById("post-date").innerHTML = date;
        document.getElementById("post-caption").innerHTML = caption;

        myModal.show();

    })
})