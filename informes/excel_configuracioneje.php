<?PHP
session_start();
include_once '../clases/ConfiguracionEje.php';
$resp= unserialize($_SESSION['configuraciones']);
$excel = '<table border="1">
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$configuraciones = $resp[$i];
				if($configuraciones->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$configuraciones->codigo.'</td>
							<td align="left">'.$configuraciones->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Configuracion Ejes.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>