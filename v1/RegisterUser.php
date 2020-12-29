<?php
    require_once '../includes/OperationDB.php';
    $response=array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(
            !empty($_POST['username']) and
                !empty($_POST['email']) and
                    !empty($_POST['password'])
        )
        {
            $db=new OperationDB();
            $OperationResult=$db->CreateUser(
                $_POST['username'],
                $_POST['password'],
                $_POST['email']);
            if($OperationResult==0){
                $response['error']=true;
                $response['message']="User already exists!";
            }
            elseif($OperationResult==1)
            {
                    $response['error']=false;
                    $response['message']="User registered successfully";
            }
            else
            {
                $response['error']=true;
                $response['message']="Some error occured please try again";
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