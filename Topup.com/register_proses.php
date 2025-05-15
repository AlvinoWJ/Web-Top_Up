<?php 
require 'function.php';

if( isset($_POST["registrasi"]) ){
  
    if( register_akun($_POST) > 0 ){
        echo "<script>
            alert('berhasil registrasi!')
        </script>";
        echo "<script>
            document.location.href = 'login.php';
        </script>";
    }

    else{
        mysqli_error($database);
    }

}

?>