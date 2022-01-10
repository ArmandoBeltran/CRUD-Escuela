<?php
require_once('../conexion/Conexion.php');

class AlumnoModelo{
    private $id_alumno;
    private $nombre;
    private $carrera;
    
    

    function __construct(){
        $this->id_alumno=0;
        $this->nombre='';
        $this->carrera=0;
    }
    
    public function setIDAlumno($id)
    {
        $this->id_alumno=$id; 
    }

    public function setAlumno($nombre)
    {
        $this->nombre=$nombre; 
    }

    public function setCarrera($carrera)
    {
        $this->carrera=$carrera; 
    }



    public function listaAlumno(){
        try{
            $sql="select * from students";
            $resultado=$this->aplicarQuery($sql);
            return $resultado;
        }catch(Exception $e){
            echo "Error en la consulta".$e->getMessage();
        }
    }
  
    
    public function agregarAlumno($a, $b)
    {
        try
        {
            $sql="INSERT INTO students (name, major) VALUES ('$a', '$b')"; 
            return $this->aplicarQuery($sql); 
        }
        catch(Exception $e)
        {
            echo "Error en la consulta".$e->getMessage();
        }
    }

    public function update ($id, $name, $major)
    {
        try 
        {
            $sql = "UPDATE students SET name = '$name', major = '$major' WHERE id_student = '$id'";
            return $this->aplicarQuery($sql); 
        }
        catch (Exception $e)
        {
            echo "Error en la consulta".$e->getMessage(); 
        }
    }

    public function delete ($id)
    {
        try 
        {
            $sql = "DELETE FROM students WHERE id_student='$id'"; 
            return $this->aplicarQuery($sql); 
        }
        catch (Exception $e)
        {
            echo "Error en la consulta ".$e->getMessage(); 
        }
    }


    public function aplicarQuery($sql){
        $objconectar= new Conexion();
        $resultado=$objconectar->executeQuery($sql);
        $objconectar->close();
        return $resultado;
    }
}


?>