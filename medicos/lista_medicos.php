<?php foreach ($datos_medicos as $i) { ?>
    <tr>
        <td>
            <?php echo $i['idEmpleado']; ?>
        </td>
        <td>
            <?php echo $i['apPaterno']; ?>
            <?php echo $i['apMaterno']; ?>
        </td>        
        <td>
            <?php echo $i['nombres']; ?>
        </td>
        <td>
            <?php echo $i['especialidad']; ?>
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
        <!-- <td>
            <div class="button__wrapper">
                <a class="button button--blue" href="editar?medicoID=<?php echo $i['idEmpleado']; ?>">
                    <i class="fa-solid fa-pen-to-square"></i> Editar
                </a>
                <button class="button button--red" onclick="eliminar(<?php echo $i['idEmpleado']; ?>)">
                    <i class="fa-solid fa-trash-can"></i> Eliminar
                </button>
            </div>
        </td> -->
    </tr>
<?php } ?>