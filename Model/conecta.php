<?php
$db = mysqli_connect("localhost", "root", "", "dbreidasbebidas") or die("Servidor Fora do ar.");
mysqli_select_db($db, "dbreidasbebidas") or die("Banco fora do ar.");

