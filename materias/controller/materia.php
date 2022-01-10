<?php 
    require_once ('model/materia.php'); 

    class SubjectController {
        public $objSubjectModel; 

        function __construct ()
        {
            $this->objSubjectModel = new SubjectModel(); 
        }

        public function subjectsList ()
        {
            ob_end_clean(); 
            $registros=$this->objSubjectModel->list();
            $subjects=array();
            while($renglon=mysqli_fetch_assoc($registros)){
                array_push($subjects, $renglon);
            }
            $result['subjects'] = $subjects; 
            echo json_encode($result);
        }

        public function addSubject ($name, $credits)
        {
            echo $name; 
            $sql = $this->objSubjectModel->add($name, $credits);

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

        public function updateSubject ($id, $name, $credits)
        {
            $sql = $this->objSubjectModel->update($id, $name, $credits);
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

        public function deleteSubject ($id)
        {
            $sql = $this->objSubjectModel->delete($id); 
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