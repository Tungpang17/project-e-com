<html>

<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css" >
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet'
        type='text/css'>
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script></head>
    <div class="widget-wrapper wow fadeIn" data-wow-delay="0.4s">
        <h4>เข้าสู่ระบบ :</h4>
        <br>
        <form id="form1">
            <div class="form-group">
                <label for="exampleInputEmail1">E-mail</label>
                <input type="email" class="form-control" id="user" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="pass">
            </div>
            <button type="submit" class="btn btn-primary" id="bt_login">เข้าสู่ระบบ</button>
            <a href="register.php"><button type="button" class="btn btn-secondary">สมัครสมาชิก</button></a>
        </form>
    </div>
    <script>
        $(function () {

            // เมื่อฟอร์มการเรียกใช้ evnet submit ข้อมูล        
            $("#form1").on("submit", function (e) {
                e.preventDefault(); // ปิดการใช้งาน submit ปกติ เพื่อใช้งานผ่าน ajax

                // เตรียมข้อมูล form สำหรับส่ง
                var formData = $(this).serialize();
                register();

            });})
            function register(){
            
            document.getElementById("bt_login").innerHTML='Wait a minute! <i class="fa fa-spinner fa-spin fa-fw" aria-hidden="true" style="color:#fff"></i>';
            document.getElementById("bt_login").disabled=true;
            
        $.post("call_login.php", {
            user:$("#user").val(),
            pass:$("#pass").val()  
        }, function(data){

            try{
                var obj = JSON.parse(data);
                if(obj.status==0){
                    Swal.fire({
                    title: 'Username หรือ Password ไม่ถูกต้อง',
                    text: 'โปรดลองใหม่อีกครั้ง',
                    icon: 'warning',
                    confirmButtonText: 'เข้าใจแล้ว'
                    }).then((result) => {
                    if (result.value) {
                        $("#user").val()='';
                        $("#pass").val()='';
                    }
                    })
                }else if(obj.status==1){
                        location.href='index.php';
                }
            }catch(err){
                Swal.fire(
                    'เกิดข้อผิดพลาดไม่ทราบสาเหตุ',
                    'โปรดลองใหม่อีกครั้ง'+err+data,
                    'error'
                    )
            }
                document.getElementById("bt_login").disabled=false;
                document.getElementById("bt_login").innerHTML="Login";

                });
        }
    </script>

</html>