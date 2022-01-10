<?php
    require_once ('model/alumno.php');

class AlumnoControlador{
    public $objAlumno;

    function __construct (){
            $this->objAlumno =new AlumnoModelo();
    }

    public function studentsList(){
        ob_end_clean();
        $registros=$this->objAlumno->listaAlumno();
        $students=array();
        while($renglon=mysqli_fetch_assoc($registros)){
            array_push($students, $renglon);
        }
        $result['students'] = $students; 
        echo json_encode($result); 
    }


    public function addStudent($nombre, $carrera)
    {
        echo $nombre; 
        $sql = $this->objAlumno->agregarAlumno($nombre, $carrera); 
        if ($sql)
        {
            $result['message'] = "Se insertó con éxito"; 
        }
        else
        {
            $result['error'] = true; 
            $result['message'] = "Fallo al insertar"; 
        }
        echo json_encode($result); 
    }

   public function updateStudent ($id, $name, $major)
   {
       $sql = $this->objAlumno->update($id, $name, $major); 
       if ($sql)
       {
           $result['message'] = "Se actualizó con éxito"; 
       }
       else
       {
           $result['error'] = true; 
           $result['message']  ="Fallo al actualizar";
       }
       echo json_encode ($result); 
   }

   public function deleteStudent ($id)
   {
       $sql = $this->objAlumno->delete($id); 
       if ($sql)
       {
            $result['message'] = "Se borró con éxito"; 
       }
       else 
       {
            $result['error'] = true; 
            $result['message'] = "Fallo al actualizar borrar"; 
       }

       echo json_encode($result); 
   }
}
?>