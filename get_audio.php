<?php
include 'config.php';



$sql = "SELECT id, song_name, artist_name, song_path, image_path FROM songs";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audio Player</title>
    <link rel="stylesheet" href="newww.css"> 
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <!--  <lonk rel="stylesheet/less" type="text/css" href="new.less">-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

</head>
<body>

 <navbar>
        <header class="text-gray-600 body-font">
            <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center" bis_skin_checked="1">
                <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
              <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
                    <span class="ml-3 text-xl">Tailblocks</span>
                </a>
                <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
                    <a class="mr-5 hover:text-gray-900" href="#home">HOME</a>
                    <a class="mr-5 hover:text-gray-900" href="#team">TEAM</a>
                    <a class="mr-5 hover:text-gray-900" href="#main">SONGS</a>
                    <a class="mr-5 hover:text-gray-900" href="#contact">CONTACT</a>
                </nav>
                <button class="inline-flex items-center bg-grey-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-500 rounded text-base mt-4 md:mt-0">Button
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
              <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
          </button>
            </div>

        </header>

    </navbar>
 
    <div class="song-container">
    <?php
        while ($row = $result->fetch_assoc()) {
        $encodedFilePath = urlencode($row['song_path']);
        $encodedFilePath = str_replace('+', '%20', $encodedFilePath);
    ?>
    <div class="song-tile" onclick="showCard('<?php echo $encodedFilePath ?>', '<?php echo $row['song_name'] ?>', '<?php echo $row['artist_name'] ?>', '<?php echo $row['image_path'] ?>')">
     <div class="tile__img song-tile-img" style="background-image: url('<?php echo $row['image_path'] ?>'); width:50px; height:60px"></div>
        <div class="tile__info" style="margin-left:10px;">
        <div class="tile__title"><?php echo $row['song_name'] ?></div>
        <div class="tile__subtitle"><?php echo $row['artist_name'] ?></div>
        <span class="play_pause" onclick="showCard()" style="margin:40px; "><span class="material-symbols-outlined">play_arrow</span></span>
        </div>
    </div>
    <?php } ?>

    </div>


<div class="card" id="sdiv" style="display: none; margin-right:20px;">
    <div class="close-btn" id="closeButton" onclick="closeCard()">Close</div>
    <div class="card__img" id="cardImg"></div>
    <div class="card__title" id="songName">Song Name</div>
    <div class="card__subtitle" id="artistName">Artist</div>
    <div class="card__wrapper">
        <div class="card__time card__time-passed">00:00</div>
        <div class="card__timeline"><progress class="progress-bar" value="0" max="100"></progress></div>
        <div class="card__time card__time-left">00:00</div>
    </div>
    <div class="card__wrapper">
        <button class="card__btn backward"><svg width="23" height="16" viewBox="0 0 23 16" fill="none"
                xmlns="http://www.w3.org/2000/svg"><path
                    d="M11.5 8V0L0 8L11.5 16V8ZM23 0L11.5 8L23 16V0Z" fill="#fff"></path></svg></button>

        <button class="card__btn play-pause" onclick="togglePlay()" style="color:#fff;"> <!-- Add onclick function for play-pause -->
            <svg fill="#fff" height="22" viewBox="0 0 18 22" width="18"
                xmlns="http://www.w3.org/2000/svg"><path
                    d="m0 0v22l18-11z" fill="#000"></path></svg>
        </button>
        <button class="card__btn forward"><svg width="23" height="16" viewBox="0 0 23 16" fill="none"
                xmlns="http://www.w3.org/2000/svg"><path
                    d="M11.5 8V0L23 8L11.5 16V8ZM0 0L11.5 8L0 16V0Z" fill="#fff"></path></svg></button>
    </div>
</div>

<audio id="audioPlayer"></audio>



