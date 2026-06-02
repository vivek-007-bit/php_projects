
//upload post 
document.getElementById("imageInput").addEventListener("change", function (event) {
    const file = event.target.files[0];
    console.log(file);
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const caption = document.getElementById("caption");
        const preview = document.getElementById("preview");
        preview.src = e.target.result;
        preview.style.display = "block";
        caption.style.display = "block";
      }
      reader.readAsDataURL(file);
    }
  });


//upload profile picture
  document.getElementById("profileImageInput").addEventListener("change", function (event) {
    const file = event.target.files[0];
    console.log(file);
    if (file) {
      const reader = new FileReader();
      reader.onload = function (e) {
        const preview = document.getElementById("profileImagePreview");
        preview.src = e.target.result;
        preview.style.display = "block";
      }
      reader.readAsDataURL(file);
    }
  });

//previewing the posts in the modal
const posts = Array.from(document.querySelectorAll(".image-gallery")[0].getElementsByTagName("img"));
posts.forEach(item =>{
  item.addEventListener("click", (e)=>{
      
      let username = e.target.dataset.username;
      let src = e.target.src;
      let date = e.target.dataset.date;
      let caption = e.target.dataset.caption;

      //console.log("src", src);
      //console.log("date", date);
      //console.log("caption", caption);
    
     let PostUserName = document.querySelectorAll(".modalUserName")[0];
     let PostSrc = document.getElementById("post-src");
     let PostDate = document.getElementById("post-date");
     let PostCaption = document.getElementById("post-caption");

     PostUserName.innerHTML = `<img src="${src}" style="height: 40px; width: 40px; border: solid black 1px; border-radius: 50%;">${username}`;
     PostSrc.src = src;
     PostDate.innerHTML = date;
     PostCaption.innerHTML = caption;
  });
});
