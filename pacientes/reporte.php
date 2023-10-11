<?php
session_start();
$url_base = "http://localhost/uni/dashboard";
if (!isset($_SESSION['usuario'])) {
    header("Location: $url_base/login");
}

ob_start();
include("../db.php");

$stmt = $conn->prepare("SELECT paciente.idPaciente, persona.* FROM paciente
JOIN persona ON paciente.idPersona = persona.idPersona
AND paciente.estado=1");
$stmt->execute();
$datos_pacientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
$fecha_actual = date("d/m/Y");
$hora_actual = date("H:i:s");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Pacientes | Policlínico Señor de Luren</title>
    <link rel="stylesheet" href="<?php echo $url_base; ?>/css/reporte.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">    
    <!-- UNICO INTENTO DE PONER FAVICON AL PDF -->
    <link rel="icon" type="image/png" href="<?php echo $url_base; ?>/img/logo_pdf.png">
</head>
<body>
    <main class="container">
        <div class="paciente__main">            
            <div class="logo_container">
                <img class="logo" src="<?php echo $url_base; ?>/img/logo_pdf.webp" alt="">
            </div>
            <div class="luren__info luren__info--fecha">
                <p><b>Fecha: </b><?php echo $fecha_actual; ?></p>
                <p><b>Hora: </b><?php echo $hora_actual; ?></p>
            </div>
            <div class="luren__info luren__info--contacto">
                <p><b>Horario: </b>10:00 AM - 9:00 PM</p>
                <p><b>Dirección: </b>Av. San Martín, Ica</p>
                <p><b>Teléfono: </b>963258741</p>
                <p><b>Correo: </b>contacto@senordeluren.com</p>
            </div>            
            <hr>
            <p class="luren__titulo">Reporte de Pacientes</p>
            <table class="table">
                <thead>
                    <tr>
                        <th class="table__th--n">N°</th>
                        <th class="table__th--apellidos">Apellidos</th>                        
                        <th class="table__th--nombres">Nombres</th>
                        <th class="table__th--tipoDoc">Tipo Documento</th>
                        <th class="table__th--numDoc">Num Documento</th>
                        <th class="table__th--direccion">Dirección</th>
                        <th class="table__th--telefono">Teléfono</th>
                    </tr>
                </thead>
                <tbody id="tbodyPacientes">
                <?php foreach ($datos_pacientes as $i) { ?>
                    <tr>
                        <td>
                            <?php echo $i['idPaciente']; ?>
                        </td>
                        <td>
                            <?php echo $i['apPaterno']; ?>
                            <?php echo $i['apMaterno']; ?>
                        </td>        
                        <td>
                            <?php echo $i['nombres']; ?>
                        </td>
                        <td>
                            <?php echo $i['tipoDocumento']; ?>
                        </td>
                        <td>
                            <?php echo $i['numDocumento']; ?>
                        </td>
                        <td>
                            <?php echo $i['direccion']; ?>
                        </td>
                        <td>
                            <?php echo $i['telefono']; ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>        
    </main>    
</body>
</html>
<?php
$html=ob_get_clean();
require_once "../libs/dompdf/autoload.inc.php";
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled'=>true));
$dompdf->setOptions($options);

$dompdf->loadHtml($html);
$dompdf->setPaper("A4","portrait");
$dompdf->render();

$dompdf->stream("reporte_pacientes",array("Attachment"=>false));
/* echo $html; */
?>