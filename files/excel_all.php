<?PHP //exportación a excel
if(session_status()==PHP_SESSION_NONE){session_start();}
extract($_REQUEST);


header("Content-Type:application/vnd.ms-excel; charset=utf-8;");
header("Content-Disposition: atachment; filename=".preg_replace('/[\,\|]/','-',$tId).'_'.str_replace('|','-',$$tId).'_'.$_SESSION['la']['usuarios']['usuarios_nick'].'_'.date('dmY').".xls");
if(!function_exists('include_if_exists')){include('../system/functions.php');};$nivMin=3;
include('../system/verif_user.php');
   //                                         print_pre($_REQUEST);
$name='excel';
$$name=new DataBase;
$$name->tabla=$name.$view;
$$name->columns="$columns";
$$name->order="$orden";
$$name->where="$tId regexp '^(".$$tId.")$'";
$$name->_query('SELECT');
		//												echo $$name->q_query;
$row=$$name->q_fetch_assoc;
$nmr=0;$th='';$td='';
function formato($campo,$etq){
	$f=array(//voucher,invoice,cliente,`orderNo`,autor,titulo,editorial,cantidad,`precioUnit`,total
		'th'=>array(
			'voucher'=>"class=3Dxl656275 style=3D'border-left:none'",
			'invoice'=>"class=3Dxl656275 style=3D'border-left:none'",
			'fecha'=>"class=3Dxl656275 style=3D'border-left:none'",
			'orderNo'=>"class=3Dxl656275 style=3D'border-left:none'",
			'cantidad'=>"class=3Dxl656275 style=3D'border-left:none'",
			'precioUnit'=>"class=3Dxl656275 style=3D'border-left:none'",
			'total'=>"class=3Dxl656275 style=3D'border-left:none'",
			'cliente'=>"class=3Dxl656275 style=3D'border-left:none'",
			'catalogo'=>"class=3Dxl656275",
			'cliente'=>"class=3Dxl656275 style=3D'border-left:none'",
			'mail'=>"class=3Dxl656275 style=3D'border-left:none'",
			'web'=>"class=3Dxl656275 style=3D'border-left:none'",
			'nombres'=>"class=3Dxl656275 style=3D'border-left:none'",
			'apellidos'=>"class=3Dxl656275 style=3D'border-left:none'",
			'empresa'=>"class=3Dxl656275 style=3D'border-left:none'",
			'dirInvoice'=>"class=3Dxl656275 style=3D'border-left:none'",
			'telefono'=>"class=3Dxl656275 style=3D'border-left:none'",
			'direccion'=>"class=3Dxl656275 style=3D'border-left:none'",
			'pais'=>"class=3Dxl656275 style=3D'border-left:none'",
			'codigo'=>"class=3Dxl656275 style=3D'border-left:none;height:53.25pt'",
			'autor'=>"class=3Dxl656275 style=3D'border-left:none'",
			'titulo'=>"class=3Dxl656275 style=3D'border-left:none'",
			'editor'=>"class=3Dxl656275 style=3D'border-left:none'",
			'editorial'=>"class=3Dxl656275 style=3D'border-left:none'",
			'coleccion'=>"class=3Dxl656275 style=3D'border-left:none'",
			'ciudad'=>"class=3Dxl656275 style=3D'border-left:none'",
			'paginas'=>"class=3Dxl656275 style=3D'border-left:none'",
			'fecha'=>"class=3Dxl656275 style=3D'border-left:none'",
			'ISBN'=>"class=3Dxl656275 style=3D'border-left:none'",
			'p_compra'=>"class=3Dxl656275 style=3D'border-left:none'",
			'p_venta'=>"class=3Dxl656275 style=3D'border-left:none'"),
		'td'=>array(
			'voucher'=>"class=3Dxl666275 style=3D'border-left:none'",
			'invoice'=>"class=3Dxl666275 style=3D'border-left:none'",
			'fecha'=>"class=3Dxl686275 style=3D'border-left:none'",
			'orderNo'=>"class=3Dxl666275 style=3D'border-left:none'",
			'cantidad'=>"class=3Dxl676275 style=3D'border-left:none'",
			'precioUnit'=>"class=3Dxl676275 style=3D'border-left:none'",
			'total'=>"class=3Dxl676275 style=3D'border-left:none'",
			'cliente'=>"class=3Dxl666275 style=3D'border-left:none'",
			'catalogo'=>"class=3Dxl666275 style=3D'border-top:none'",
			'cliente'=>"class=3Dxl666275 style=3D'border-left:none'",
			'mail'=>"class=3Dxl666275 style=3D'border-left:none'",
			'web'=>"class=3Dxl666275 style=3D'border-left:none'",
			'nombres'=>"class=3Dxl666275 style=3D'border-left:none'",
			'apellidos'=>"class=3Dxl666275 style=3D'border-left:none'",
			'empresa'=>"class=3Dxl666275 style=3D'border-left:none'",
			'dirInvoice'=>"class=3Dxl666275 style=3D'border-left:none'",
			'telefono'=>"class=3Dxl666275 style=3D'border-left:none'",
			'direccion'=>"class=3Dxl666275 style=3D'border-left:none'",
			'pais'=>"class=3Dxl666275 style=3D'border-left:none'",
			'codigo'=>"class=3Dxl666275 style=3D'border-left:none'",
			'autor'=>"class=3Dxl666275 style=3D'border-left:none'",
			'titulo'=>"class=3Dxl666275 style=3D'border-left:none'",
			'editor'=>"class=3Dxl666275 style=3D'border-left:none'",
			'editorial'=>"class=3Dxl666275 style=3D'border-left:none'",
			'coleccion'=>"class=3Dxl666275 style=3D'border-left:none'",
			'ciudad'=>"class=3Dxl666275 style=3D'border-left:none'",
			'paginas'=>"class=3Dxl666275 style=3D'border-left:none'",
			'fecha'=>"class=3Dxl666275 style=3D'border-left:none'",
			'ISBN'=>"class=3Dxl666275 style=3D'border-left:none'",
			'p_compra'=>"class=3Dxl666275 style=3D'border-left:none'",
			'p_venta'=>"class=3Dxl666275 style=3D'border-left:none'")
	);
	return $f[$etq][$campo];
}
do{
	$td.='<tr>';
	foreach($row as $i=>$v){
		if($nmr==0){$th.="<td ".formato($i,'th').">$i</td>";}
		$td.="<td ".formato($i,'td').">".($i=="fecha"?"'".$v:$v)."</td>";
	}
	$td.='</tr>';
	$nmr++;
}while($row=mysqli_fetch_assoc($$name->q_src));
?>
//**
MIME-Version: 1.0
X-Document-Type: Worksheet
Content-Location: file:///C:/36FA5EC5/xls4se.htm
Content-Transfer-Encoding: quoted-printable
Content-Type: text/html; charset="utf-8"

