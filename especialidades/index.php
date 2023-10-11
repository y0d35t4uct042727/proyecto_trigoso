<?php
$titulo = "Especialidades | Policlínico Señor de Luren";
include("../templates/nav.php");
?>

<div class="container">
    <header class="header">
        <h1 class="header__titulo">Especialidades</h1>
    </header>

    <main class="main">
        <div class="main__header">
            <div class="button__wrapper">
                <a class="button button--green button--nuevo" href="nuevo">
                    <i class="fa-solid fa-notes-medical"></i> Nueva Especialidad
                </a>
                <a class="button button--orange" href="reporte" target="_blank">
                    <i class="fa-solid fa-file-pdf"></i> Generar Reporte PDF
                </a>
            </div>
            <div class="buscar__wrapper">
                <label for="inputBuscar">Buscar:</label>
                <input class="input input--buscar" type="text" id="inputBuscar" placeholder="Buscar por especialidad">
            </div>            
        </div>
        <div class="main__table">
            <table class="table">
                <thead>
                    <tr>
                        <th class="table__th--n">N°</th>
                        <th class="table__th--especialidad">Especialidad</th>
                        <th class="table__th--descripcion">Descripción</th>
                        <th class="table__th--acciones">Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbodyEspecialidades">
                </tbody>
            </table>
        </div>
    </main>
</div>

<section class="modal-eliminar">
    <div class="modal__container">
        <p class="modal-eliminar__icon">
            <i class="fa-solid fa-exclamation"></i>
        </p>
        <p>¿Estás seguro de eliminar a la especialidad N°<span id="textoId"></span>?</p>
        <div class="modal__wrapper">
            <button class="modal__button button--red" id="btnConfirmar">SI</button>
            <button class="modal__button button--green" id="btnCancelar">NO</button>
        </div>
    </div>
</section>


<script defer src="<?php echo $url_base; ?>/js/especialidades.js"></script>