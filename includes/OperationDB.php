<?php
    class OperationDB{
        private $con;
        function __construct(){
            require_once dirname(__FILE__).'/ConnectDB.php';
            $db= new ConnectDB();
            $this->con= $db->connect();
        }
        public function CreateUser($username,$password,$email){
            if($this->isUserExist($username,$email)){
                return 0;
            }
            else
            {
                $pass=md5($password);
                $CreateQuery=$this->con->prepare("INSERT INTO `user data` 
                (`id`, `Username`,`Password`,`Email`) VALUES (NULL,?,?,?);");
                    $CreateQuery->bind_param("sss",$username,$pass,$email);
                if($CreateQuery->execute()){
                    return 1;
                }
                else{
                    return 2;
                }
            }
        }
        public function ShowAll(){
            $sql="SELECT id,Username,email FROM `user data`;";
            $result=mysqli_query($this->con,$sql);
            return $result;
        }
        public function LoginUser($username,$password){
            $pass=md5($password);
            $LoginQuery=$this->con->prepare("SELECT id FROM `user data` WHERE username=? AND password=?");
            $LoginQuery->bind_param("ss",$username, $pass);
            $LoginQuery->execute();
            $LoginQuery->store_result();
            return $LoginQuery->num_rows>0;
        }
        public function DeleteUser($id){
            $DeleteQuery=$this->con->prepare("DELETE from `user data` where id=?");
            $DeleteQuery->bind_param("i",$id);
        }
        private function isUserExist($username,$email){
            $CheckQuery=$this->con->prepare("SELECT id FROM `user data` WHERE
            username=? or email=?");
            $CheckQuery->bind_param("ss",$username,$email);
            $CheckQuery->execute();
            $CheckQuery->store_result();
            return $CheckQuery->num_rows>0;
        }
    }