<html xmlns:o=3D"urn:schemas-microsoft-com:office:office"
xmlns:x=3D"urn:schemas-microsoft-com:office:excel"
xmlns=3D"http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=3DContent-Type content=3D"text/html; charset=3Dutf-8">
<meta name=3DProgId content=3DExcel.Sheet>
<meta name=3DGenerator content=3D"Microsoft Excel 15">
<link rel=3DFile-List href=3D"xls4se_archivos/filelist.xml">
<style id=3D"C47_sadmin_11092017_6275_Styles">
<!--table
	{mso-displayed-decimal-separator:"\.";
	mso-displayed-thousand-separator:"\,";}
.xl656275
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:700;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:center;
	vertical-align:middle;
	border:.5pt solid black;
    background:yellow;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;
	mso-rotate:45;
	}
.xl666275
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:top;
	border:.5pt solid black;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl676275
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:Fixed;
	text-align:general;
	vertical-align:bottom;
	border:.5pt solid black;
	mso-background-source:auto;
	mso-pattern:auto;
	white-space:normal;}
.xl686275
	{padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:black;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	text-align:general;
	vertical-align:top;
	border:.5pt solid black;
	mso-background-source:auto;
	mso-pattern:auto;
	font-size:11.0pt;
	mso-number-format:"Short Date";
	white-space:normal;}
-->
</style>
</head>
<body>
<!--[if !excel]>&nbsp;&nbsp;<![endif]-->
<!--La siguiente información se generó mediante el Asistente para publicar como página web de Microsoft Excel.-->
<!--Si se vuelve a publicar el mismo elemento desde Excel, se reemplazará toda la información comprendida entre las etiquetas DIV.-->
<!----------------------------->
<!--INICIO DE LOS RESULTADOS DEL ASISTENTE PARA PUBLICAR COMO PÁGINA WEB DE EXCEL -->
<!----------------------------->

<div id=3D"C47_sadmin_11092017_6275" align=3Dcenter x:publishsource=3D"Excel">

<table border=3D0 cellpadding=3D0 cellspacing=3D0 width=3D1581 style=3D'border-collapse:collapse;table-layout:fixed;width:1186pt'>
<tr>
<?PHP echo $th;?>
</tr>
<?PHP echo $td;?>
</table>
</div>
<!----------------------------->
<!--FINAL DE LOS RESULTADOS DEL ASISTENTE PARA PUBLICAR COMO PÁGINA WEB DE EXCEL-->
<!----------------------------->
</body>
*//
