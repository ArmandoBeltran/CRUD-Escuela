<?php 
     require_once 'controller/materia.php'; 
     $objSubjectController = new SubjectController(); 
 
     $result = array ('error' => false); 
 
     if (isset($_GET['action']) and $_GET['action'] == 'read')
     {
         $objSubjectController->subjectsList();
     }
 
     if (isset($_GET['action']) and $_GET['action'] == 'create')
     {
         $subjectName = $_POST['name'];
         $credits = $_POST['credits'];
 
         $sql = $objSubjectController->addSubject($subjectName, $credits); 
 
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
         $id = $_POST['id_subject']; 
         $subjectName = $_POST['name'];
         $credits = $_POST['credits'];
 
         $sql = $objSubjectController->updateSubject($id, $subjectName, $credits); 
 
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
         $id = $_POST['id_subject']; 
         $sql = $objSubjectController->deleteSubject($id); 
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