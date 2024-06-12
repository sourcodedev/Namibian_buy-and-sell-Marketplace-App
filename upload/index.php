<?php
// Include the database connection file
include '../base/conn.php';

// Start the session
session_start();

// Retrieve the user ID from the session
if(isset($_SESSION['user_token'])) {
    $userId = $_SESSION['user_token'];
} else {
    // Handle the case where the user is not logged in or user token is not set
    // Redirect the user to the authentication page
    header("Location: ../auth/");
    exit; // Stop further execution
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy And Sell - Upload</title>
    <!--Font Awesome Icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <style>

/* HTML: <div class="loader"></div> */
.loader {
  width: 69%;
    aspect-ratio: 1;
    display: grid;
    animation: l14 4s infinite;
    position: fixed;
    top: 27%;
    display: none; /* Initially hide the loader */

}
.loader::before,
.loader::after {    
  content: "";
  grid-area: 1/1;
  border: 8px solid;
  border-radius: 50%;
  border-color: red red #0000 #0000;
  mix-blend-mode: darken;
  animation: l14 1s infinite linear;
}
.loader::after {
  border-color: #0000 #0000 blue blue;
  animation-direction: reverse;
}
@keyframes l14{ 
  100%{transform: rotate(1turn)}
}

    </style>
    
</head>
<body>

    <div class="videoHeader">
        <span class="fas fa-arrow-left" style="font-size: 25px; cursor: pointer;" onclick="history.back()"></span>
        <h3><img src="../assets/plusic.png" alt="Reels" style="vertical-align: middle; width:100px;" /></h3>
  <span class="fas fa-arrow-right" style="font-size: 25px; cursor: pointer;opacity: 0;" ></span>
      </div>

      <br><br> <br>

    <div class="container">
        <input type="file" id="file-input" accept="image/png, image/jpeg" onchange="preview()" multiple>
        <label for="file-input">
            <i class="fas fa-plus"></i>
        </label>
        <p id="num-of-files">Upload Product Images</p>
        <div id="images"></div>
<br>
<br>

<div class="select">
<select>
    <option value="phone">Phone</option>
    <option value="laptop">Laptop</option>
    <option value="vehicle">Vehicle</option>
    <option value="watch">Watch</option>
    <option value="clothing">Clothing</option>
    <option value="cosmetics">Cosmetics</option>
    <option value="furniture">Furniture</option>
    <option value="home-appliances">Home Appliances</option>
    <option value="books">Books</option>
    <option value="sports-equipment">Sports Equipment</option>
    <option value="toys">Toys & Games</option>
    <option value="jewelry">Jewelry & Watches</option>
    <option value="beauty">Beauty & Personal Care</option>
    <option value="health">Health & Wellness</option>
    <option value="other">Other</option>

    <!-- Add more categories as needed -->
</select>

</div>


<br>

        <div class="messageBox">
            <div class="fileUploadWrapper">

            <form enctype="multipart/form-data" action="addproduct.php" method="post">
              <input type="file" id="file" name="file" />
            </form>


            </div>
            <input required="" placeholder="Enter Caption With Price Included..." type="text" id="messageInput" />
            <button id="sendButton">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 664 663">
                <path
                  fill="none"
                  d="M646.293 331.888L17.7538 17.6187L155.245 331.888M646.293 331.888L17.753 646.157L155.245 331.888M646.293 331.888L318.735 330.228L155.245 331.888"
                ></path>
                <path
                  stroke-linejoin="round"
                  stroke-linecap="round"
                  stroke-width="33.67"
                  stroke="#6c6c6c"
                  d="M646.293 331.888L17.7538 17.6187L155.245 331.888M646.293 331.888L17.753 646.157L155.245 331.888M646.293 331.888L318.735 330.228L155.245 331.888"
                ></path>
              </svg>
            </button>
          </div>
          

          <div class="loader"></div>

    </div>



    
    <!--Script-->
    <script src="script.js"></script>
</body>
</html>


<script>
document.getElementById('sendButton').addEventListener('click', function() {
    // Show loader
    document.querySelector('.loader').style.display = 'grid';

    // Get the file input value
    let fileInput = document.getElementById('file-input');
    let files = fileInput.files;

    // Get the caption input value
    let caption = document.getElementById('messageInput').value;

    // Get the selected category
    let category = document.querySelector('.select select').value;

    // Prepare the form data
    let formData = new FormData();

    // Append files, caption, and category to the form data
    Array.from(files).forEach(file => {
        formData.append('files[]', file);
    });
    formData.append('caption', caption);
    formData.append('category', category);

    // Send the form data to the server-side script
    fetch('addProduct.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => {
        // Hide loader
        document.querySelector('.loader').style.display = 'none';

        if (response.ok) {
            console.log('Products data sent successfully.');
            // Display SweetAlert
            Swal.fire({
                icon: 'success',
              title: 'Post Successful!',
              text: 'Your product has been successfully Uploaded.',
            }).then(() => {
                // Redirect to index.php
                window.location.href = '../';
            });
        } else {
            console.error('Error Uploading products.');
            // Display SweetAlert for error
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'There was an error adding the product. Please try again later.',
            });
        }
    })
    .catch(error => {
        // Hide loader
        document.querySelector('.loader').style.display = 'none';
        console.error('Error:', error);
        // Display SweetAlert for error
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'There was an error adding the product. Please try again later.',
        });
    });
});


</script>


