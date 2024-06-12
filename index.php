<?php
// Include the database connection file
include 'base/conn.php';

// Start the session
session_start();

// Retrieve the user ID from the session
if(isset($_SESSION['user_token'])) {
    $userId = $_SESSION['user_token'];
} else {
    $userId = null;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>Buy And Sell Namibia</title>
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <link rel="stylesheet" href="css/style.css" />
  <style>
    .hidden {
      display: none;
    }
    .videoHeader {
      position: absolute;
      top: 0;
      width: 100%;
      z-index: 2;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
</head>
<body style="scroll-snap-stop: always;">
  <script>
    // Utility functions
    function getRandomNumber(min, max) {
      return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function shuffleArray(array) {
      for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
      }
      return array;
    }

    function formatCount(count) {
      return count >= 1000 ? (count / 1000).toFixed(1) + 'k' : count.toString();
    }

    async function fetchJSONFile(url) {
      try {
        const response = await fetch(url);
        if (!response.ok) throw new Error('Failed to fetch JSON');
        return await response.json();
      } catch (error) {
        console.error('Error fetching JSON:', error);
        return null;
      }
    }

    async function fetchVideoTemplate() {
      try {
        const response = await fetch('video_template.html');
        return await response.text();
      } catch (error) {
        console.error('Error fetching video template:', error);
        return null;
      }
    }

    // Functions to create video elements
    function createMediaContent(imagesForProductId) {
      if (imagesForProductId.length > 1) {
        return `
          <div class="swiper-container">
            <div class="swiper-wrapper">
              ${imagesForProductId.map(item => `
                <div class="swiper-slide">
                  <img class="video__player" src="${item.image}" alt="Image">
                </div>
              `).join('')}
            </div>
            <div class="swiper-pagination"></div>
          </div>
        `;
      } else {
        return `
          <img class="video__player" src="${imagesForProductId[0].image}" alt="Image" loading="auto">
        `;
      }
    }


    let videoLinks = [];
    let usernames = [];
    let captions = [];
    let productid = [];
    let likes = [];
    let saves = [];
    let comments = [];
    let shares = [];
    let currentVideoIndex = 0;
    const batchSize = 9;
    let observer;
    let combinedData;

    document.addEventListener('DOMContentLoaded', async () => {
  const fetchImagesUrl = '../fetch/images.php';
  const data = await fetchJSONFile(fetchImagesUrl);
  if (Array.isArray(data)) {
    combinedData = data.map(item => ({
      image: item.image,
      username: item.username,
      caption: item.caption,
      productid: item.productid,
      likes: item.likes,
      saves: item.saves,
      comments: item.comments,
      shares: item.shares

    }));

    const shuffledData = shuffleArray(combinedData);
    videoLinks = shuffledData.map(item => item.image);
    usernames = shuffledData.map(item => item.username);
    captions = shuffledData.map(item => item.caption);
    productid = shuffledData.map(item => item.productid);
    likes = shuffledData.map(item => item.likes);
    saves = shuffledData.map(item => item.saves);
    comments = shuffledData.map(item => item.comments);
    shares = shuffledData.map(item => item.shares);


    createInitialVideoElements();
  } else {
    console.error('Invalid JSON data');
  }

  createHeaderElement();

  if (!observer) {
    observer = new IntersectionObserver(handleIntersection, { root: null, rootMargin: '0px', threshold: 0 });
  }
});

    function createVideoElement(template, imagesForProductId) {
      const mediaElement = document.createElement('div');
      mediaElement.classList.add('video');
      const productId = imagesForProductId[0].productid; // Assuming all images have the same productid
  mediaElement.setAttribute('data-productid', productId);
  
      const mediaContent = createMediaContent(imagesForProductId);
      mediaElement.innerHTML = template
        .replace('{{mediaContent}}', mediaContent)
        .replace('{{videoURL}}', imagesForProductId[0].image)
        .replace('{{likeCount}}', imagesForProductId[0].likes)
        .replace('{{commentCount}}', imagesForProductId[0].comments)
        .replace('{{shareCount}}', imagesForProductId[0].shares)
        .replace('{{saveCount}}', imagesForProductId[0].saves)
        .replace('{{randomUsername}}', imagesForProductId[0].username)
        .replace('{{randomCaption}}', imagesForProductId[0].caption);
      return mediaElement;
    }

    const videoHeader = document.createElement('div');
    videoHeader.classList.add('videoHeader');
    videoHeader.innerHTML = `
      <span></span>
      <h3><img src="assets/plusic.png" alt="Reels" style="vertical-align: middle; width:130px;"></h3>
      <span></span>
    `;


    async function fetchUserActions(userId) {
  const response = await fetch(`fetch/user_actions.php?userid=${userId}`);
  if (response.ok) {
    return response.json(); // Returns an object with arrays of product IDs the user has liked and saved
  } else {
    console.error('Failed to fetch user actions');
    return { likes: [], saves: [] };
  }
}

async function createInitialVideoElements() {
  const videoContainer = document.createElement('div');
  videoContainer.classList.add('app__videos');
  document.body.appendChild(videoContainer);
  const videoTemplate = await fetchVideoTemplate();
  if (!videoTemplate) return;

  const userId = <?php echo json_encode($userId); ?>;
  const userActions = await fetchUserActions(userId);

  const fragment = document.createDocumentFragment();
  const productIds = [...new Set(productid)];
  productIds.slice(0, batchSize).forEach((productId, index) => {
    const imagesForProductId = combinedData.filter(item => item.productid === productId);
    const mediaElement = createVideoElement(videoTemplate, imagesForProductId);

    // Check if the user has liked this product
    const heartIcon = mediaElement.querySelector('.fa-thumbs-up');
    if (userActions.likes.includes(productId)) {
      heartIcon.classList.add('red');
    }

    // Check if the user has saved this product
    const saveIcon = mediaElement.querySelector('.fa-bookmark');
    if (userActions.saves.includes(productId)) {
      saveIcon.classList.add('saved');
    }

    if (index === 0) {
      mediaElement.prepend(videoHeader);
    }
    fragment.appendChild(mediaElement);
  });

  videoContainer.appendChild(fragment);
  currentVideoIndex = batchSize;
  const lastVideoElement = videoContainer.lastElementChild;
  observer.observe(lastVideoElement);
  observeVideos();
  initializeSwiper();
}

async function createAdditionalVideoElements() {
  const videoContainer = document.querySelector('.app__videos');
  if (!videoContainer) return;
  const videoTemplate = await fetchVideoTemplate();
  if (!videoTemplate) return;

  observer.disconnect();

  const userId = <?php echo json_encode($userId); ?>;
  const userActions = await fetchUserActions(userId);

  const fragment = document.createDocumentFragment();
  const endIndex = currentVideoIndex + batchSize;
  const productIds = [...new Set(productid)];

  for (let i = currentVideoIndex; i < endIndex && i < productIds.length; i++) {
    const productId = productIds[i];
    const imagesForProductId = combinedData.filter(item => item.productid === productId);
    const mediaElement = createVideoElement(videoTemplate, imagesForProductId);

    // Check if the user has liked this product
    const heartIcon = mediaElement.querySelector('.fa-thumbs-up');
    if (userActions.likes.includes(productId)) {
      heartIcon.classList.add('red');
    }

    // Check if the user has saved this product
    const saveIcon = mediaElement.querySelector('.fa-bookmark');
    if (userActions.saves.includes(productId)) {
      saveIcon.classList.add('saved');
    }

    fragment.appendChild(mediaElement);
  }

  await new Promise(resolve => setTimeout(resolve, 1000));

  videoContainer.appendChild(fragment);
  currentVideoIndex = endIndex;

  if (currentVideoIndex < productIds.length) {
    const lastVideoElement = videoContainer.lastElementChild;
    observer.observe(lastVideoElement);
  }

  observeVideos();
  initializeSwiper();
}


function handleIntersection(entries) {
  entries.forEach(entry => {
    if (entry.isIntersecting && currentVideoIndex < productid.length) {
      createAdditionalVideoElements();
      observer.disconnect();
    }
  });
}

    function observeVideos() {
  const videoObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      const video = entry.target.querySelector('.video__player');
      const loader = entry.target.querySelector('.loader');
      if (entry.isIntersecting) {
        if (video.tagName === 'VIDEO') video.play();
      } else {
        if (video.tagName === 'VIDEO') {
          video.pause();
          loader.style.display = 'none';
        }
      }
    });
  }, { threshold: 0.01 });

  document.querySelectorAll('.video').forEach(video => {
    videoObserver.observe(video);
    video.addEventListener('click', event => {
      event.preventDefault();
      const clickedVideo = event.currentTarget.querySelector('.video__player');
      if (clickedVideo.tagName === 'VIDEO') {
        clickedVideo.paused ? clickedVideo.play() : clickedVideo.pause();
      }
    });

    const videoPlayer = video.querySelector('.video__player');
    const loader = video.querySelector('.loader');
    if (videoPlayer.tagName === 'VIDEO') {
      videoPlayer.addEventListener('waiting', () => loader.style.display = 'block');
      videoPlayer.addEventListener('playing', () => loader.style.display = 'none');
      videoPlayer.addEventListener('ended', () => restartVideo(videoPlayer));
    }
  });
}


    function restartVideo(video) {
      video.currentTime = 0;
      video.play();
    }

    function initializeSwiper() {
  document.querySelectorAll('.swiper-container').forEach(container => {
    if (!container.swiper) {
      new Swiper(container, {
        loop: true,
        pagination: { el: '.swiper-pagination' },
      });
    }
  });
}


    function createHeaderElement() {
      const header = document.createElement('div');
      header.classList.add('videoHeader');
      header.style.position = 'fixed';
      header.style.top = '0';
      header.style.width = '100%';
      header.style.zIndex = '2';

      const leftArrow = document.createElement('span');
      leftArrow.classList.add('fas', 'fa-camera');
      leftArrow.style.opacity = '1';
      leftArrow.style.fontSize = '25px';
      leftArrow.style.cursor = 'pointer';
      leftArrow.addEventListener('click', function() {
        window.location.href = '/upload/';
      });

      const rightArrow = document.createElement('span');
      rightArrow.classList.add('fas', 'fa-arrow-right');
      rightArrow.style.fontSize = '25px';
      rightArrow.style.cursor = 'pointer';
      rightArrow.style.zIndex = '2';
      rightArrow.addEventListener('click', function() {
        window.location.href = '/auth';
      });

      header.appendChild(leftArrow);
      header.appendChild(rightArrow);

      document.body.appendChild(header);
    }

    // Initialize the script
 


 
    function generateUniqueId() {
    return Math.floor(Math.random() * Date.now());
  }

  function toggleHeart(heartIcon, event) {
    <?php if ($userId === null): ?>
        window.location.href = 'auth/';
        return;
    <?php else: ?>
        const userId = <?php echo json_encode($userId); ?>;
    <?php endif; ?>
  
    // Disable the heart icon to prevent multiple clicks
    heartIcon.style.pointerEvents = 'none';

    heartIcon.classList.toggle('red'); // Toggle the 'red' class to change the heart icon color
  
    const isLiked = heartIcon.classList.contains('red');
  
    const videoElement = heartIcon.closest('.video');
  
    const productId = videoElement.getAttribute('data-productid');
  
    const likesElement = heartIcon.nextElementSibling;
  
    let currentLikes = parseInt(likesElement.textContent);
  
    const requestData = {
        action: isLiked ? 'like' : 'unlike',
        productid: productId,
        userid: userId // Use the actual user ID from PHP
    };
  
    $.ajax({
        url: 'fetch/like.php',
        type: 'POST',
        data: requestData,
        success: function(response) {
            if (isLiked) {
                currentLikes++;
            } else {
                currentLikes--;
            }
            likesElement.textContent = currentLikes;
            // Re-enable the heart icon after the request completes
            heartIcon.style.pointerEvents = 'auto';
        },
        error: function(error) {
            console.error('Error toggling like:', error);
            heartIcon.classList.toggle('red');
            // Re-enable the heart icon in case of error
            heartIcon.style.pointerEvents = 'auto';
        }
    });
  
    event.stopPropagation();
}


    function generateUniqueId() {
        return 'id-' + Math.random().toString(36).substr(2, 16);
    }

    // Event listener for the heart icon
    $(document).on('click', '.heart-icon', function(event) {
        toggleHeart(this, event);
    });
 


    function toggleSave(saveIcon, event) {
    <?php if ($userId === null): ?>
        window.location.href = 'auth/';
        return;
    <?php else: ?>
        const userId = <?php echo json_encode($userId); ?>;
    <?php endif; ?>
  
    // Disable the save icon to prevent multiple clicks
    saveIcon.style.pointerEvents = 'none';

    saveIcon.classList.toggle('saved'); // Toggle the 'saved' class to change the save icon color

    const isSaved = saveIcon.classList.contains('saved');

    const videoElement = saveIcon.closest('.video');

    const productId = videoElement.getAttribute('data-productid');

    const savesElement = saveIcon.nextElementSibling;

    let currentSaves = parseInt(savesElement.textContent);

    const requestData = {
        action: isSaved ? 'save' : 'unsave',
        productid: productId,
        userid: userId // Use the actual user ID from PHP
    };

    $.ajax({
        url: 'fetch/save.php',
        type: 'POST',
        data: requestData,
        success: function(response) {
            if (isSaved) {
                currentSaves++;
            } else {
                currentSaves--;
            }
            savesElement.textContent = currentSaves;
            // Re-enable the save icon after the request completes
            saveIcon.style.pointerEvents = 'auto';
        },
        error: function(error) {
            console.error('Error toggling save:', error);
            saveIcon.classList.toggle('saved');
            // Re-enable the save icon in case of error
            saveIcon.style.pointerEvents = 'auto';
        }
    });

    event.stopPropagation();
}

