<?php
require_once('respuestas_json.php');

class Conexion {

    //  Parámetros de conexión
    private $host = "localhost";
    private $db = "proyectos";
    private $usuario = "root";
    private $pass = "";
    private $conexion = null;

    function __construct() {
        try {
            // Establecer conexión con la BD
            $this->conexion = new PDO (
                'mysql:host='.$this->host.
                ';dbname='.$this->db,
                $this->usuario,
                $this->pass
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $e) { die ($e->getMessage()); }
    }

    public function eliminarProyecto ($id, $key) {

        if ($key != getenv ('key')) {
            return accesoNoPermitido ();
        }
        if ($id === '') return;
        
        try {
            $sql = $this->conexion->prepare ('DELETE FROM ProyectosRealizados WHERE proyecto_id = :id');
            $sql->execute (array('id'=> $id));

            return operacionExitosa ('eliminacion');
        }
        catch (Exception $e) { return error ($e->getMessage()); }
        catch (PDOException $e) { return error ($e->getMessage()); }
    }

    public function agregarproyecto ($info, $key) {

        if ($key != getenv ('key')) {
            return accesoNoPermitido (); 
        }
        if (!is_array ($info)) {
            return datosFaltantes ();
        }
        $proyecto =      $info;
        $requerido =     array ('proyecto_id','nombre','descripcion','habilidades','portada','repositorio','enlace');
        $discrepancias = array_diff_key ($requerido, array_keys ($proyecto));

        if($discrepancias != null) {
            return datosFaltantes ();
        }

        try {
            // Agregar proyecto a la base de datos
            $sql = $this->conexion->prepare (
            'INSERT INTO ProyectosRealizados VALUES (
                :proyecto_id,
                :nombre,
                :descripcion,
                :habilidades,
                :portada,
                :repositorio,
                :enlace
            )');
            $sql->execute (array (
                'proyecto_id' => $proyecto ['proyecto_id'],
                'nombre'      => $proyecto ['nombre'],
                'descripcion' => $proyecto ['descripcion'],
                'habilidades' => $proyecto ['habilidades'],
                'portada'     => $proyecto ['portada'],
                'repositorio' => $proyecto ['repositorio'],
                'enlace'      => $proyecto ['enlace']
            ));

            return operacionExitosa ("insersion");
        }
        catch (Exception $e) { return error ($e->getMessage()); }
        catch (PDOException $e) { return error ($e->getMessage()); }
    }

    public function actualizarProyecto ($id, $info, $key) {

        if ($key != getenv ('key')) {
            return accesoNoPermitido (); 
        }
        if (!is_array ($info)) {
            return datosFaltantes ();
        }
        $proyecto =      $info;
        $requerido =     array ('nombre','descripcion','habilidades','portada','repositorio','enlace');
        $discrepancias = array_diff_key ($requerido, array_keys ($proyecto));

        if($discrepancias != null) {
            return datosFaltantes ();
        }

        try {
            $sql = $this->conexion->prepare ('UPDATE ProyectosRealizados SET 
                nombre = :nombre,
                descripcion = :descripcion,
                habilidades = :habilidades,
                portada = :portada,
                repositorio = :repositorio,
                enlace = :enlace WHERE proyecto_id = :proyecto_id
            ');
            $sql->execute (array (
                'proyecto_id' => $id,
                'nombre'      => $proyecto ['nombre'],
                'descripcion' => $proyecto ['descripcion'],
                'habilidades' => $proyecto ['habilidades'],
                'portada'     => $proyecto ['portada'],
                'repositorio' => $proyecto ['repositorio'],
                'enlace'      => $proyecto ['enlace']
            ));

            return operacionExitosa ("actualizacion");
        }
        catch (Exception $e) { return error ($e->getMessage()); }
        catch (PDOException $e) { return error ($e->getMessage()); }
    }

    public function obtenerProyectos () {

        try {
            $sql = $this->conexion->prepare ('SELECT * FROM ProyectosRealizados');
            $sql->execute ();
            $proyectos = $sql->fetchAll (PDO::FETCH_ASSOC);

            // Retornar todos los proyectos
            return json_encode ($proyectos, true);
        }
        catch (Exception $e) { return error ($e->getMessage()); }
        catch (PDOException $e) { return error ($e->getMessage()); }

    }
    public function obtenerProyecto ($id) {

        if ($id === '') return;

        try {
            $sql = $this->conexion->prepare ('SELECT * FROM ProyectosRealizados WHERE proyecto_id = :id');
            $sql->execute (array ('id' => $id));
            $resultado = $sql->fetch (PDO::FETCH_ASSOC);

            if($resultado == null) {
                return sinResultado ();
            }

            // Retornar proyecto solicitado
            return json_encode ($resultado, true);
        }
        catch (Exception $e) { return error ($e->getMessage()); }
        catch (PDOException $e) { return error ($e->getMessage()); }
    }
}

?>