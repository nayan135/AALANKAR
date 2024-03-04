<?php

include 'config.php';

if(isset($_POST['submit'])){
 
  $chunkSize = 1048576; 

  $audioFileName = $_FILES['audioFile']['name'];
  $audioFileTmpName = $_FILES['audioFile']['tmp_name'];

  $imageFileName = $_FILES['imageFile']['name'];
  $imageFileTmpName = $_FILES['imageFile']['tmp_name'];

  $audioUploadDir = 'uploads/';
  $imageUploadDir = 'image_uploads/';

  if (!is_dir($audioUploadDir)) {
    mkdir($audioUploadDir, 0755, true);

  if (!is_dir($imageUploadDir)) {
    mkdir($imageUploadDir, 0755, true); 
  }

  $audioFilePath = $audioUploadDir . $audioFileName;
  $imageFilePath = $imageUploadDir . $imageFileName;

  $songName = $_POST['songName'];
  $artistName = $_POST['artistName'];
  $audioType = pathinfo($audioFileName, PATHINFO_EXTENSION);

  $imageType = pathinfo($imageFileName, PATHINFO_EXTENSION);

  if (
    move_uploaded_file($audioFileTmpName, $audioFilePath) &&
    move_uploaded_file($imageFileTmpName, $imageFilePath)
  ) {
    $sql = "INSERT INTO songs (song_name, artist_name, song_path, audio_type, image_path, image_type) VALUES (?, ?, ?, ?, ?, ?)";
  }

  $stmt = $con->prepare($sql);
  $null = NULL;
  $stmt->bind_param("ssssss", $songName, $artistName, $audioFilePath, $audioType, $imageFilePath, $imageType);

  if ($audioHandle = fopen($audioFileTmpName, "rb")) {
    while (!feof($audioHandle)) {
      $audioChunk = fread($audioHandle, $chunkSize);
      $stmt->send_long_data(2, $audioChunk); 
    }
    fclose($audioHandle);
  }

  if($stmt->execute()) {
    echo "Record created successfully";
  } else {
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
  }
} else {
  echo "Please choose both audio and image files";
}

$con->close();

?>

<!doctype html>

<form method="post" enctype="multipart/form-data">
  <label for="songName">Song Name:</label>
  <input type="text" name="songName" required><br>

  <label for="artistName">Artist Name:</label>
  <input type="text" name="artistName" required><br>

  <label for="audioFile">Audio File:</label>
  <input type="file" name="audioFile" required><br>

  <label for="imageFile">Image File:</label>
  <input type="file" name="imageFile" required><br>

  <input type="submit" name="submit" value="Upload">
</form>
</html>