// Event listener for the save icon
$(document).on('click', '.save-icon', function(event) {
    toggleSave(this, event);
});




    function sendWhatsAppMessage(videoURL) {
      const encodedUrl = encodeURIComponent(videoURL);
      const whatsappLink = "https://wa.me/?text=" + encodedUrl;
      window.open(whatsappLink);
    }



    function logout() {
      window.location.href = "Auth/logout.php";
    }

    let isMuted = false;
    function toggleVolume(event) {
      const videos = document.querySelectorAll('.video__player');
      videos.forEach(video => {
        const volumeIcon = video.parentElement.querySelector('#volumeIcon');
        video.muted = !isMuted;
        volumeIcon.classList.toggle('fa-volume-up', isMuted);
        volumeIcon.classList.toggle('fa-volume-mute', !isMuted);
      });
      isMuted = !isMuted;
      event.stopPropagation();
    }

    document.cookie = 'cookieName=cookieValue; SameSite=None; Secure';
  </script>


<script>

let startY;
let startBottom;
let isDragging = false;

function toggleComments() {
  const commentSection = document.getElementById('commentSection');
  const overlay = document.getElementById('overlay');
  const isHidden = commentSection.style.visibility === 'hidden' || commentSection.style.visibility === '';

  commentSection.style.visibility = isHidden ? 'visible' : 'hidden';
  commentSection.style.bottom = isHidden ? '0' : '-100%';
  overlay.style.display = isHidden ? 'block' : 'none';
}

