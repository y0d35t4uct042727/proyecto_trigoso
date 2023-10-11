<?php foreach ($datos_especialidades as $i) { ?>
    <tr>
        <td>
            <?php echo $i['idEspecialidad']; ?>
        </td>      
        <td>
            <?php echo $i['especialidad']; ?>
        </td>
        <td>
            <?php echo $i['descripcion']; ?>
        </td>
        <td>
            <div class="button__wrapper">
                <a class="button button--blue" href="editar?especialidadID=<?php echo $i['idEspecialidad']; ?>">
                    <i class="fa-solid fa-pen-to-square"></i> Editar
                </a>
                <button class="button button--red" onclick="eliminar(<?php echo $i['idEspecialidad']; ?>)">
                    <i class="fa-solid fa-trash-can"></i> Eliminar
                </button>
            </div>
        </td>
    </tr>
<?php } ?>