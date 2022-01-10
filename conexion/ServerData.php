<?php
    class ServerData{

        /*private $server="b4pzbbbgbedexsn1vq3o-mysql.services.clever-cloud.com"; 
        private $user="ug8yuban1iwj6yty"; 
        private $password="CxTg4bz5DcIxHQAbsTb2"; 
        private $bd="b4pzbbbgbedexsn1vq3o";*/
        private $server = "localhost"; 
        private $user = "root"; 
        private $password = ""; 
        private $bd = "bd_university"; 

        public function getServer()
        {
            return $this->server; 
        }

        public function getUser()
        {
            return $this->user; 
        }

        public function getPassword()
        {
            return $this->password; 
        }

        public function getBD()
        {
            return $this->bd; 
        }
    }
?>