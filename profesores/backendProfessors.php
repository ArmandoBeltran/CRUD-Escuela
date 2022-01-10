<?php 

    require_once 'controller/profesor.php'; 
    $objProfessorController = new ProfessorController(); 

    $result = array ('error' => false); 

    if (isset($_GET['action']) and $_GET['action'] == 'read')
    {
        $objProfessorController->professorsList();
    }

    if (isset($_GET['action']) and $_GET['action'] == 'create')
    {
        $professorName = $_POST['name'];
        $area = $_POST['area'];
        $rfc = $_POST['rfc']; 

        $sql = $objProfessorController->addProfessor($professorName, $area, $rfc); 

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
        $id = $_POST['id_professor']; 
        $professorName = $_POST['name'];
        $area = $_POST['area'];
        $rfc = $_POST['rfc'];

        $sql = $objProfessorController->updateProfessor($id, $professorName, $area, $rfc); 

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
        $id = $_POST['id_professor']; 
        $sql = $objProfessorController->deleteProfessor($id); 
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