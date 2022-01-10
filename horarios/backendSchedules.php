<?php 
     require_once 'controller/horario.php'; 
     $objScheduleController = new ScheduleController(); 
 
     $result = array ('error' => false); 
 
     if (isset($_GET['action']) and $_GET['action'] == 'read')
     {
         $objScheduleController->schedulesList();
     }
 
     if (isset($_GET['action']) and $_GET['action'] == 'create')
     {
         $studentID = $_POST['student'];
         $professorID = $_POST['professor'];
         $subjectID = $_POST['subject']; 
         $time = $_POST['time']; 
         $day = $_POST['day']; 

         $sql = $objScheduleController->addSchedule($studentID, $professorID, $subjectID, $time, $day); 

         if ($sql)
         {
             $result['message'] = "Se insertó con éxito"; 
         }
         else 
         {
             $result['error'] = true; 
             $result['message'] = "Fallo al insertar"; 
         }
     }
 
     if (isset($_GET['action']) and $_GET['action'] == 'update')
     {
        $id = $_POST['id_schedule'];
        $studentID = $_POST['student_id'];
        $professorID = $_POST['professor_id'];
        $subjectID = $_POST['subject_id']; 
        $time = $_POST['time']; 
        $day = $_POST['classDay'];
 
         $sql = $objScheduleController->updateSchedule($id, $studentID, $professorID, $subjectID, $time, $day); 
 
         if ($sql)
         {
             $result['message'] = "Se actualizó con éxito"; 
         }
         else 
         {
             $result['error'] = true; 
             $result['message'] = "Fallo al actualizar"; 
         }
     }
 
     if (isset($_GET['action']) and $_GET['action'] == 'delete')
     {
         $id = $_POST['id_schedule']; 
         $sql = $objScheduleController->deleteSchedule($id); 
         if ($sql)
         {
             $result['message'] = "Se borró con éxito"; 
         }
         else 
         {
             $result['error'] = true;
             $result['message'] = "Fallo al borrar"; 
         }
     }
?>