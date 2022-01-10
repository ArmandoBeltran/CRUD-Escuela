<?php 
    require_once 'controller/alumno.php';
    $objStudentController = new AlumnoControlador(); 

    $result = array ('error' => false); 

    /**Students */

    if (isset($_GET['action']) and $_GET['action'] == 'read')
    {
        $objStudentController->studentsList();
    }

    if (isset($_GET['action']) and $_GET['action'] == 'create')
    {
        $studentName = $_POST['name'];
        $major = $_POST['major'];

        $sql = $objStudentController->addStudent($studentName, $major); 

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
        $id = $_POST['id_student']; 
        $studentName = $_POST['name'];
        $major = $_POST['major'];

        $sql = $objStudentController->updateStudent($id, $studentName, $major); 
        

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
        $id = $_POST['id_student']; 
        $sql = $objStudentController->deleteStudent($id); 
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