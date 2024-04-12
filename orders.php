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
<th>nom client</th>

<th>adress</th>

<th>numéro telephone </th>
<th>nom produit</th>
<th>prix produit</th>
<th>quantité produit</th>
</tr>



 <?php
require 'connection.php';

$requete= "SELECT * from commandes";

$query= mysqli_query($conn, $requete);
echo "<h1> this is the orders panel </h1>";
while($rows=mysqli_fetch_assoc($query)){

$id=$rows['id']; //delete



echo "</tr>";

echo "<td>".$rows["nomcl"]."</td>";

echo "<td>".$rows['email']."</td>";

echo "<td>".$rows['phone']."</td>";
echo "<td>".$rows['nomprd']."</td>";
echo "<td>".$rows['prix']."</td>";
echo "<td>".$rows['qnt']."</td>";

echo "<td><a href='delete.php?id=".$id."'>Delete</a></td>";
//echo "<td><a href='edit.php?id=".$id."'>update</a></td>";
echo "</tr>";}
?>
</table>
<?php
echo "<td><a href='index.php'> back to products list</a></td>";
?>
 </body>
</html>