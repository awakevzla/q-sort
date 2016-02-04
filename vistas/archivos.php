<?php
$dir="../recursos/";
$direccion=$dir.basename($_FILES["archivo"]["name"]);
move_uploaded_file($_FILES["archivo"]["tmp_name"], $direccion);
chmod($direccion, 0777);