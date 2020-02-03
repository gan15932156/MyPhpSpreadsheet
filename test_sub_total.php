<?php
   include 'configDB.php';
   $conn = $DBconnect;

   $data = array(
      array('transaction_number' => 'AB-0001','date' => '2018-08-01', 'item_number' => '0101010', 'desc' => 'This is a', 'variant_code' => '002', 'quantity' => '2','cost' => '2000'),
      array('transaction_number' => 'AB-0001','date' => '2018-08-01', 'item_number' => '0101010', 'desc' => 'This is a', 'variant_code' => '004', 'quantity' => '3','cost' => '2000'),
      array('transaction_number' => 'AB-0001','date' => '2018-08-01', 'item_number' => '0101010', 'desc' => 'This is a', 'variant_code' => '005', 'quantity' => '4','cost' => '2000'),
      array('transaction_number' => 'AB-0001','date' => '2018-08-01', 'item_number' => '0101010', 'desc' => 'This is a', 'variant_code' => '006', 'quantity' => '5','cost' => '2000'),
      array('transaction_number' => 'AB-0001','date' => '2018-08-01', 'item_number' => '0101010', 'desc' => 'This is a', 'variant_code' => '008', 'quantity' => '1','cost' => '2000'),
      array('transaction_number' => 'AB-0002','date' => '2018-08-02', 'item_number' => '0101010', 'desc' => 'This is b', 'variant_code' => '013', 'quantity' => '2','cost' => '2000'),
      array('transaction_number' => 'AB-0002','date' => '2018-08-02', 'item_number' => '0101010', 'desc' => 'This is b', 'variant_code' => '020', 'quantity' => '3','cost' => '2500'),
      array('transaction_number' => 'AB-0002','date' => '2018-08-02', 'item_number' => '0101010', 'desc' => 'This is b', 'variant_code' => '022', 'quantity' => '4','cost' => '2500'),
      array('transaction_number' => 'AB-0003','date' => '2018-08-03', 'item_number' => '0101010', 'desc' => 'This is c', 'variant_code' => '007', 'quantity' => '1','cost' => '2500'),
      array('transaction_number' => 'AB-0003','date' => '2018-08-03', 'item_number' => '0101010', 'desc' => 'This is c', 'variant_code' => '015', 'quantity' => '7','cost' => '2500')
  );



  $symbol='฿';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">

   <link rel="stylesheet" href="/phpspreadsheet/lib/Bootstrap_4/bootstrap.min.css">
   <script src="/phpspreadsheet/lib/Jquery/jquery.js"></script>
   <script src="/phpspreadsheet/lib/Bootstrap_4/bootstrap.min.js"></script>

   <style>
            table{ 
               border:1px solid gray;
               font-family:calibri,verdana,arial;
               float:none;
               margin:auto; 
            }
            th{
               background:gray;
               color:white;
               padding:0.5rem;
            }
            td{
               padding:0.5rem;
               border:1px dotted gray;
            }
            td[colspan]{
               background:whitesmoke;
            }
            .currency:before{
                content:'<?=$symbol;?>';
                color:green;
                font-weight:bold;
            }
        </style>
   <title>Document</title>
</head>
<body>
   <div class="container">
      <div class="row">
         <div class="col-md-1"></div>
         <div class="col-md-10">
            <div class="row">
               <div class="col-md-12">
               <table>
                  <tr>
                     <th>transaction_number</th>
                     <th>date</th>
                     <th>item_number</th>
                     <th>desc</th>
                     <th>variant_code</th>
                     <th>quantity</th>
                     <th>cost</th>
                  </tr>
                  <?php

                     $trans=array();
                     $dates=array();

                     $total=new stdClass;
                     $total->qty=0;
                     $total->cost=0;


                     foreach( $data as $index => $a ){
                        /*
                              Transaction number & date variables
                              - empty unless not in array
                        */
                        $tn='';
                        $dt='';

                        /* check if current transaction is already in the array - if not add it and create a new subtotal object */
                        if( !in_array( $a['transaction_number'], $trans ) ) {
                              /* assign `$dt` variable to newly discovered transaction and add to array */
                              $tn = $trans[] = $a['transaction_number'];
                             
                              $subtotal=new stdClass;
                              $subtotal->qty=0;
                              $subtotal->cost=0;
                        }
                        /* Check if the date is in it's array - if not, add it */
                        if( !in_array( $a['date'], $dates ) ) {
                              /* assign `$dt` var to newly discovered date and add to array */
                              $dt = $dates[] = $a['date'];
                        }
                        //echo "<script>console.log('".$tn."')</script>";
                        /* update subtotals */
                        $subtotal->qty += floatval( $a['quantity'] );
                        $subtotal->cost += floatval( $a['cost'] );


                        /* output the table row with data including vars defined above */
                        printf('
                        <tr>
                              <td>%s</td>
                              <td>%s</td>
                              <td>%s</td>
                              <td>%s</td>
                              <td>%s</td>
                              <td>%s</td>
                              <td>%s</td>
                        </tr>', $tn, $dt, $a['item_number'], $a['desc'], $a['variant_code'], $a['quantity'], $a['cost'] );


                        /* Show the sub-total for current transaction number */
                        if( ( $index < count( $data ) - 1 && $trans[ count( $trans )-1 ] != $data[ $index + 1 ]['transaction_number'] ) or $index==count( $data )-1 ){
                           echo "<script>console.log('".$index."')</script>";
                           printf('
                              <tr>
                                 <td colspan=4>&nbsp;</td>
                                 <td>SUB-TOTAL</td>
                                 <td>%s</td>
                                 <td class="currency">%s</td>
                              </tr>', $subtotal->qty, $subtotal->cost );

                              $total->qty += floatval( $subtotal->qty );
                              $total->cost += floatval( $subtotal->cost );
                        }
                     }

                     /* Show the final totals */
                     printf('
                     <tr><td colspan=7>&nbsp;</td></tr>
                     <tr>
                        <td colspan=4>&nbsp;</td>
                        <td>TOTAL</td>
                        <td>%s</td>
                        <td class="currency">%s</td>
                     </tr>', $total->qty, $total->cost );

                  ?>
            </table>
               </div>
            </div>

         </div>
         <div class="col-md-1"></div>
      </div>
   </div>
</body>
</html>