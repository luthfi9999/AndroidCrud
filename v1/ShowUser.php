<?php
    require_once '../includes/OperationDB.php';
    $response=array();
    $dataArray=array();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $db=new OperationDB();
        if($OperationResult=$db->ShowAll()){
            while($row=mysqli_fetch_assoc($OperationResult)){
                $dataArray[]=$row;
            }
            $response['data']=$dataArray;
            $response['error']=false;
            $response['message']="Showing Data!";
        }
        else{
            $response['error']=true;
            $response['message']="Showing failed!";  
        }
    }
    else{
        $response['error']=true;
        $response['message']="Invalid Request Bro";
    }
    echo json_encode($response);