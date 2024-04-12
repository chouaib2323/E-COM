<?php
require 'connection.php';

if(isset($_POST["submit"])) {
    $id = $_POST["id"]; // Assuming you have the ID of the record to update
    $name = $_POST["name"];
    $price = $_POST['prix'];

    // Check if a new image file was uploaded
    if(isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        // Check if the uploaded file is an image with a valid extension
        if (in_array($imageExtension, $validImageExtension) && $fileSize <= 10000000) { // 10MB limit
            // Move the uploaded file to the desired location
            $newImageName = uniqid() . '.' . $imageExtension;
            move_uploaded_file($tmpName, 'img/' . $newImageName);

            // Update the record in the database with the new image path
            $query = "UPDATE products SET nom = ?, prix = ?, image = ? WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sssi", $name, $price, $newImageName, $id);
            $stmt->execute();
            $stmt->close();

            echo "<script>alert('Record updated successfully');</script>";
        } else {
            echo "<script>alert('Invalid image file');</script>";
        }
    } else {
        // If no new image was uploaded, update the record without changing the image
        $query = "UPDATE products SET nom = ?, prix = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $name, $price, $id);
        $stmt->execute();
        $stmt->close();

        echo "<script>alert('Record updated successfully');</script>";
    }
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title>Update Product</title>
  </head>
  <body>
    <form class="" action="" method="post" autocomplete="off" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>"> <!-- Assuming you pass the ID via URL parameter -->
      <label for="name">nom : </label>
      <input type="text" name="name" id="name" required value=""> <br>
      <label for="name">prix : </label>
      <input type="text" name="prix" id="prix" required value=""> <br>
      <label for="image">Image : </label>
      <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png" value=""> <br> <br>
      <button type="submit" name="submit">Submit</button>
    </form>
    <br>
    <a href="allproducts.php">les produits</a>
  </body>
</html>
