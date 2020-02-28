<?php

   $number = '29,126,219.43';
   $sre = '03เดรื่องมือฯ กฟจ.สบ.';

   function convertToValidPrice($price) {
      $price = str_replace(['-', ',', '$', ' '], '', $price);
      if(!is_numeric($price)) {
          $price = null;
      } else {
          if(strpos($price, '.') !== false) {
              $dollarExplode = explode('.', $price);
              $dollar = $dollarExplode[0];
              $cents = $dollarExplode[1];
              if(strlen($cents) === 0) {
                  $cents = '00';
              } elseif(strlen($cents) === 1) {
                  $cents = $cents.'0';
              } elseif(strlen($cents) > 2) {
                  $cents = substr($cents, 0, 2);
              }
              $price = $dollar.'.'.$cents;
          } else {
              $cents = '00';
              $price = $price.'.'.$cents;
          }
      }
  
      return $price;
  }

  echo convertToValidPrice($sre);