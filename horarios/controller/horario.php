<?php 
    require_once ('model/horario.php'); 

    class ScheduleController {
        public $objScheduleModel; 

        function __construct ()
        {
            $this->objScheduleModel = new ScheduleModel(); 
        }

        public function schedulesList ()
        {
            ob_end_clean(); 
            $registros=$this->objScheduleModel->list();
            $schedules=array();
            while($renglon=mysqli_fetch_assoc($registros)){
                array_push($schedules, $renglon);
            }
            $result['schedules'] = $schedules; 
            echo json_encode($result);
        }

        public function addSchedule ($studentID, $professorID, $subjectID, $time, $day)
        {
            echo $time; 
            $sql = $this->objScheduleModel->add($studentID, $professorID, $subjectID, $time, $day);

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

        public function updateSchedule ($id, $studentID, $professorID, $subjectID, $time, $day)
        {
            $sql = $this->objScheduleModel->update($id, $studentID, $professorID, $subjectID, $time, $day);
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

        public function deleteSchedule ($id)
        {
            $sql = $this->objScheduleModel->delete($id); 
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