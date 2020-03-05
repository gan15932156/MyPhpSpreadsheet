<?php

   include_once("configDB.php");

   $conn = $DBconnect;

   $response = array();

   $task_name = $_POST['task_name'];

   $task_data_sql = 'SELECT count(*) as count,substr(h3,8,3) as WBS FROM '.'`'.$task_name.'`';

   
   echo json_encode($response);