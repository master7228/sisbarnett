<?php 
session_start();
if($_SESSION["profile"]=='1'){
include_once '../classes/Product.php';
include_once '../classes/Inventory.php';
include_once '../classes/LogInventory.php';

			$view_log = 0;
		
			if(!empty ($_POST['select']) and $_POST['select'] == "*"){
				$_POST['word'] = "*";
			 }
			if(!empty($_POST['select']) && !empty($_POST['word'])){				
				$log= new LogInventory('','','','','','','');
				$resp=$log->FindLogInventory($_POST['select'],$_POST['word']);
				$_SESSION['logs'] = serialize($resp);
				$view_log = 1;
			}
			
			if(!empty($_POST['action']) and $_POST['action']=='back'){
				unset($_SESSION['log']);
				unset($_SESSION['logs']);
				echo '<script>window.location="../fondo_presentacion.php";</script>';
			}
		
		?>
		
		
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Consultar Registro Inventario</title>
		<link href="../css/estilos.css" type="text/css" rel="stylesheet">
		<script language="javascript" src="../js/validaciones.js" type="text/javascript"></script>
		</head>
		
<body>
		<form action="" method="post" name="form1" id="form1" target="basefrm" enctype="multipart/form-data"  >
		<table width="228" height="62" border="0">
		  <tr>
			<td width="30" height="50"><a href="javascript:valproduct('back')"><img src="../img/flecha.png" width="30" height="30" title="Regresar" /></a></td>
			<td width="30"><img src="../img/guardar_opaco.png" alt="Guardar" width="30" height="30" title="Guardar"  /></a></td>
			<td width="30"><img src="../img/activar_opaco.png" alt="Activar" width="30" height="30" title="Activar" /></td>
			<td width="30"><img src="../img/desactivar_opaco.png" alt="Desactivar" width="30" height="30" title="Desactivar" /></td>
			<td width="245"><a href="FindRecordInventory.php"><img src="../img/buscar_lupa.png" alt="Buscar" width="30" height="30" title="Buscar"  /></a></td>
		  </tr>
		</table>
		<?php if($view_log == 0){?>
		<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
			  <tr>
				<td width="819" height="132" align="center" valign="top">
				<table width="491" border="0" align="center" cellpadding="2" cellspacing="0" class="tablaformulario" >
				  <tr align="center">
					<td colspan="4" valign="middle">&nbsp;</td>
				  </tr>
				  <tr align="center" class="colorbarratitulos">
					<td colspan="4" valign="middle" class="tamcolorletratitulos">CONSULTAR REGISTRO INVENTARIO</td>
				  </tr>
				  <tr>
					<td align="left" valign="middle">&nbsp;</td>
					<td colspan="2" align="center">&nbsp;</td>
					<td width="239" align="center">&nbsp;</td>
				  </tr>
				  <tr>
					<td width="23" align="left" valign="middle">&nbsp;</td>
					<td colspan="2" align="left" class="tamcolorletraformulario">Criterio de Busqueda</td>
					<td align="left" class="tamcolorletraformulario">*		<select name="select" id="select" style="height: 20px; width: 150px;" onchange="valcampobusqueda(this.value,'');">
                                <option value="txtCod">Codigo Producto</option>
								<option value="txtDescription">Descripcion Producto</option>
								<option value="tmpDate">Fecha</option>
							  </select>
					  <input name="action" type="hidden" id="action" /></td>
				  </tr>
				  <tr>
					<td align="right" valign="middle">&nbsp;</td>

					<td colspan="2" align="left" class="tamcolorletraformulario">Informacion a Buscar</td>
					<td align="left" class="tamcolorletraformulario">*	<input name="word" type="text" id="word" size="30" maxlength="50" class="campos_mayus" title="Ingresa el filtro de busqueda"/></td>
				  </tr>
					<tr>
							<td height="58" colspan="4" align="center"><a href="javascript:valcampobusqueda('1','buscar')"><img src="../img/boton_buscar.png" width="80" height="30" /></a></td>
					</tr>
				  <tr>
					<td align="center" valign="middle">&nbsp;</td>
					<td width="30" align="left">&nbsp;</td>
					<td width="113" align="left">&nbsp;</td>
					<td align="left">&nbsp;</td>
				  </tr>
				  </table></td>
			  </tr>
		  </table>
		
		<?php }else{
					if(sizeof($resp)!=0){
			?>
			<table width="900" border="1" align="center" cellpadding="0" cellspacing="0" class="tablaformulario">
								  <tr class="colorbarratitulos">
									<td colspan="6" align="center" class="tamcolorletratitulos">REGISTROS ENCONTRADOS</td>
								  </tr>
								  <tr>
									<td width="71" align="center">
										<input name="action" type="hidden" id="action"/>
										<input name="id" type="hidden" id="id"/>
										<input name="view" type="hidden" id="view"/>
									</td>
									<td width="225">&nbsp;</td>
									<td width="81" align="center" valign="middle">&nbsp;</td>
									<td width="196" align="center" valign="middle">&nbsp;</td>
									<td width="74" align="center" valign="middle">&nbsp;</td>
                                    <td width="125" align="center" valign="middle">&nbsp;</td>
								  </tr>
								  <tr class="colorbarratitulos">
									<td width="71" align="center" class="tamcolorletratitulostablaresul">Doc Usuario</td>
									<td width="225" align="center" class="tamcolorletratitulostablaresul">Nombre Usuario</td>
                                    <td width="81" align="center" class="tamcolorletratitulostablaresul">Cod. Prod.</td>
									<td width="196" align="center" class="tamcolorletratitulostablaresul">Descrip. Producto</td>
									<td width="74" align="center" class="tamcolorletratitulostablaresul">Cant.Mod.</td>
                                    <td width="125" align="center" class="tamcolorletratitulostablaresul">Fecha</td>
								  </tr>
								  <?php
									for ($i=0; $i<count($resp); $i++){
										$logInv = $resp[$i];
									?>
									<tr align="left" class="TablaUsuarios">
										<td width="71"><?php echo $logInv->txtDocumentUser; ?></td>
										<td width="225"><?php echo $logInv->txtNameUser; ?></td>
                                        <td width="81"><?php echo $logInv->txtCodProduct; ?></td>
                                        <td width="196"><?php echo $logInv->txtDescriptionProduct; ?></td>
                                        <td width="74"><?php echo $logInv->intQuantity; ?></td>
                                        <td width="125"><?php echo $logInv->tmpDate; ?></td>
                                        
                                  </tr>
								<?php } ?>
		  </table>
					  <?php
								}else{
									$view_log = 0;
									echo "<script>alert ('No se encontro informacion, verifica por favor!');</script>";
									echo "<script> window.location.href='FindRecordInventory.php';</script>";
								}
							}
								?>
		</form>
</body>
		</html>


 		<?php 
			}else{
				echo "<script>alert ('Este usuario no tiene autorizacion para ingresar a este modulo!');</script>";
				echo '<script>window.location="../fondo_presentacion.php";</script>';
			}
		?>