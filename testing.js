// Replace with your actual PHP script URL
const fetchCoverScript = 'fetch.php';

// DOM elements
const audioPlayer = document.getElementById('audioPlayer');
const playPauseButton = document.querySelector('.play-pause');
const backwardButton = document.querySelector('.backward');
const forwardButton = document.querySelector('.forward');
const progressBar = document.querySelector('.progress-bar');
const currentTimeDisplay = document.querySelector('.card__time-passed');
const totalTimeDisplay = document.querySelector('.card__time-left');
const card = document.getElementById('sdiv');
const closeButton = document.querySelector('.close-button');
const songNameElement = document.getElementById('songName');
const artistNameElement = document.getElementById('artistName');
const cardImgElement = document.getElementById('cardImg');

let isPlaying = false;

function reload() {
    window.location.href = window.location.href; // Add a hash to the URL
    window.location.reload(true);
}

function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = Math.floor(seconds % 60);

    return (
        String(minutes).padStart(2, "0") +
        ":" +
        String(remainingSeconds).padStart(2, "0")
    );
}

function updateDisplay() {
    currentTimeDisplay.textContent = formatTime(audioPlayer.currentTime);
    totalTimeDisplay.textContent = formatTime(audioPlayer.duration);
    updateProgress();
}

function showCard(encodedSongPath, songName, artistName, imagePath) {
    const decodedSongPath = decodeURIComponent(encodedSongPath);
    const source = document.createElement('source');
    source.src = decodedSongPath;
    source.type = 'audio/mp3';
    audioPlayer.innerHTML = '';
    audioPlayer.appendChild(source);

    songNameElement.textContent = songName;
    artistNameElement.textContent = artistName;
    cardImgElement.style.backgroundImage = `url(${imagePath})`;

    audioPlayer.load();
    audioPlayer.play().catch(error => console.error('Play failed:', error));
    card.style.display = 'block';

    updateDisplay();

    audioPlayer.addEventListener('loadedmetadata', () => {
        updateDisplay();
    });
}

function closeCard() {
    card.style.display = 'none';
    audioPlayer.pause();
    audioPlayer.currentTime = 0;
}

playPauseButton.addEventListener('click', togglePlay);
backwardButton.addEventListener('click', () => adjustPlaybackTime(-5));
forwardButton.addEventListener('click', () => adjustPlaybackTime(5));
audioPlayer.addEventListener('timeupdate', updateDisplay);
progressBar.addEventListener('input', seek);
audioPlayer.addEventListener('play', handlePlay);
audioPlayer.addEventListener('pause', handlePause);

function togglePlay() {
    isPlaying ? audioPlayer.pause() : audioPlayer.play().catch(error => console.error('Play failed:', error));
}

function adjustPlaybackTime(seconds) {
    audioPlayer.currentTime += seconds;
}

function handlePlay() {
    isPlaying = true;
    playPauseButton.innerHTML = '<span class="material-symbols-outlined"> pause</span>';
}

function handlePause() {
    isPlaying = false;
    playPauseButton.innerHTML = '<svg fill="#fff" height="22" viewBox="0 0 18 22" width="18" xmlns="http://www.w3.org/2000/svg"><path d="m0 0v22l18-11z" fill="#000"></path></svg>';
}

function updateProgress() {
    const percentage = (audioPlayer.currentTime / audioPlayer.duration) * 100;
    progressBar.value = percentage;
}

function seek() {
    const progress = parseInt(progressBar.value);
    const duration = audioPlayer.duration;
    const currentTime = (progress * duration) / 100;
    audioPlayer.currentTime = currentTime;
}