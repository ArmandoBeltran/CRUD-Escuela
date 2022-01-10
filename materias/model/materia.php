<?php
    require_once ('../conexion/Conexion.php'); 

    class SubjectModel {

        
        public function list ()
        {
            try 
            {
                $sql = "SELECT * FROM subject"; 
                return $this->aplicarQuery($sql); 
            }
            catch (Exception $e)
            {
                echo "Error en la consulta".$e->getMessage(); 
            }
        }

        public function add ($name, $credits)
        {
            try 
            {
                $sql = "INSERT INTO subject (name, credits) VALUES ('$name','$credits')"; 
                return $this->aplicarQuery($sql); 
            }
            catch (Exception $e)
            {
                echo "Error en la consulta".$e->getMessage();
            }
        }

        public function update ($id, $name, $credits)
        {
            try 
            {
                $sql = "UPDATE subject SET name = '$name', credits = '$credits' WHERE id_subject = '$id'";
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
                $sql = "DELETE FROM subject WHERE id_subject='$id'"; 
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