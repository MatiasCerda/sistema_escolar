<?php

/**
 * Plantilla general de controladores
 * Versión 1.0.2
 *
 * Controlador de materias
 */
class materiasController extends Controller {
  private $id  = null;
  private $rol = null;

  function __construct()
  {
    // Validación de sesión de usuario, descomentar si requerida
    if (!Auth::validate()) {
      Flasher::new('Debes iniciar sesión primero.', 'danger');
      Redirect::to('login');
    }

    $this->id  = get_user('id');
    $this->rol = get_user_role();
  }
  
  function index()
  {
    if (!is_admin($this->rol)) {
      Flasher::new(get_notificaciones(), 'danger');
      Redirect::to('dashboard');
    }

    $data = 
    [
      'title'    => 'Todas las Materias',
      'slug'     => 'materias',
      'button'   => ['url' => 'materias/agregar', 'text' => '<i class="fas fa-plus"></i> Agregar materia'],
      'materias' => materiaModel::all_paginated()
    ];
    
    // Descomentar vista si requerida
    View::render('index', $data);
  }

  function ver($id)
  {
    if (!is_admin($this->rol)) {
      Flasher::new(get_notificaciones(), 'danger');
      Redirect::to('dashboard');
    }

    if (!$materia = materiaModel::by_id($id)) {
      Flasher::new('No existe la materia en la base de datos.', 'danger');
      Redirect::to('materias');
    }

    $data = 
    [
      'title'    => sprintf('Viendo %s', $materia['nombre']),
      'slug'     => 'materias',
      'button'   => ['url' => 'materias', 'text' => '<i class="fas fa-table"></i> Materias'],
      'm'        => $materia
    ];
    
    View::render('ver', $data);
  }

  function asignadas()
  {
    if (!is_profesor($this->rol)) {
      Flasher::new(get_notificaciones(), 'danger');
      Redirect::to('dashboard');
    }

    $id_profesor = get_user('id');
    $data =
    [
      'title'    => 'Materias Asignadas',
      'slug'     => 'materias',
      'materias' => materiaModel::materias_profesor($id_profesor)
    ];

    View::render('asignadas', $data);
  }

  function agregar()
  {
    if (!is_admin($this->rol)) {
      Flasher::new(get_notificaciones(), 'danger');
      Redirect::to('dashboard');
    }

    $data =
    [
      'title' => 'Agregar Materia',
      'slug'  => 'materias'
    ];

    View::render('agregar', $data);
  }

  function post_agregar()
  {
    try {
      if (!check_posted_data(['csrf','nombre','descripcion'], $_POST) || !Csrf::validate($_POST['csrf'])) {
        throw new Exception(get_notificaciones());
      }

      // Validar rol
      if (!is_admin($this->rol)) {
        throw new Exception(get_notificaciones(1));
      }

      $nombre      = clean($_POST["nombre"]);
      $descripcion = clean($_POST["descripcion"]);

      // Validar la longitud del nombre
      if (strlen($nombre) < 5) {
        throw new Exception('El nombre de la materia es demasiado corto.');
      }

      // Validar que el nombre de la materia no exista en la base de datos
      $sql = 'SELECT * FROM materias WHERE nombre = :nombre LIMIT 1';
      if (materiaModel::query($sql, ['nombre' => $nombre])) {
        throw new Exception(sprintf('Ya existe la materia <b>%s</b> en la base de datos.', $nombre));
      }

      $data =
      [
        'nombre'      => $nombre,
        'descripcion' => $descripcion,
        'creado'      => now()
      ];

      // Insertar a la base de datos
      if (!$id = materiaModel::add(materiaModel::$t1, $data)) {
        throw new Exception('Hubo un error al guardar el registro.');
      }

      Flasher::new(sprintf('Materia <b>%s</b> agregada con éxito.', $nombre), 'success');
      Redirect::back();

    } catch (PDOException $e) {
      Flasher::new($e->getMessage(), 'danger');
      Redirect::back();
    } catch (Exception $e) {
      Flasher::new($e->getMessage(), 'danger');
      Redirect::back();
    }
  }

  function post_editar()
  {
    try {
      if (!check_posted_data(['csrf','id','nombre','descripcion'], $_POST) || !Csrf::validate($_POST['csrf'])) {
        throw new Exception('Acceso no autorizado.');
      }

      // Validar rol
      if (!is_admin($this->rol)) {
        throw new Exception(get_notificaciones(1));
      }

      $id          = clean($_POST["id"]);
      $nombre      = clean($_POST["nombre"]);
      $descripcion = clean($_POST["descripcion"]);

      if (!$materia = materiaModel::by_id($id)) {
        throw new Exception('No existe la materia en la base de datos.');
      }

      // Validar la longitud del nombre
      if (strlen($nombre) < 5) {
        throw new Exception('El nombre de la materia es demasiado corto.');
      }

      // Validar que el nombre de la materia no exista en la base de datos
      $sql = 'SELECT * FROM materias WHERE id != :id AND nombre = :nombre LIMIT 1';
      if (materiaModel::query($sql, ['id' => $id, 'nombre' => $nombre])) {
        throw new Exception(sprintf('Ya existe la materia <b>%s</b> en la base de datos.', $nombre));
      }

      $data =
      [
        'nombre'      => $nombre,
        'descripcion' => $descripcion
      ];

      // Insertar a la base de datos
      if (!materiaModel::update(materiaModel::$t1, ['id' => $id], $data)) {
        throw new Exception('Hubo un error al actualizar el registro.');
      }

      Flasher::new(sprintf('Materia <b>%s</b> actualizada con éxito.', $nombre), 'success');
      Redirect::back();

    } catch (PDOException $e) {
      Flasher::new($e->getMessage(), 'danger');
      Redirect::back();
    } catch (Exception $e) {
      Flasher::new($e->getMessage(), 'danger');
      Redirect::back();
    }
  }

  function borrar($id)
  {
    try {
      if (!check_get_data(['_t'], $_GET) || !Csrf::validate($_GET['_t'])) {
        throw new Exception(get_notificaciones());
      }

      // Validar rol
      if (!is_admin($this->rol)) {
        throw new Exception(get_notificaciones(1));
      }

      if (!$materia = materiaModel::by_id($id)) {
        throw new Exception('No existe la materia en la base de datos.');
      }

      // Eliminar registro de la base de datos
      if (!materiaModel::remove(materiaModel::$t1, ['id' => $id], 1)) {
        throw new Exception(get_notificaciones(4));
      }

      Flasher::new(sprintf('Materia <b>%s</b> borrada con éxito.', $materia['nombre']), 'success');
      Redirect::back();

    } catch (PDOException $e) {
      Flasher::new($e->getMessage(), 'danger');
      Redirect::back();
    } catch (Exception $e) {
      Flasher::new($e->getMessage(), 'danger');
      Redirect::back();
    }
  }
}