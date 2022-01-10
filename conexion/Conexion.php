<?php

    require_once ('ServerData.php');
    
    class Conexion{

        private $connection; 
        
        function __construct()
        {
            $objServer = new ServerData(); 
            try
            {
                $this->connection = new mysqli($objServer->getServer(), $objServer->getUser(), $objServer->getPassword(), $objServer->getBD());
                if($this->connection->connect_errno)
                {
                    echo "Error en la conexión".$this->connection->connect_errno; 
                }
            }
            catch(Exception $e)
            {
                echo "No se logró la conexión".$e->getMessage(); 
            }
        }

        public function executeQuery($sql)
        {
            try
            {
                $registry=$this->connection->query($sql); 
                return $registry; 
            }
            catch(Exception $e)
            {
                echo "Error en la consulta".$e->getMessage(); 
            }
        }

        public function close()
        {
            mysqli_close($this->connection); 
        }
    }

?>