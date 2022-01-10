<?php 
    require_once ('../conexion/Conexion.php'); 

    class ProfessorModel {

        private $id_professor; 
        private $name; 
        private $area; 
        private $rfc; 

        function __construct()
        {
            $this->id_professor = 0;
            $this->name = ''; 
            $this->area = ''; 
            $this->rfc = ''; 
        }

        public function list ()
        {
            try 
            {
                $sql = "SELECT * FROM professor"; 
                return $this->aplicarQuery($sql); 
            }
            catch (Exception $e)
            {
                echo "Error en la consulta".$e->getMessage(); 
            }
        }

        public function add ($name, $area, $rfc)
        {
            try 
            {
                $sql = "INSERT INTO professor (name, area, rfc) VALUES ('$name','$area','$rfc')"; 
                return $this->aplicarQuery($sql); 
            }
            catch (Exception $e)
            {
                echo "Error en la consulta".$e->getMessage();
            }
        }

        public function update ($id, $name, $area, $rfc)
        {
            try 
            {
                $sql = "UPDATE professor SET name = '$name', area = '$area', rfc = '$rfc' WHERE id_professor = '$id'";
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
                $sql = "DELETE FROM professor WHERE id_professor='$id'"; 
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