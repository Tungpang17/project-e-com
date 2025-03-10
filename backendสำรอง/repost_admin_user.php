 <?php
include("head.php");
?>
<br>
<br>
<br>
<br>

<div class="container">

	<h3><img src="img/ru1.png" width="50" height="50">ร้านค้าวิสาหกิจชุมชนบ้านพวนผ้ามัดหมี่</h3>
  <h3>รายงานสิทธิ์การเข้าใช้งาน  <button type="button" class="btn btn-light" onclick="print();" id="hid"> 

    
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
  <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"/>
  <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
  </svg> พิมพ์</button></h3>
  <br>
 <table id="example" class="table"  class="table table-striped table-bordered" style="width:100%">
  <thead>
    <tr>
     
      <th scope="col">รหัสพนักงาน</th>
      <th scope="col">username</th>
      <th scope="col">password</th>
      <th scope="col">ชื่อพนักงาน</th>
      <th scope="col">สิทธิ์</th>
    </tr>
  </thead>
  <tbody id="tbody1">
    
  </tbody> 
</table>

 </div>

 <script>
function show_tbody1(){

      

       $.post("call_user.php",{
     
    },function(data){

 obj=JSON.parse(data);
      console.log(obj);

for(var i=0;i<obj.length; i++){


  $("#tbody1").html($("#tbody1").html()+'<tr onclick="show_click('+i+')" style="cursor:pointer"><td>'+obj[i].user_id+'</td><td>'+obj[i].username+'</td><td>'+obj[i].password+'</td><td>'+obj[i].user_name+'</td><td>'+obj[i].type_name+'</td></tr>');
}
      
      

      });


    } 
    function show_click(id){
      $("#user_id").val(obj[id].user_id);
      $("#username").val(obj[id].username);
      $("#password").val(obj[id].password);
      $("#user_name").val(obj[id].user_name);
      $("#address").val(obj[id].address);
      $("#type_name").val(obj[id].type_name);

    }  


 $(document).ready(function () {
  $('#dt-filter-select').dataTable({

    initComplete: function () {
      this.api().columns().every( function () {
          var column = this;
          var select = $('<select id="hid"  class="browser-default custom-select form-control-sm"><option value="" selected>Search</option></select>')
              .appendTo( $(column.footer()).empty() )
              .on( 'change', function () {
                  var val = $.fn.dataTable.util.escapeRegex(
                      $(this).val()
                  );

                  column
                      .search( val ? '^'+val+'$' : '', true, false )
                      .draw();
              } );

          column.data().unique().sort().each( function ( d, j ) {
              select.append( '<option value="'+d+'">'+d+'</option>' )
          } );
      } );
  }
  });
});   
       

    show_tbody1();  
</script>

<?php
include("foot.php");
?>