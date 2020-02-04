<?php 

include 'configDB.php';
$conn = $DBconnect;

$table_class = new stdClass();

$response = array();

$tb_name = "tb_test_sale_excel";

$sql = "SELECT * FROM `data_dic_ref` WHERE `tb_ref_name` = "."'".$tb_name."'";

$sql2 = "SELECT * FROM ".$tb_name;

$result = mysqli_query($conn,$sql);

$header_array = array();


array_push($header_array,"primary_key");

$table_class->primary_key = array();

while($row = mysqli_fetch_row($result)){ // push หัวตาราง
   
    $field_name = $row[1];

    array_push($header_array,$row[1]);

    $table_class->{$field_name} = array();
 }
 //print_r($table_class);
 $result = mysqli_query($conn,$sql2);
 if($result){
    while($row = mysqli_fetch_row($result)){  // push ข้อมูล

       $i = 0 ;

       $data = array();
       foreach($row as $cell){
          if($i ==1){
                @array_push($table_class->{$header_array[$i]},strval($cell)); 
             $i++;
          }
          else{
            
             if(is_numeric($cell)){
                @array_push($table_class->{$header_array[$i]},floatval($cell)); 
             }
             else{
                @array_push($table_class->{$header_array[$i]},strval($cell)); 
             }
             $i++;
          }
          
       }
       //$response[] = $data;
    }
 }
$jsondata = json_encode($table_class);
 
echo $jsondata;
