<?php

session_start();

// hapus semua session
session_destroy();

// redirect ke halaman index.php;
header("Location: ../index.php");