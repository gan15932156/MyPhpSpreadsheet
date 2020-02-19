<?php

   $post_data =  json_encode($_POST['data'],JSON_UNESCAPED_UNICODE);

   $parse_object_data = json_decode($post_data);

   echo "<pre>";
   var_dump($parse_object_data);
   echo "</pre>";