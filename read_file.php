<?php
   require 'vendor/autoload.php';
   
   $inputFileType = 'Xls';
   $inputFileName = 'C:/xampp/htdocs/phpexcel/092ปี635กพ63.XLSX';
   $sheetname = 'Data Sheet #2';
   
   /**  Create a new Reader of the type defined in $inputFileType  **/
   $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
   /**  Advise the Reader of which WorkSheets we want to load  **/
   $reader->setLoadSheetsOnly($sheetname);
   /**  Load $inputFileName to a Spreadsheet Object  **/
   $spreadsheet = $reader->load($inputFileName);