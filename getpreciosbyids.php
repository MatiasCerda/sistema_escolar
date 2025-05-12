<?php
// Codigo que va en el get_info.phtml en la parte del case
case 'getPreciosByIds':
    $ids = json_decode($_REQUEST['ids'], true); 
    $resultados = db_get_precioById($ids);
    print_r(safe_json_encode($resultados));
    break;


// Codigo que va en db_getInfo.proc_nice

function db_get_precioById($ids){
    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conexion = crearConexion();
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql =      ' SELECT '
    .                    ' id, '
    .                    ' precio, '
    .                    ' precio_inmutable, '
    .                    ' precio_ajustado, '
    .                    ' total_ajustado '
    .             ' FROM '
    .                    ' dictuc_intranet.sc2_servicio_cotizacion '
    .            ' WHERE '
    .                    ' id'
    .                   ' IN ('.$placeholders.') ';

    $statement = $conexion->prepare($sql);
    $types = str_repeat('i', count($ids));
    $statement->bind_param($types, ...$ids);
    
    $arrResultado = [];
    if ($statement->execute()) {
        $statement->bind_result($id, $precio, $precio_inmutable, $precio_ajustado, $total_ajustado);
        while ($statement->fetch()) {
            $arrResultado[] = [
                'id' => $id,
                'precio' => $precio,
                'precio_inmutable' => $precio_inmutable,
                'precio_ajustado' => $precio_ajustado,
                'total_ajustado' => $total_ajustado
            ];
        }
        $statement->close();
        $conexion->close();

        return $arrResultado;
    } else {
        error_log("Error al ejecutar la consulta para los IDs: " . implode(", ", $ids));
        return ['error' => 'Error al ejecutar la consulta.'];
    }

}