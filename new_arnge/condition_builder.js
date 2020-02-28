$(document).ready(function(){
   var row_count = 1;


 
   $(document).on('click', '.btn_remove', function() { // เมื่อคลิกปุ่ม remove
      $(this).closest('tr').remove(); // ลบรายการที่เลือก (tr)
   });

   $("#add_condition").click(function(){
      let html = '';
      
      if(row_count == 1){
         html+= '<tr  row_id="'+row_count+'" >';
         html+= '<td><input class="btn btn-danger btn_remove btn-sm" type="button" value="X" name="btn_submit[]"></td>';
         html+= '<td> <input type="text" readonly value="" class="form-control condition_conjuction_type" name="condition_conjuction_type[]"></td>';
         html+= '<td><select class="form-control select_fields" name="select_fields[]"><option value="field1">field1</option><option value="field2">field2</option><option value="field3">field3</option><option value="field4">field4</option></select></td>';
         html+= '<td><select class="form-control operator_select_box" name="operator_select_box[]" ><option value="=">เท่ากับ</option><option value=">">มากกว่า</option><option value="<">น้อยกว่า</option><option value=">=">มากกว่าหรือเท่ากับ</option><option value="<=">น้อยกว่าหรือเท่ากับ</option></select></td>';
         html+= '<td><select class="form-control condition_value_type" name="condition_value_type[]" ><option value="null_value">เลือกประเภทค่า</option><option value="con_value">ค่า</option><option value="con_field_value">ฟีลด์</option></select></td>';
         html+= '</tr>';
      }
      else{
         html+= '<tr  row_id="'+row_count+'" >';
         html+= '<td><input class="btn btn-danger btn_remove btn-sm" type="button" value="X" name="btn_submit[]"></td>';
         html+= '<td><select name="condition_conjuction_type[]" class="form-control condition_conjuction_type"><option value="and">AND</option><option value="or">OR</option></select></td>';
         html+= '<td><select class="form-control select_fields" name="select_fields[]"><option value="field1">field1</option><option value="field2">field2</option><option value="field3">field3</option><option value="field4">field4</option></select></td>';
         html+= '<td><select class="form-control operator_select_box" name="operator_select_box[]" ><option value="=">เท่ากับ</option><option value=">">มากกว่า</option><option value="<">น้อยกว่า</option><option value=">=">มากกว่าหรือเท่ากับ</option><option value="<=">น้อยกว่าหรือเท่ากับ</option></select></td>';
         html+= '<td><select class="form-control condition_value_type" name="condition_value_type[]" ><option value="null_value">เลือกประเภทค่า</option><option value="con_value">ค่า</option><option value="con_field_value">ฟีลด์</option></select></td>';
         html+= '</tr>';
      }
    

      $("#condition_body").append(html);

      row_count++;
   });

   $("#send_request").click(function(){

      $.ajax({
         url: "get_condition_form.php",
         method: "POST",
         async: false,
         /*dataType: "JSON", // response variable type*/
         data: $('#form_condition').serialize(), // get form data
         error: function(jqXHR, text, error) {
            alert(error)
         }
     })
      .done(function(data) { // response
         console.log(data)
         $('.result').html(data)
      });
   });
});