<?php
$koneksi = new mysqli("localhost", "root", "", "db_zibnet");
if ($koneksi->connect_error) {
  die("Koneksi gagal: " . $koneksi->connect_error);
}
?>
