<?php

   function get_data($file_data,$hrow,$hcol){
      // row_data
      $row_data_obj = new stdClass();
            
      // header table
      $header_data = array();

      for($i = 1 ; $i <= $hrow ; $i++){

         if($i == 1){
            for($j = 0 ; $j <= $hcol ; $j++){

               $data = $file_data->getCellByColumnAndRow($j, $i)->getValue();

               $row_data_obj ->{$data} = array();
               
               array_push($header_data,$data);
            }
         }
         else{
            for($j = 0 ; $j <= $hcol ; $j++){
               
               $data = $file_data->getCellByColumnAndRow($j, $i)->getValue();

               array_push($row_data_obj ->{$header_data[$j]},$data);
            }
         }
      }
      return $row_data_obj;
   }

   function show_result($data){

      $html = ''; 
      
      $count_col = count((array) $data);

      return $html=  (array) $data;
   }

   require_once $_SERVER['DOCUMENT_ROOT']."/MyPhpSpreadsheet/lib/PHPExcel-1.8/Classes/PHPExcel.php"; //เรียกใช้ไลบรารี่ PHPExcel
 
   if(!empty($_FILES['file_input'])){
 
      $file_array = explode(".", $_FILES["file_input"]["name"]);

      if($file_array[1] == "xls" || $file_array[1] == "xlsx" || $file_array[1] == "XLSX"){

         $tmpfname = $_FILES["file_input"]["tmp_name"]; 

         // ตั้งค่าไลบรารี่ PHPExcel
         $inputFileType = PHPExcel_IOFactory::identify($tmpfname);  
         $objReader = PHPExcel_IOFactory::createReader($inputFileType);  
         $objReader->setReadDataOnly(false);  

         $objPHPExcel = $objReader->load($tmpfname);  // โหลดไฟล์
         $objWorksheet = $objPHPExcel->setActiveSheetIndex(0); // เรียกใช้เฉพาะ sheet แรก
        
         //---------------------------------------------------------//
         set_time_limit(600); // เพิ่มเวลาให้สามรถประมวลผลได้นานขึ้น จากปกติ 30 วินาที
         //---------------------------------------------------------//
         
         $highestRow = $objWorksheet->getHighestRow(); // เก็บค่าจำนวนรายการ (Row)
         $highestColumn = $objWorksheet->getHighestColumn(); // เก็บค่าชื่อคอลัมภ์ เช่น 'F'
         $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn)-1; 
         
         $result_data = get_data($objWorksheet, $highestRow,$highestColumnIndex);

         echo show_result($result_data);

      }
      else{
         echo 'fail';
      }
   }
   else{
      echo 'fail';
   }
?>