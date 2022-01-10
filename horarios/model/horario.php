<?php
require_once ('../conexion/Conexion.php'); 

    class ScheduleModel {

        public function list ()
        {
            try 
            {
                $sql = "SELECT * FROM schedule"; 
                return $this->aplicarQuery($sql); 
            }
            catch (Exception $e)
            {
                echo "Error en la consulta".$e->getMessage(); 
            }
        }

        public function add ($studentID, $professorID, $subjectID, $time, $day)
        {
            try 
            {
                $sql = "INSERT INTO schedule (student_id, professor_id, subject_id, time, classDay) VALUES ('$studentID', '$professorID', '$subjectID', '$time', '$day')"; 
                return $this->aplicarQuery($sql); 
            }
            catch (Exception $e)
            {
                echo "Error en la consulta".$e->getMessage();
            }
        }

        public function update ($id, $studentID, $professorID, $subjectID, $time, $day)
        {
            try 
            {
                $sql = "UPDATE schedule SET student_id = '$studentID', professor_id = '$professorID', subject_id = '$subjectID', time = '$time', classDay = '$day' WHERE id_schedule = '$id'";
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
                $sql = "DELETE FROM schedule WHERE id_schedule='$id'"; 
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