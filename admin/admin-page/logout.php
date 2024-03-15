<?php
session_start(); // Pastikan panggilan session_start() ada di awal file

// Hancurkan semua data session
session_destroy();

// Redirect ke halaman login atau halaman awal
header("Location: ../index.php"); // Sesuaikan dengan halaman yang diinginkan
exit();
?>
