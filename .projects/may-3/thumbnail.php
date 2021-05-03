<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upload Image</title>
</head>
<body>
  <form id="frm" onsubmit="uploadForm(); return false">
    <input name="user_name" type="text">
    <input type="file" onchange="showFile()" accept="image/*" name="img">
    <!-- <img src="" width="150" alt="Thumb preview..."> -->
    <button>upload</button>
  </form>
  <script>
  async function uploadForm(){
    let connection = await fetch("upload.php", {
      method : "POST",
      body : new FormData(document.querySelector("#frm")),
      redirect : "manual"
    })
    if(!connection.ok){alert("error"); return}
    let response = await connection.text()
    console.log(response)
  }
   // Check for the various File API support.
  function showFile() {
    console.log(event.target)
    let thumbnail = new Image()
    thumbnail.width = "50"
    thumbnail.height = "50"
    event.target.insertAdjacentElement('afterend', thumbnail)
    var demoImage = document.querySelector('img');
    var file = document.querySelector('input[type=file]').files[0];
    var reader = new FileReader();
    reader.onload = function () {
      // console.log(event.target)
      // demoImage.src = reader.result;
      thumbnail.src = reader.result;
    }
    reader.readAsDataURL(file);
    // console.log(file)
  }
  </script>
</body>
</html>