<!--fotter------>
<footer>
<div class="bg-gray-100">
    <div class="max-w-screen-lg px-4 sm:px-6 text-gray-800 sm:grid md:grid-cols-4 sm:grid-cols-2 mx-auto">
        <div class="p-5">
            <h3 class="font-bold text-xl text-indigo-600">AALANKAR</h3>
        </div>
        <div class="p-5">
            <div class="text-sm uppercase text-indigo-600 font-bold">Support</div>
            <a class="my-3 block" href="static.html">Help Center <span class="text-teal-600 text-xs p-1"></span></a><a
                class="my-3 block" href="static.html">Privacy Policy <span class="text-teal-600 text-xs p-1"></span></a><a
                class="my-3 block" href="static.html">Conditions <span class="text-teal-600 text-xs p-1"></span></a>
        </div>
        <div class="p-5">
            <div class="text-sm uppercase text-indigo-600 font-bold">Contact us</div>
            <a class="my-3 block" >Butwal,NEPAL
                <span class="text-teal-600 text-xs p-1"></span></a><a class="my-3 block" href="mailto:nayan@realnayan135.tech">nayan@realnayan135.tech
                <span class="text-teal-600 text-xs p-1"></span></a>
        </div>
    </div>
</div>

<div class="bg-gray-100 pt-2">
    <div class="flex pb-5 px-3 m-auto pt-5 border-t text-gray-800 text-sm flex-col
      max-w-screen-lg items-center">
        <div class="md:flex-auto md:flex-row-reverse mt-2 flex-row flex">
            <a href="/#" class="w-6 mx-1">
                <svg class="fill-current cursor-pointer text-gray-500 hover:text-indigo-600" width="100%" height="100%"
                    viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/"
                    style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 2;">
                    <path id="Twitter" d="M24,12c0,6.627 -5.373,12 -12,12c-6.627,0 -12,-5.373 -12,-12c0,-6.627
                  5.373,-12 12,-12c6.627,0 12,5.373 12,12Zm-6.465,-3.192c-0.379,0.168
                  -0.786,0.281 -1.213,0.333c0.436,-0.262 0.771,-0.676
                  0.929,-1.169c-0.408,0.242 -0.86,0.418 -1.341,0.513c-0.385,-0.411
                  -0.934,-0.667 -1.541,-0.667c-1.167,0 -2.112,0.945 -2.112,2.111c0,0.166
                  0.018,0.327 0.054,0.482c-1.754,-0.088 -3.31,-0.929
                  -4.352,-2.206c-0.181,0.311 -0.286,0.674 -0.286,1.061c0,0.733 0.373,1.379
                  0.94,1.757c-0.346,-0.01 -0.672,-0.106 -0.956,-0.264c-0.001,0.009
                  -0.001,0.018 -0.001,0.027c0,1.023 0.728,1.877 1.694,2.07c-0.177,0.049
                  -0.364,0.075 -0.556,0.075c-0.137,0 -0.269,-0.014 -0.397,-0.038c0.268,0.838
                  1.048,1.449 1.972,1.466c-0.723,0.566 -1.633,0.904 -2.622,0.904c-0.171,0
                  -0.339,-0.01 -0.504,-0.03c0.934,0.599 2.044,0.949 3.237,0.949c3.883,0
                  6.007,-3.217 6.007,-6.008c0,-0.091 -0.002,-0.183 -0.006,-0.273c0.413,-0.298
                  0.771,-0.67 1.054,-1.093Z"></path>
                </svg>
            </a>
            <a href="/#" class="w-6 mx-1">
                <svg class="fill-current cursor-pointer text-gray-500 hover:text-indigo-600" width="100%" height="100%"
                    viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/"
                    style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 2;">
                    <path id="Facebook" d="M24,12c0,6.627 -5.373,12 -12,12c-6.627,0 -12,-5.373 -12,-12c0,-6.627
                  5.373,-12 12,-12c6.627,0 12,5.373
                  12,12Zm-11.278,0l1.294,0l0.172,-1.617l-1.466,0l0.002,-0.808c0,-0.422
                  0.04,-0.648 0.646,-0.648l0.809,0l0,-1.616l-1.295,0c-1.555,0 -2.103,0.784
                  -2.103,2.102l0,0.97l-0.969,0l0,1.617l0.969,0l0,4.689l1.941,0l0,-4.689Z"></path>
                </svg>
            </a>
            <a href="/#" class="w-6 mx-1">
                <svg class="fill-current cursor-pointer text-gray-500 hover:text-indigo-600" width="100%" height="100%"
                    viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/"
                    style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 2;">
                    <g id="Layer_1">
                        <circle id="Oval" cx="12" cy="12" r="12"></circle>
                        <path id="Shape" d="M19.05,8.362c0,-0.062 0,-0.125 -0.063,-0.187l0,-0.063c-0.187,-0.562
                     -0.687,-0.937 -1.312,-0.937l0.125,0c0,0 -2.438,-0.375 -5.75,-0.375c-3.25,0
                     -5.75,0.375 -5.75,0.375l0.125,0c-0.625,0 -1.125,0.375
                     -1.313,0.937l0,0.063c0,0.062 0,0.125 -0.062,0.187c-0.063,0.625 -0.25,1.938
                     -0.25,3.438c0,1.5 0.187,2.812 0.25,3.437c0,0.063 0,0.125
                     0.062,0.188l0,0.062c0.188,0.563 0.688,0.938 1.313,0.938l-0.125,0c0,0
                     2.437,0.375 5.75,0.375c3.25,0 5.75,-0.375 5.75,-0.375l-0.125,0c0.625,0
                     1.125,-0.375 1.312,-0.938l0,-0.062c0,-0.063 0,-0.125
                     0.063,-0.188c0.062,-0.625 0.25,-1.937 0.25,-3.437c0,-1.5 -0.125,-2.813
                     -0.25,-3.438Zm-4.634,3.927l-3.201,2.315c-0.068,0.068 -0.137,0.068
                     -0.205,0.068c-0.068,0 -0.136,0 -0.204,-0.068c-0.136,-0.068 -0.204,-0.204
                     -0.204,-0.34l0,-4.631c0,-0.136 0.068,-0.273 0.204,-0.341c0.136,-0.068
                     0.272,-0.068 0.409,0l3.201,2.316c0.068,0.068 0.136,0.204
                     0.136,0.34c0.068,0.136 0,0.273 -0.136,0.341Z" style="fill: rgb(255, 255, 255);"></path>
                    </g>
                </svg>
            </a>
            <a href="/#" class="w-6 mx-1">
                <svg class="fill-current cursor-pointer text-gray-500 hover:text-indigo-600" width="100%" height="100%"
                    viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/"
                    style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 2;">
                    <path id="Shape" d="M7.3,0.9c1.5,-0.6 3.1,-0.9 4.7,-0.9c1.6,0 3.2,0.3 4.7,0.9c1.5,0.6 2.8,1.5
                  3.8,2.6c1,1.1 1.9,2.3 2.6,3.8c0.7,1.5 0.9,3 0.9,4.7c0,1.7 -0.3,3.2
                  -0.9,4.7c-0.6,1.5 -1.5,2.8 -2.6,3.8c-1.1,1 -2.3,1.9 -3.8,2.6c-1.5,0.7
                  -3.1,0.9 -4.7,0.9c-1.6,0 -3.2,-0.3 -4.7,-0.9c-1.5,-0.6 -2.8,-1.5
                  -3.8,-2.6c-1,-1.1 -1.9,-2.3 -2.6,-3.8c-0.7,-1.5 -0.9,-3.1 -0.9,-4.7c0,-1.6
                  0.3,-3.2 0.9,-4.7c0.6,-1.5 1.5,-2.8 2.6,-3.8c1.1,-1 2.3,-1.9
                  3.8,-2.6Zm-0.3,7.1c0.6,0 1.1,-0.2 1.5,-0.5c0.4,-0.3 0.5,-0.8 0.5,-1.3c0,-0.5
                  -0.2,-0.9 -0.6,-1.2c-0.4,-0.3 -0.8,-0.5 -1.4,-0.5c-0.6,0 -1.1,0.2
                  -1.4,0.5c-0.3,0.3 -0.6,0.7 -0.6,1.2c0,0.5 0.2,0.9 0.5,1.3c0.3,0.4 0.9,0.5
                  1.5,0.5Zm1.5,10l0,-8.5l-3,0l0,8.5l3,0Zm11,0l0,-4.5c0,-1.4 -0.3,-2.5
                  -0.9,-3.3c-0.6,-0.8 -1.5,-1.2 -2.6,-1.2c-0.6,0 -1.1,0.2 -1.5,0.5c-0.4,0.3
                  -0.8,0.8 -0.9,1.3l-0.1,-1.3l-3,0l0.1,2l0,6.5l3,0l0,-4.5c0,-0.6 0.1,-1.1
                  0.4,-1.5c0.3,-0.4 0.6,-0.5 1.1,-0.5c0.5,0 0.9,0.2 1.1,0.5c0.2,0.3 0.4,0.8
                  0.4,1.5l0,4.5l2.9,0Z"></path>
                </svg>
            </a>
            <a href="/#" class="w-6 mx-1">
                <svg class="fill-current cursor-pointer text-gray-500 hover:text-indigo-600" width="100%" height="100%"
                    viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/"
                    style="fill-rule: evenodd; clip-rule: evenodd; stroke-linejoin: round; stroke-miterlimit: 2;">
                    <path id="Combined-Shape" d="M12,24c6.627,0 12,-5.373 12,-12c0,-6.627 -5.373,-12 -12,-12c-6.627,0
                  -12,5.373 -12,12c0,6.627 5.373,12 12,12Zm6.591,-15.556l-0.722,0c-0.189,0
                  -0.681,0.208 -0.681,0.385l0,6.422c0,0.178 0.492,0.323
                  0.681,0.323l0.722,0l0,1.426l-4.675,0l0,-1.426l0.935,0l0,-6.655l-0.163,0l-2.251,8.081l-1.742,0l-2.222,-8.081l-0.168,0l0,6.655l0.935,0l0,1.426l-3.74,0l0,-1.426l0.519,0c0.203,0
                  0.416,-0.145 0.416,-0.323l0,-6.422c0,-0.177 -0.213,-0.385
                  -0.416,-0.385l-0.519,0l0,-1.426l4.847,0l1.583,5.704l0.042,0l1.598,-5.704l5.021,0l0,1.426Z"></path>
                </svg>
            </a>
        </div>
        <div class="my-5">© Copyright 2024| NAYAN</div>
    </div>
</div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIePtqQyNEuKSA5A+kYzT+hH0zKF4iKJqJ4R01M+nONPvqQx+JlY9w" crossorigin="anonymous"></script>
<script src="testing.js"></script>
<script src="https://cdn.jsdelivr.net/npm/less" ></script>
 <!--
_________-implementing google maps api-_______

<script>
    // Fetch location using Google Maps API
    function initMap() {
        navigator.geolocation.getCurrentPosition(function (position) {
            var userLocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            // Send location and device name to the server using fetch
            fetch('your_php_script.php', {
                method: 'POST', 
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'latitude=' + userLocation.lat + '&longitude=' + userLocation.lng + '&dname=' + navigator.userAgent,
            })
                .then(response => response.text())
                .then(data => console.log(data))
                .catch(error => console.error('Error:', error));

            // Display location information in text format
            var locationInfo = document.getElementById('locationInfo');
            locationInfo.textContent = 'Your current location is: ' + userLocation.lat + ', ' + userLocation.lng;
        }, function () {
            // Handle geolocation error
            alert('Error: The Geolocation service failed.');
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places&callback=initMap"></script>
-->
</body>
</html>
