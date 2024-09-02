<?php
//KONEKSI KE MYSQLi
$host="localhost";
$user="root";
$pass="";
$database="a_hoops";
$conn=mysqli_connect($host,$user,$pass,$database);
if(!$conn){
echo "KONEKSI GAGAL!!";
}else {
//echo "KONEKSI BERHASIL";//Komen jika koneksi sudah berhasil
}
?>