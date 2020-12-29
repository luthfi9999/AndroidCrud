<?php
    require_once '../includes/OperationDB.php';
    $response=array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(
            !empty($_POST['username']) and
                !empty($_POST['password']))
        {
            $db=new OperationDB();
            $OperationResult=$db->LoginUser(
                $_POST['username'],
                $_POST['password']);
            if($OperationResult==1){
                $response['error']=false;
                $response['message']="Login success!";
            }
            else{
                $response['error']=true;
                $response['message']="Login failed!";  
            }
        }
        else{
            $response['error']=true;
            $response['message']="Required fields are missing";
        }
    }
    else{
        $response['error']=true;
        $response['message']="Invalid Request";
    }
    echo json_encode($response);