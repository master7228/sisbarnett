<?PHP
session_start();
include_once '../clases/Regional.php';
$regional= new Regional('','','');
$resp=$regional->buscarRegional('*','');
$excel = '<table>
			<tr>
				<td align="center"><strong>CODIGO</strong></td>
				<td align="center"><strong>NOMBRE</strong></td>
				<td align="center"><strong>ESTADO</strong></td>
			</tr>';
			for ($i=0; $i<count($resp); $i++){
				$reg = $resp[$i];
				if($reg->estado==1){
					$estado="ACTIVO";
				}else{
					$estado="INACTIVO";
				}
				$excel .= '<tr>
							<td align="center">'.$reg->codigo.'</td>
							<td align="left">'.$reg->nombre.'</td>
							<td>'.$estado.'</td>
						  </tr>';
			} 
$excel .= '</table>';
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Regionales.xls");
header("Pragma: no-cache");
header("Expires: 0");
print $excel;
exit;
?>