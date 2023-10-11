<?php
include("db.php");

/* Conteo de número de pacientes */
$stmt = $conn->prepare("SELECT COUNT(*) FROM paciente WHERE estado=1");
$stmt->execute();
$num_pacientes = $stmt->fetchColumn();

/* Conteo de número de especialidades */
$stmt = $conn->prepare("SELECT COUNT(*) FROM especialidad WHERE estado=1");
$stmt->execute();
$num_especialidades = $stmt->fetchColumn();

/* Conteo de número de doctores */
$stmt = $conn->prepare("SELECT COUNT(*) FROM paciente WHERE estado=1");
$stmt->execute();
$num_doctores = $stmt->fetchColumn();

/* Conteo de número de citas */
$stmt = $conn->prepare("SELECT COUNT(*) FROM paciente WHERE estado=1");
$stmt->execute();
$num_citas = $stmt->fetchColumn();

$titulo = "Inicio | Policlínico Señor de Luren";
include("templates/nav.php");
?>

<div class="container">
    <header class="header">
        <h1 class="header__titulo">Inicio</h1>
    </header>

    <main class="main">
        <p class="main__bienvenido">Bienvenido al Policlínico Señor de Luren</p>
        <h2 class="main__titulo">Panel administrativo</h2>
        <div class="main__table">
            <div class="cards__wrapper">
                <a href="citas">
                    <div class="cards">
                        <div>
                            <p class="cards__titulo">Número de Citas:</p>
                            <h2>0</h2>
                        </div>                    
                        <i class="fa-regular fa-calendar-days"></i>
                    </div>
                </a>
                <a href="medicos">
                    <div class="cards">
                        <div>
                            <p class="cards__titulo">Número de Médicos:</p>
                            <h2>0</h2>
                        </div>
                        <i class="fa-solid fa-stethoscope"></i>
                    </div>
                </a>                
                <a href="especialidades">
                    <div class="cards">
                        <div>
                            <p class="cards__titulo">Número de Especialidades:</p>
                            <h2><?php echo $num_especialidades; ?></h2>                            
                        </div>
                        <i class="fa-solid fa-suitcase-medical"></i>
                    </div>
                </a>
                <a href="pacientes">
                    <div class="cards">
                        <div>
                            <p class="cards__titulo">Número de Pacientes: </p>
                            <h2><?php echo $num_pacientes; ?></h2>
                        </div>
                        <i class="fa-solid fa-person"></i>
                    </div>
                </a> 
            </div>            
        </div>
    </main>
</div>