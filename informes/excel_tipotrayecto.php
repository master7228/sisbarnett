<?PHP
session_start();
include_once '../clases/TipoTrayecto.php';
$tipotrayecto= new TipoTrayecto('','','');
$resp=$tipotrayecto->buscarTipoTrayecto('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$tipotra = $resp[$i];
				if($tipotra->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$tipotra->codigo.'</td>
							<td align="left">'.$tipotra->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Tipos de Trayectos.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>