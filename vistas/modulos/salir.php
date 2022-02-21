<?php
	$tabla  = 'sys_sesiones';
	$condiciones = "sesiones_token_v = '".$_SESSION['token']."'";
	$borra_sesiones = ModeloDAO::mdlBorrar($tabla, $condiciones);
	session_destroy();
?>
<script type="text/javascript">
	clearInterval(controlsession);
	window.location = "ingreso";
</script>';