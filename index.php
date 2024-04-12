
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
<th>nom produit </th>

<th>prix produit</th>

<th>src image</th>

</tr>
 <?php
require 'connection.php';

$requete= "SELECT * from products";

$query= mysqli_query($conn, $requete);
echo "<h1> this is the admin panel </h1>";
echo "<h2> this our availble products :  </h2>";
while($rows=mysqli_fetch_assoc($query)){

$id=$rows['id']; //delete



echo "</tr>";

echo "<td>".$rows["nom"]."</td>";

echo "<td>".$rows['prix']."</td>";

echo "<td>".$rows['image']."</td>";


echo "<td><a href='delete.php?id=".$id."'>Delete</a></td>";
echo "<td><a href='edit.php?id=".$id."'>update</a></td>";
echo "</tr>";}
?>
</table>
<?php
echo "<td><a href='addproduct.php'> add a product</a></td><br/>";
echo "<td><a href='orders.php'> order list</a></td><br/>";
echo "<td><a href='messdecl.php'> les message de client</a></td>";
?>
 </body>
</html>