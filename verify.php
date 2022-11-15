<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "iese_validation";


$mysqli = new mysqli($server, $username, $password, $database);
if ($mysqli->connect_error) {
    die("Error de conexion: " . $mysqli->connect_error);
}
//$datos = $mysqli->query("select * from curso where hash = '$id'");

$stmt = $mysqli->prepare("select * from curso where hash = ?");
$id = $_GET['id'];
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();
$datos = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="css/main.css" rel="stylesheet">
    <title>Verificacion de Certificaciones</title>
</head>
<body>
<div id="main">
    <img id="iese" src="img/logo.png">
    <h5>Verificación de Títulos</h5>
      
    <?php if($datos): ?>
            <table class="table">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Curso</th>
                </tr>
                <tr>
                    <td scope="row"><?=$datos["nombre"]?></td>
                    <td><?=$datos["fecha"]?></td>
                    <td><?=$datos["curso"]?></td>
                </tr>
                <tr>
                    <td scope="row">Estado:</td>
                    <td id="valid">Válido</td>
                    <td></td>
                </tr>
            </table>
    <?php else:?>
        <div>
            <h5 id="invalid">Consulta invalida</h5>
        </div>
    <?php endif;?>
</div>
    
</body>
</html>