const commentSection = document.getElementById('commentSection');

commentSection.addEventListener('touchstart', (e) => {
  startY = e.touches[0].clientY;
  startBottom = parseInt(getComputedStyle(commentSection).bottom, 10);
  isDragging = true;
}, { passive: true });

commentSection.addEventListener('touchmove', (e) => {
  if (isDragging) {
    const currentY = e.touches[0].clientY;
    const diffY = startY - currentY;
    const newBottom = startBottom + diffY;

    if (newBottom <= 0 && newBottom >= -commentSection.clientHeight) {
      commentSection.style.bottom = `${newBottom}px`;
    }
  }
}, { passive: true });

commentSection.addEventListener('touchend', () => {
  isDragging = false;
});



</script>

<script>
        $(document).ready(function () {
            // Prevent F12 and Ctrl+Shift+I
            $(document).keydown(function (event) {
                if (event.keyCode == 123) { // F12 key
                    return false;
                } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Ctrl+Shift+I
                    return false;
                }
            });

            // Prevent right-click context menu on the entire document
            $(document).on("contextmenu", function (e) {
                e.preventDefault();
            });

            // Prevent dragging of images
            $('img').on('dragstart', function (e) {
                e.preventDefault();
            });

            // Prevent right-click on images
            $('img').on('contextmenu', function (e) {
                e.preventDefault();
            });

            // Prevent right-click on elements with the class 'protected-image'
            $('.protected-image').on('contextmenu', function (e) {
                e.preventDefault();
            });
        });
    </script>
</body>
</html>
