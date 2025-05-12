<?php

/**
 * Plantilla general de modelos
 * Versión 1.0.1
 *
 * Modelo de profesor
 */
//Así es como trae la lista de usuarios de la base de datos, con un modelo en Model.php 
//Esto es para interactuar con los profesores en la base de datos
class profesorModel extends Model {
  public static $t1 = 'usuarios'; // Nombre de la tabla en la base de datos;
  
  // Nombre de tabla 2 que talvez tenga conexión con registros
  //public static $t2 = '__tabla 2___'; 
  //public static $t3 = '__tabla 3___'; 

  function __construct()
  {
    // Constructor general
  }
  
  static function all()
  {
    // Todos los registros
    $sql = 'SELECT * FROM usuarios WHERE rol = "profesor" ORDER BY id DESC';
    return ($rows = parent::query($sql)) ? $rows : [];
  }

  static function all_paginated()
  {
    // Todos los registros
    $sql = 'SELECT * FROM usuarios WHERE rol = "profesor" ORDER BY id DESC';
    return PaginationHandler::paginate($sql);
  }

  static function by_id($id)
  {
    // Un registro con $id
    $sql = 'SELECT * FROM usuarios WHERE rol = "profesor" AND id = :id LIMIT 1';
    return ($rows = parent::query($sql, ['id' => $id])) ? $rows[0] : [];
  }

  static function by_numero($numero)
  {
    // Un registro con $numero
    $sql = 'SELECT * FROM usuarios WHERE rol = "profesor" AND numero = :numero LIMIT 1';
    return ($rows = parent::query($sql, ['numero' => $numero])) ? $rows[0] : [];
  }

  static function asignar_materia($id_profesor, $id_materia)
  {
    $data =
    [
      'id_materia'  => $id_materia,
      'id_profesor' => $id_profesor,
    ];
// Aqui llama al metodo add de Model.php y agrega la materia y el profesor a la tabla materias_profesores 
    if (!$id = self::add('materias_profesores', $data)) return false;

    return $id;
  }

  static function quitar_materia($id_profesor, $id_materia)
  {
    $data =
    [
      'id_materia'  => $id_materia,
      'id_profesor' => $id_profesor,
    ];

    return (self::remove('materias_profesores', $data)) ? true : false;
  }

  static function eliminar($id_profesor)
  {
    $sql = 'DELETE u, mp FROM usuarios u LEFT JOIN materias_profesores mp ON mp.id_profesor = u.id WHERE u.id = :id AND u.rol = "profesor"';
    return (parent::query($sql, ['id' => $id_profesor])) ? true : false;
  }

  static function stats_by_id($id_profesor)
  {
    $materias  = 0;
    $grupos    = 0;
    $alumnos   = 0;
    $lecciones = 0;

    $sql = 
    'SELECT
      COUNT(DISTINCT m.id) AS total
    FROM
      materias m
    JOIN materias_profesores mp ON mp.id_materia = m.id
    WHERE
      mp.id_profesor = :id';
    $materias = parent::query($sql, ['id' => $id_profesor])[0]['total'];

    $sql = 
    'SELECT 
      COUNT(DISTINCT g.id) AS total
    FROM
      grupos g
    JOIN grupos_materias gm ON gm.id_grupo = g.id
    JOIN materias_profesores mp ON mp.id = gm.id_mp
    WHERE mp.id_profesor = :id';
    $grupos = parent::query($sql, ['id' => $id_profesor])[0]['total'];

    $sql = 
    'SELECT
      COUNT(DISTINCT a.id) AS total
    FROM usuarios a
    JOIN grupos_alumnos ga ON ga.id_alumno = a.id
    JOIN grupos g ON g.id = ga.id_grupo
    JOIN grupos_materias gm ON gm.id_grupo = g.id
    JOIN materias_profesores mp ON mp.id = gm.id_mp
    WHERE mp.id_profesor = :id';
    $alumnos = parent::query($sql, ['id' => $id_profesor])[0]['total'];

    $sql = 'SELECT COUNT(l.id) AS total FROM lecciones l WHERE l.id_profesor = :id';
    $lecciones = parent::query($sql, ['id' => $id_profesor])[0]['total'];

    return
    [
      'materias'  => $materias,
      'grupos'    => $grupos,
      'alumnos'   => $alumnos,
      'lecciones' => $lecciones
    ];
  }

  static function grupos_asignados($id_profesor)
  {
    $sql = 
    'SELECT DISTINCT g.*
    FROM
      grupos g
    JOIN grupos_materias gm ON gm.id_grupo = g.id
    JOIN materias_profesores mp ON mp.id = gm.id_mp
    WHERE mp.id_profesor = :id';
    return PaginationHandler::paginate($sql, ['id' => $id_profesor]);
  }

  static function asignado_a_grupo($id_profesor, $id_grupo)
  {
    $sql = 
    'SELECT DISTINCT g.*
    FROM
      grupos g
    JOIN grupos_materias gm ON gm.id_grupo = g.id
    JOIN materias_profesores mp ON mp.id = gm.id_mp
    WHERE mp.id_profesor = :id_profesor AND g.id = :id_grupo';
    return parent::query($sql, ['id_profesor' => $id_profesor, 'id_grupo' => $id_grupo]) ? true : false;
  }
}

