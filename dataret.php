<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers');


$request = $_SERVER['REQUEST_METHOD'];

switch ($request) {
    case 'GET':
        getmethod();
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        putmethod($data);
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        postmethod($data);
        break;
    case 'DELETE':
        $data = json_decode(file_get_contents('php://input'), true);
        deletemethod($data);
        break;
    default:
        echo '{"result": "data not found"}';
        break;
}

//data read part are here
function getmethod(){
    include "connection.php";
    $sql = "SELECT * FROM products";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $rows = array();
        while ($r = mysqli_fetch_assoc($result)) {
            $rows["result"][] = $r;
        }
        echo json_encode($rows);
    } else {
        echo '{"result": "no data found"}';
    }
}

//data insert part are here
function postmethod($data) {
    include "connection.php";

    // Extracting data from the $data array
    $nomcl = $data["nomcl"];
    $email = $data["email"];
    $phone = $data["phone"];
    $products = $data["products"];
   
    // Loop through the products array to insert each product
    foreach ($products as $product) {
        $nomprd = $product["nomprd"];
        $prix = $product["prix"];
        $qnt = $product["qnt"];

        // SQL query to insert each product
        $sql = "INSERT INTO commandes (nomcl, email, phone, nomprd, prix, qnt) 
                VALUES ('$nomcl', '$email', '$phone', '$nomprd', '$prix', '$qnt')";

        if (mysqli_query($conn, $sql)) {
            echo '{"result": "data inserted"}';
        } else {
            echo '{"result": "data not inserted"}';
        }
    }
}

//data edit part are here
function putmethod($data) {
    include "db.php";
    $id = $data["id"];
    $name = $data["name"];
    $email = $data["email"];

    $sql = "UPDATE learnhunter SET name='$name', email='$email', created_at=NOW() where id='$id'";

    if (mysqli_query($conn , $sql)) {
        echo '{"result": "Update Succesfully"}';
    } else {
        echo '{"result": "not updated"}';
    }
}

//delete method are here
function deletemethod($data) {
    include "db.php";

    $id = $data["id"];
    $sql = "DELETE FROM learnhunter where id=$id";

    if (mysqli_query($conn , $sql)) {
        echo '{"result": "delete Succesfully"}';
    } else {
        echo '{"result": "not deleted"}';
    }
}
?>
