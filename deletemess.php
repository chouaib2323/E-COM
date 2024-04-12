<?php

require 'connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM contacts WHERE id = $id";

$query = mysqli_query($conn, $sql);

if ($query) {

echo "<h1>Deleted successfully</h1>";

} else {



echo "Error: mysqli_error($con)";

}

?>