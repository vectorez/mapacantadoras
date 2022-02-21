	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="vistas/dist/css/login/login.util.css">
	<link rel="stylesheet" type="text/css" href="vistas/dist/css/login/login.main.css">

<!--===============================================================================================-->
	<div class="loader" id="loader"></div>
	<style type="text/css">
		.loader {
		    position: fixed;
		    left: 0px;
		    top: 0px;
		    width: 100%;
		    height: 100%;
		    z-index: 9999;
		    background: url('vistas/img/general/spinner.gif') 50% 50% no-repeat rgb(255,255,255);
		}
	</style>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form method="post" class="login100-form validate-form" style="padding-top: 40px;">
					<span class="login100-form-title p-b-43" style="padding-bottom: 40px;">
						<a class="login-logo" href="../es" >
							<?php 
								if (date("m")==12) {
									echo '<img src="vistas/img/plantilla/Nlogov2.png" width="200">';
								}else{
									echo '<img src="vistas/img/plantilla/logov2.png" width="200">';
								}
							 ?>
				        </a>
					</span>
					
					
					<div class="wrap-input100 validate-input" data-validate = "Valida el email, ej: ex@abc.xyz">
						<input class="input100" type="email" name="ingUsuario" id="ingUsuario">
						<span class="focus-input100"></span>
						<span class="label-input100">Email</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="La contraseña es requerida">
						<input class="input100" type="password" name="ingPassword" id="ingPassword">
						<span class="focus-input100"></span>
						<span class="label-input100">Contraseña</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">

						</div>
						<div>
							<a style="cursor:pointer;" class="txt1" data-toggle="modal" data-target="#modalRestablecerContrasena">
								Olvidé mi contraseña
							</a>
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Entrar
						</button>
					</div>
					<div class="row">
		                <div class="col-xs-12" id="respuestaLogin">
		                    <?php 
		                        $login = new ControladorUsuarios();
		                        $login->ctrIngresoUsuario();
		                    ?>
		                </div>
		            </div>
					
				</form>
				
				<div class="login100-more" style="background-image: url('<?php echo 'vistas/img/general/login/'.rand(1, 37).'-min.jpg'; ?>')">
				</div>
			</div>
		</div>
	</div>
	<!-- Modal agregar proveedor -->
<div id="modalRestablecerContrasena" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <form id="enviarRecuperacion" role="form" method="post" enctype="multipart/form-data">
                <div class="modal-header" >
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Restaurar contraseña</h4>
                </div>
                <div class="modal-body">
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="form-group" id="contenedorEmailRecuperacion">
                                <label>Email</label>
                                <input autocomplete="off" class="form-control input" type="email" id="EmailRecuperacion" name="EmailRecuperacion" placeholder="Ingresa tu Email" required="true">
                            </div> 
                            <div style="display: none;" id="contenedorRecuperacion">
	                            <p class="text-red">Se envió un Pin a tu email, vence en 3 mínutos.</p>
	                            <div class="form-group" >
	                                <label>Ingresa el Pin aquí</label>
	                                <input autocomplete="off" class="form-control input" type="number" id="PinRecuperacion" name="PinRecuperacion" placeholder="Ingresa el Pin aquí" required="true">
	                            </div> 
	                            <div class="form-group">
	                                <label>Nueva contraseña</label>
	                                <input autocomplete="off" class="form-control input" type="password" id="ContrasenaRecuperacion" name="ContrasenaRecuperacion" placeholder="Ingresa la nueva contraseña" required="true">
	                            </div> 
	                            <div class="form-group">
	                                <label>Confirma la nueva contraseña</label>
	                                <input autocomplete="off" class="form-control input" type="password" id="CContrasenaRecuperacion"name="CContrasenaRecuperacion" placeholder="Confirma la nueva contraseña" required="true">
	                            </div> 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                	<input type="hidden" name="idUsuarioRecuperacion" id="idUsuarioRecuperacion">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <a class="btn btn-success" id="validaEmailRecuperacion">Validar</a>
                    <a id="btnEnviarRecuperacion" class="btn btn-success" style="display: none;">Restaurar contraseña</a>
                </div>
                <?php
                    $crearPerfil = new ControladorUsuarios();
                    $crearPerfil->crtRestauracionContrasena();
                ?>
            </form>
        </div>
    </div>
</div>
<script src="vistas/js/login.js"></script>