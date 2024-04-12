<!DOCTYPE html>

 <html lang="en">
 <head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.e">
<title>Document</title>
 </head>

 <body>
 <table border="1">
 <tr>
<th>nom client </th>

<th>email</th>

<th>message</th>

</tr>



 <?php
require 'connection.php';

$requete= "SELECT * from contacts";

$query= mysqli_query($conn, $requete);
echo "<h2> messages des client :  </h2>";
while($rows=mysqli_fetch_assoc($query)){

$id=$rows['id']; //delete



echo "</tr>";

echo "<td>".$rows["nom"]."</td>";

echo "<td>".$rows['email']."</td>";

echo "<td>".$rows['message']."</td>";


echo "<td><a href='deletemess.php?id=".$id."'>Delete</a></td>";
echo "</tr>";}
?>
</table>
<?php
echo "<td><a href='index.php'> les produits</a></td><br/>";
?>
 </body>
</html>