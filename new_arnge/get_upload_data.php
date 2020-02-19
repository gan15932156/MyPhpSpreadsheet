<?php

   // JSON ที่แปลงเป็น String  และแปลงเป็ฯ Object
   $parse_object_data = json_decode($_POST['data']);

   // ชื่องาน
   $task_name =  $_POST['task_name'];

   // แปลง object เป็น array
   $parse_to_array = get_object_vars($parse_object_data);

   // เก็บ keys (หัวตาราง)
   $key_obj = array_keys($parse_to_array);

   // นับจำนวนรายการ
   $count_row = count($parse_object_data->{$key_obj[0]});

   for($i = 0 ; $i <= $count_row-1 ; $i++){
      for($j = 0 ; $j <= count($key_obj)-1 ; $j++){
         //echo $parse_object_data->{$key_obj[$j]}[$i];
      }
      //echo "\n";
   }
