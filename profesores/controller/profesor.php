<?php 
    require_once ('model/profesor.php'); 

    class ProfessorController {
        public $objProfessorModel; 

        function __construct ()
        {
            $this->objProfessorModel = new ProfessorModel(); 
        }

        public function professorsList ()
        {
            ob_end_clean(); 
            $registros=$this->objProfessorModel->list();
            $professors=array();
            while($renglon=mysqli_fetch_assoc($registros)){
                array_push($professors, $renglon);
            }
            $result['professors'] = $professors; 
            echo json_encode($result);
        }

        public function addProfessor ($name, $area, $rfc)
        {
            echo $name; 
            $sql = $this->objProfessorModel->add($name, $area, $rfc);

            if ($sql)
            {
                $result['message'] = "Se insertó con éxito"; 
            } 
            else 
            {
                $result['error'] = true; 
                $result['message'] = "Fallo al insertar"; 
            }

            echo json_encode ($result); 
        }

        public function updateProfessor ($id, $name, $area, $rfc)
        {
            $sql = $this->objProfessorModel->update($id, $name, $area, $rfc);
            if ($sql)
            {
                $result['message'] = "Se actualizó con éxito"; 
            }
            else
            {
                $result['error'] = true; 
                $result['message'] = "Fallo al actualizar"; 
            }
            
            echo json_encode($result); 
        }

        public function deleteProfessor ($id)
        {
            $sql = $this->objProfessorModel->delete($id); 
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