$(document).ready(function(){
   
   var jsonData;
   var selected_value;
   jsonData = getDataJson($(this).val());

   
   console.clear()

   jsonData.key_object.forEach(function(element){
      $("#fields").append(" <span draggable='true' class='badge badge-primary'>"+element+"</span>");
   });

   //console.log(jsonData)

   $("#test_ajax").click(function(){
      populate_table(jsonData,"table_div");
   });

   $("#show_subtotal").click(function(){
      populate_table_sub_total(jsonData,"table_div");
      //console.log(selected_value)
   });

   // $('#fields').multiselect({

   //    nonSelectedText:'เลือกฟีลด์',
   //    buttonWidth:'50vw',
   //    enableFiltering: true,
   //    enableCaseInsensitiveFiltering: true,

   //    onChange:function(option, checked){
   //      var selected = this.$select.val();
   //      //console.log(selected);
   //      selected_value = selected;
   //    }
   // });


   function populate_table(json_data,id){

      const sd = document.getElementById(id)

      let table = "<table><thead><tr>";

      json_data.key_object.forEach(function(element){
         table+= "<th>"+element+"</th>"; 
      });

      table+="</tr></thead><tbody>";

      for(let j = 0 ; j <= json_data.new_json_data.length -1 ; j++){

         table+="<tr>";

         for(let k = 0 ; k <= json_data.key_object.length -1 ; k++){

            table+="<td>"+json_data.new_json_data[j][json_data.key_object[k]]+"</td>";

         }

         table+="</tr>";
      }

      table+="</tbody></table>";

      sd.innerHTML = table;
   }

   function populate_table_sub_total(json_data,id){

      const sd = document.getElementById(id)

      let table = "<table><thead><tr>";

      let table_obj = new Object();

      json_data.key_object.forEach(function(element){
         table+= "<th>"+element+"</th>"; 
      });

      table+="</tr></thead><tbody>";
      
      table_obj['transaction_number'] = [];
      table_obj['date'] = [];

      let total = 0.0;

      let total_qty = 0;
      
      for(let i = 0 ; i <= json_data.new_json_data.length -1 ; i++){

         table+="<tr>";

         let cost ;
         let dateeeee;

         if(!table_obj['transaction_number'].includes(json_data.new_json_data[i]['transaction_number'])){

            table_obj['sub_total_cost'] = 0;

            table_obj['sub_total_qty'] = 0;
            
            table_obj['transaction_number'].push(json_data.new_json_data[i]['transaction_number']);
            
            cost = json_data.new_json_data[i]['transaction_number'];
           // qty  = json_data.new_json_data[i]['quantity'];
         }

         if(!table_obj['date'].includes(json_data.new_json_data[i]['date'])){

            table_obj['date'].push(json_data.new_json_data[i]['date']);
            
            dateeeee = json_data.new_json_data[i]['date'];
           // qty  = json_data.new_json_data[i]['quantity'];
         }

         table_obj['sub_total_cost']+= json_data.new_json_data[i]['cost']
         table_obj['sub_total_qty']+= json_data.new_json_data[i]['quantity']
        //console.log(codeee)

         let real_cost = cost === undefined ? " " : cost;
         let real_date = dateeeee === undefined ? " " : dateeeee;

         table+="<td>"+json_data.new_json_data[i]['primary_key']+"</td>";
         table+="<td>"+real_cost+"</td>";
         table+="<td>"+real_date+"</td>";
         table+="<td>"+json_data.new_json_data[i]['item_number']+"</td>";
         table+="<td>"+json_data.new_json_data[i]['descc']+"</td>";
         table+="<td>"+json_data.new_json_data[i]['variant_code']+"</td>";
         table+="<td>"+json_data.new_json_data[i]['quantity']+"</td>";
         table+="<td>"+json_data.new_json_data[i]['cost']+"</td>";
         
         table+="</tr>";

         if((i < json_data.new_json_data.length -1 && table_obj['transaction_number'][table_obj['transaction_number'].length -1] != json_data.new_json_data[i+1]['transaction_number']) || i == json_data.new_json_data.length -1){
            
            total+= table_obj['sub_total_cost']; 
            total_qty+=table_obj['sub_total_qty']; 

            table+="<tr>";

            table+="<td colspan=5>&nbsp;</td>";
            table+="<td>Sub total</td>";
            table+="<td>"+table_obj['sub_total_qty']+"</td>"; 
            table+="<td>฿"+table_obj['sub_total_cost']+"</td>";

            table+="</tr>";
         }
         
      }

      table+="<tr>";

      table+="<td align='center' colspan=6>Grand total</td>";
      table+="<td>"+total_qty+"</td>";
      table+="<td>฿"+total+"</td>";
      
      table+="</tr>";

      table+="</tbody></table>";

      sd.innerHTML = table;
   }

   function getDataJson(table_name){

      var my_obj = new Object(); // ประกาศอ็อคเจ็คว่าง

      var json_obect = [];

      $.ajax({ 
         "url": 'php_test_custom_json.php',
         method:"POST",
          //data: {action: 'getEMP', tb_name:$(this).val() },
         "dataType": "json",
         async:false,
      }).done(function(json){

         var jsonn = json; // เก็บค่า json

         json_obect.json_data = jsonn; // real data

         var obj_keys = Object.keys(jsonn); // เก็บ key ของอ็อปเจ็ค

         json_obect.key_object = obj_keys;

         var new_json_data = []; // new data

         for(var j = 0 ; j <= jsonn[obj_keys[0]].length-1 ; j++){

            var json_row =  new Object();

            for(var k = 0 ; k <= obj_keys.length-1 ; k++){

               json_row[obj_keys[k]] = jsonn[obj_keys[k]][j]

            }

            new_json_data.push(json_row);

         }

         json_obect.new_json_data = new_json_data;

         for(var i = 0 ; i <= obj_keys.length-1 ; i++){ // วนลูปตามคีย์

            my_obj[obj_keys[i]] = []; // ประกาศ property ของอ็อบเจ็ค เป็น array

            jsonn[obj_keys[i]].forEach(function(element){ // วนลูป array ของแต่ละคีย์

               if(!my_obj[obj_keys[i]].includes(element)){ // ตรวจสอบถ้าค่าในคีย์นั้นซ้ำ (มีอยู่แล้ว)

                  my_obj[obj_keys[i]].push(element) // เพิ่มค่าลง array ของแต่ละคีย์ (แต่ละ property ใน obj)

               }
            })
         }

         json_obect.clear_value = my_obj;

      });

      return json_obect;
   }
});