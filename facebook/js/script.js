  document.getElementById("imageInput").addEventListener("change", function (event) {
    const file = event.target.files[0];
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