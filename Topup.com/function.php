<?php 

$database = mysqli_connect("localhost", "root", "", "topup");

function ambilData($data){

    global $database;
    $hasil = mysqli_query($database,$data);
    $penammpung = [];

    while ( $perData = mysqli_fetch_assoc($hasil) ){

        $penammpung[] = $perData;

    }
     return $penammpung;

}

function register_akun($data){
    global $database;
        $username = strtolower(stripcslashes($data["username"]));
        $nama = $data['nama'];
        $email = $data['email'];
        $password = mysqli_real_escape_string($database,$data["password"]);
        $password2 = mysqli_real_escape_string($database,$data["password2"]);
        $no_telp = $data['no_telp'];

        // cek apakaah ada username yang sama
        $result = mysqli_query($database, "SELECT username FROM users WHERE username = '$username'");

        if ( mysqli_fetch_assoc($result) ){
            echo "username yang anda ketikkan telah terdaftar!";
            return false;
        }

        // cek apakah password dan konfirmasi sama atau tidak

        if( $password !== $password2 ){

            echo "salah blok";
            return false;
        }

        // enkripsi password
        $password = password_hash($password, PASSWORD_DEFAULT);
        // masukkan data ke database
        mysqli_query($database,"INSERT INTO users VALUES('','$username', '$nama', '$email', '$no_telp','$password', '2')
        ");

        return mysqli_affected_rows($database);

}

?>