<?PHP
header("Content-Type: application/Word; charset=utf-8;");
header("Content-Disposition: inline; filename=$_REQUEST[cat].doc;");
if(is_dir('system')){$ruta='';}else{if(is_dir('../system')){$ruta='../';}else{if(is_dir('../../system')){$ruta='../../';}}}
if(!isset($_SESSION))session_start();
include($ruta.'system/functions.php');$nivMin=0;
include($ruta.'system/verif_user.php');
extract($_REQUEST);
?>
MIME-Version: 1.0
Content-Type: multipart/related; boundary="----=_NextPart_01D0B67C.61A11150"

Este documento es una página Web de un solo archivo, también conocido como archivo de almacenamiento Web. Si está viendo este mensaje, su explorador o editor no admite archivos de almacenamiento Web. Descargue un explorador que admita este tipo de archivos, como Microsoft Internet Explorer.

------=_NextPart_01D0B67C.61A11150
Content-Location: file:///C:/B133A691/<?PHP echo $cat;?>.htm
Content-Transfer-Encoding: quoted-printable
Content-Type: text/html; charset="utf-8"

<html xmlns:v=3D"urn:schemas-microsoft-com:vml"
xmlns:o=3D"urn:schemas-microsoft-com:office:office"
xmlns:w=3D"urn:schemas-microsoft-com:office:word"
xmlns:st1=3D"urn:schemas-microsoft-com:office:smarttags"
xmlns=3D"http://www.w3.org/TR/REC-html40">
<head>
<meta http-equiv=3DContent-Type content=3D"text/html; charset=3Dutf-8">
<link rel=3DFile-List href=3D"<?PHP echo $cat;?>_archivos/filelist.xml">
<link rel=3DEdit-Time-Data href=3D"<?PHP echo $cat;?>_archivos/editdata.mso">
<title><?PHP echo "$cat.doc"?></title>
<o:SmartTagType namespaceuri=3D"urn:schemas-microsoft-com:office:smarttags" name=3D"metricconverter"/>
<o:SmartTagType namespaceuri=3D"urn:schemas-microsoft-com:office:smarttags" name=3D"PersonName"/>
<!--[if gte mso 9]><xml><o:DocumentProperties><o:Author>Juanjito</o:Author><o:LastAuthor>Juanjito</o:LastAuthor><o:Revision>0</o:Revision><o:Created><?PHP echo date("Y-m-d\th:i:s\Z");?></o:Created><o:LastSaved><?PHP echo date("Y-m-d\th:i:s\Z");?></o:LastSaved><o:Company>Libros Andinos</o:Company></o:DocumentProperties></xml><![endif]-->
<!--[if gte mso 9]><xml><w:WordDocument><w:View>Print</w:View><w:Zoom>90</w:Zoom><w:SaveIfXMLInvalid>false</w:SaveIfXMLInvalid><w:IgnoreMixedContent>false</w:IgnoreMixedContent><w:AlwaysShowPlaceholderText>false</w:AlwaysShowPlaceholderText><w:BrowserLevel>MicrosoftInternetExplorer4</w:BrowserLevel></w:WordDocument></xml><![endif]-->
<style>
p.MsoFooter, li.MsoFooter, div.MsoFooter{margin:0cm;margin-bottom:.0001pt;mso-pagination:widow-orphan;tab-stops:center 212.6pt right 425.2pt;font-size:11.0pt;font-family:"Times New Roman";mso-fareast-font-family:"Times New Roman";}
@page Section1{size:21.59cm 27.94cm;margin:3.0cm 3.0cm 3.0cm 3.0cm;mso-header-margin:1.0cm;mso-footer-margin:1.0cm;mso-paper-source:0;}
div.Section1{page:Section1;}
@page Section2{size:21.59cm 27.94cm;margin:2.0cm <?PHP echo ($tipo=='blanket'?'1.0':'2.5')?>cm 2.0cm <?PHP echo ($tipo=='blanket'?'1.0':'2.5')?>cm;mso-header-margin:0.8cm;mso-footer-margin:0.4cm;mso-page-numbers:1;mso-columns:<?PHP echo ($tipo=='blanket'?'2':'1')?> even 0.5cm;mso-header:url("<?PHP echo $cat;?>_archivos/header.htm") h2;mso-footer:url("<?PHP echo $cat;?>_archivos/header.htm") f2;mso-paper-source:0;}
div.Section2{page:Section2;}
</style>
</head>
<body style=3D'tab-interval:35.4pt'>
<div class=3DSection1>
<p class=3DMsoNormal><!--[if gte vml 1]><v:shapetype id=3D"_x0000_t75" coordsize=3D"21600,21600"
 o:spt=3D"75" o:preferrelative=3D"t" path=3D"m@4@5l@4@11@9@11@9@5xe" filled=3D"f" stroked=3D"f">
 <v:stroke joinstyle=3D"miter"/>
 <v:formulas>
  <v:f eqn=3D"if lineDrawn pixelLineWidth 0"/>
  <v:f eqn=3D"sum @0 1 0"/>
  <v:f eqn=3D"sum 0 0 @1"/>
  <v:f eqn=3D"prod @2 1 2"/>
  <v:f eqn=3D"prod @3 21600 pixelWidth"/>
  <v:f eqn=3D"prod @3 21600 pixelHeight"/>
  <v:f eqn=3D"sum @0 0 1"/>
  <v:f eqn=3D"prod @6 1 2"/>
  <v:f eqn=3D"prod @7 21600 pixelWidth"/>
  <v:f eqn=3D"sum @8 21600 0"/>
  <v:f eqn=3D"prod @7 21600 pixelHeight"/>
  <v:f eqn=3D"sum @10 21600 0"/>
 </v:formulas>
 <v:path o:extrusionok=3D"f" gradientshapeok=3D"t" o:connecttype=3D"rect"/>
 <o:lock v:ext=3D"edit" aspectratio=3D"t"/>
</v:shapetype><v:shape id=3D"_x0000_s1026" type=3D"#_x0000_t75" alt=3D"LAT" style=3D'position:absolute;margin-left:63pt;margin-top:85.2pt;width:309.95pt;height:449.55pt;z-index:1'>
 <v:imagedata src=3D"<?PHP echo $cat;?>_archivos/LAT.png" o:title=3D"LAT"/>
</v:shape><![endif]--></p>
<br style=3D'mso-ignore:vglayout' clear=3DALL>
<div style=3D'margin-top:5.0cm'>
<p class=3DMsoNormal><!--[if gte vml 1]><v:shape id=3D"_x0000_i1025" type=3D"#_x0000_t75" alt=3D"LOGO" style=3D'width:273.75pt;height:69.75pt'>
 <v:imagedata src=3D"<?PHP echo $cat;?>_archivos/logo.png" o:title=3D""/>
</v:shape><![endif]--></p>
<div style=3D'margin-left:-3.0cm;margin-right:-3.0cm' id=3Dtitulos-bg>
<div style=3D'mso-element:para-border-div;border:solid #DED2C5 1.0pt;padding:14.0pt 31.0pt 14.0pt 31.0pt;background:#DDDDDD'>
<p style=3D'tab-stops:right 442.0pt;background:#DED2C5;border:none;mso-border-alt:solid #DED2C5 1.0pt;padding:0cm;mso-padding-alt:14.0pt 31.0pt 14.0pt 31.0pt'>
<b><span style=3D'mso-tab-count:1'></span>
<span style=3D'font-size:24.0pt;font-family:Arial;text-transform:uppercase'><?PHP echo $nombre?><br></span>
<span style=3D'mso-tab-count:1'></span>
<span style=3D'font-size:20.0pt'><?PHP echo "$periodo $gestion"?><br></span>
<span style=3D'mso-tab-count:1'></span>
<span style=3D'font-size:20.0pt'>Catalogo No. <?PHP echo $cat;?></span></b></p>
</div>
</div>
<div style=3D'margin-top:6.5cm' id=3Ddatos>
<p class=3DMsoNormal><b><span style=3D'font-family:Arial'>P.O.Box 164900<br>
Miami, Florida 33116 - U.S.A.<br>
sitio web: www.incabook.com<br>
mail: info@incabook.com | bookssur@aol.com<br></span></b></p>
</div>
</div>
</div>
<span style=3D'font-size:12.0pt;font-family:"Times New Roman";mso-fareast-font-family:"Times New Roman";mso-ansi-language:ES;mso-fareast-language:ES;mso-bidi-language:AR-SA'>
	<br clear=3Dall style=3D'page-break-before:always;mso-break-type:section-break'>
</span>
<div class=3DSection2>
	<section id=3D"workarea">
<?PHP
$campos=$materia_=$codInNew=$edt_=$ped_='';$numeracion=1;
$name='catalogo';$view='_cepal';$ped='';$cat_='';$prm='';
$row=array('id'=>'','catalogo'=>'','4'=>'','3'=>'','120'=>'','103'=>'0.00','titulo'=>'','ficha'=>'NO EXISTEN LIBROS PARA MOSTRAR','prm'=>'','orden'=>'','materia'=>'CATALOGO VACIO','orderMat'=>'','catalogo_id'=>'','cat'=>'','tipo'=>'','registros'=>'','estado'=>'','nombre'=>$cat,'periodo'=>'','gestion'=>date('Y'),'file'=>'','pais'=>'','send'=>'','text'=>'','catalogo_usuario'=>0);
if(isset($tipo)&&$tipo=='oferta'){$view=$tipo.$view;$cat_='_cat';}
if(isset($sUs_usuarios_nivel)&&$sUs_usuarios_nivel<=2){
	$ped="";
}elseif(isset($sUs_usuarios_nivel)&&$sUs_usuarios_nivel>2){
	$ped="";
}

$$name=new DataBase;
$$name->columns="* $ped";
$$name->tabla="$name$view";
$$name->where="catalogo$cat_='$cat'";
if(!isset($_SESSION['la']['usuarios']['usuarios_nivel'])||$_SESSION['la']['usuarios']['usuarios_nivel']<3){
	$$name->where.=" AND `4`regexp'[MS]'";
}
$$name->order='orderMat,prm,orden';
$$name->_query('SELECT');
			//										print_pre($$name->q_query);
if($$name->q_num_rows>0)$row=$$name->q_fetch_assoc;
extract($row,EXTR_PREFIX_ALL,'ss');
do{
	($ss_tipo=='oferta'?$row['120']=$row['grupo']:'');
	$precioVen=(isset($row['precio'])?$row['precio']:$row['103']);
if($ss_file!='none'){

	if($materia_!=$row['materia']){
		if(is_null($materia_)){
			$campos.="<p align=3Dright style=3D'margin-top:0cm;text-align:right;mso-pagination:widow-orphan lines-together;page-break-after:avoid;font-size:18.0pt;font-family:Arial'><b>".str_replace(' - ','<br />',$row['materia'])."</b><table class=3DMsoNormalTable border=3D0 cellspacing=3D0 cellpadding=3D0 style=3D'border-collapse:collapse;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>";
		}else{
			$campos.="</tbody></table><p align=3Dright style=3D'text-align:right;mso-pagination:widow-orphan lines-together;page-break-after:avoid;font-size:18.0pt;font-family:Arial'><b>".str_replace(' - ','<br />',$row['materia'])."</b><table class=3DMsoNormalTable border=3D0 cellspacing=3D0 cellpadding=3D0 style=3D'border-collapse:collapse;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>";
		}
		$campos.="<thead><tr style=3D'page-break-inside:avoid'><td colspan=3D3 style=3D'background:#EEEEEE;padding:.75pt .75pt .75pt .75pt;text-align:center;background:white'><p style=3D'font-size:7.0pt;font-family:Arial;mso-pagination:widow-orphan lines-together;page-break-after:avoid;'><b>$row[materia]</b></p></td></tr><tr style=3D'page-break-inside:avoid'><td width=3D38 style=3D'width:1.0cm;border:none;border-bottom:solid black 2.25pt;background:#EEEEEE;padding:.75pt .75pt .75pt .75pt;text-align:center'><p style=3D'font-size:5.0pt;font-family:Arial;mso-pagination:widow-orphan lines-together;page-break-after:avoid;'><b>NUM</b></p></td><td style=3D'width:7.5cm;border:none;border-bottom:solid black 2.25pt;background:#EEEEEE;padding:.75pt .75pt .75pt .75pt;text-align:center'><p style=3D'font-size:5.0pt;font-family:Arial;mso-pagination:widow-orphan lines-together;page-break-after:avoid;'><b>DESCRIPCION</b></p></td><td width=3D38 style=3D'width:1.0cm;border:none;border-bottom:solid black 2.25pt;background:#EEEEEE;padding:.75pt .75pt .75pt .75pt;text-align:center'><p style=3D'font-size:5.0pt;font-family:Arial;mso-pagination:widow-orphan lines-together;page-break-after:avoid;'><b>\$US</b></p></td></tr></thead><tbody>";
	}
}else{
	if($materia_==''){
				//									echo '<br>'.$materia_;
		$campos.="<p align=3Dright style=3D'margin-top:0cm;text-align:right;mso-pagination:widow-orphan lines-together;page-break-after:avoid;font-size:18.0pt;font-family:Arial'><table class=3DMsoNormalTable border=3D0 cellspacing=3D0 cellpadding=3D0 style=3D'border-collapse:collapse;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'><thead><tr style=3D'page-break-inside:avoid'><td colspan=3D3 style=3D'background:#EEEEEE;padding:.75pt .75pt .75pt .75pt;text-align:center;background:white'><p style=3D'font-size:7.0pt;font-family:Arial;mso-pagination:widow-orphan lines-together;page-break-after:avoid;'></p></td></tr><tr style=3D'page-break-inside:avoid'><td width=3D38 style=3D'width:1.0cm;border:none;border-bottom:solid black 2.25pt;background:#EEEEEE;padding:.75pt .75pt .75pt .75pt;text-align:center'><p style=3D'font-size:5.0pt;font-family:Arial;mso-pagination:widow-orphan lines-together;page-break-after:avoid;'><b>NUM</b></p></td><td style=3D'width:7.5cm;border:none;border-bottom:solid black 2.25pt;background:#EEEEEE;padding:.75pt .75pt .75pt .75pt;text-align:center'><p style=3D'font-size:5.0pt;font-family:Arial;mso-pagination:widow-orphan lines-together;page-break-after:avoid;'><b>DESCRIPCION</b></p></td><td width=3D38 style=3D'width:1.0cm;border:none;border-bottom:solid black 2.25pt;background:#EEEEEE;padding:.75pt .75pt .75pt .75pt;text-align:center'><p style=3D'font-size:5.0pt;font-family:Arial;mso-pagination:widow-orphan lines-together;page-break-after:avoid;'><b>\$US</b></p></td></tr></thead><tbody>";
	}
}
	$campos.=(($row['120']!=$prm||$row['materia']!=$materia_)&&$ss_file!='none'?"<tr style=3D'page-break-inside:avoid'><td colspan=3D3 style=3D'background:#F5F5F5;padding:.75pt .75pt .75pt .75pt;font-size:9.0pt;font-family:Arial;text-align:center;mso-pagination:widow-orphan lines-together;page-break-after:avoid;background:white'><p style=3D'font-size:8.0pt;font-family:Arial;mso-pagination:widow-orphan lines-together;page-break-after:avoid;'><b>$row[120]</b></p></td></tr>" : "");//"<tr class='prm' style=''><td colspan='3'>$row[120]</td></tr>" : "");
	$campos.="<tr style=3D'page-break-inside:avoid'><td style=3D'border:none;border-bottom:solid black 1.0pt;padding:.75pt .75pt .75pt .75pt'><p class=3DMsoNormal align=3Dcenter style=3D'text-align:center;font-size:9.0pt;'>".($estado!='cerrado'||$ss_tipo=='oferta'?$numeracion:(substr($row[3],-3)+0)).".</p></td><td style=3D'border:none;border-bottom:solid black 1.0pt;padding:6.0pt .75pt 6.0pt .75pt'><p class=3DMsoNormal style=3D'text-align:justify;font-size:9.0pt;'>";
	$a=0;
	$campos.=$row['ficha'];
	$campos.="</p></td><td valign=3Dbottom style=3D'border:none;border-bottom:solid black 1.0pt;padding:.75pt .75pt .75pt .75pt'><p class=3DMsoNormal align=3Dright style=3D'text-align:right;font-size:9.0pt'>$precioVen</p></td></tr>";
	$materia_=$row['materia'];
	$prm=$row['120'];
	$numeracion++;
}While($row=mysqli_fetch_assoc($$name->q_src));
$campos.="</tbody></table></div>";
echo $campos;
?>
<p style=3D'margin-bottom:12.0pt'><o:p>&nbsp;</o:p></p>
</div>
</body>
</html>

------=_NextPart_01D0B67C.61A11150
Content-Location: file:///C:/B133A691/<?PHP echo $cat;?>_archivos/header.htm
Content-Transfer-Encoding: quoted-printable
Content-Type: text/html; charset="utf-8"

<html xmlns:v=3D"urn:schemas-microsoft-com:vml"
xmlns:o=3D"urn:schemas-microsoft-com:office:office"
xmlns:w=3D"urn:schemas-microsoft-com:office:word"
xmlns:st1=3D"urn:schemas-microsoft-com:office:smarttags"
xmlns=3D"http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=3DContent-Type content=3D"text/html; charset=3Dutf-8">
<meta name=3DProgId content=3DWord.Document>
<meta name=3DGenerator content=3D"Microsoft Word 11">
<meta name=3DOriginator content=3D"Microsoft Word 11">
<link id=3DMain-File rel=3DMain-File href=3D"../<?PHP echo $cat?>.htm">
<![if IE]>
<base href=3D"file:///C:\B133A691\<?PHP echo $cat?>_archivos\header.htm"
id=3D"webarch_temp_base_tag">
<![endif]><o:SmartTagType
 namespaceuri=3D"urn:schemas-microsoft-com:office:smarttags"
 name=3D"metricconverter"/>
<o:SmartTagType namespaceuri=3D"urn:schemas-microsoft-com:office:smarttags"
 name=3D"PersonName"/>
<!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext=3D"edit" spidmax=3D"9218"/>
</xml><![endif]--><!--[if gte mso 9]><xml>
 <o:shapelayout v:ext=3D"edit">
  <o:idmap v:ext=3D"edit" data=3D"8"/>
 </o:shapelayout></xml><![endif]-->
</head>
<body lang=3DES>
<div style=3D'mso-element:header' id=3Dh2>
<div style=3D'mso-element:para-border-div;border:solid windowtext 2.25pt;padding:3.0pt 3.0pt 3.0pt 3.0pt;background:#DDDDDD'>
<p class=3DMsoHeader style=3D'background:#DDDDDD;border:none;mso-border-alt:solid windowtext 2.25pt;padding:0cm;mso-padding-alt:3.0pt 3.0pt 3.0pt 3.0pt'>
<b><span style=3D'font-size:11.0pt;font-family:Arial;'><?PHP echo $nombre?>. Catálogo No. <?PHP echo $cat?>.</span></b>
</p>
</div>
</div>
<div style=3D'mso-element:footer' id=3Df2>
<div style=3D'mso-element:para-border-div;border:solid windowtext 2.25pt;padding:3.0pt 3.0pt 3.0pt 3.0pt;background:#DDDDDD'>
<p class=3DMsoNormal style=3D'line-height:75%;tab-stops:center <?PHP echo ($tipo=='blanket'?'9.5':'8.0')?>cm right <?PHP echo ($tipo=='blanket'?'18.5':'15.5')?>cm;background:#DDDDDD;border:none;mso-border-alt:solid windowtext 2.25pt;padding:0cm;mso-padding-alt:3.0pt 3.0pt 3.0pt 3.0pt'>
<!-- p class=3DMsoNormal style=3D'line-height:75%;tab-stops:center 277.55pt right 522.0pt;background:#DDDDDD;border:none;mso-border-alt:solid windowtext 2.25pt;padding:0cm;mso-padding-alt:3.0pt 3.0pt 3.0pt 3.0pt' -->
<b style=3D'mso-bidi-font-weight:normal'><span style=3D'font-size:10.0pt;line-height:75%;font-family:Arial;mso-no-proof:yes'>
<!--[if gte vml 1]><v:shapetype id=3D"_x0000_t75" coordsize=3D"21600,21600"
 o:spt=3D"75" o:preferrelative=3D"t" path=3D"m@4@5l@4@11@9@11@9@5xe" filled=3D"f"
 stroked=3D"f">
 <v:stroke joinstyle=3D"miter"/>
 <v:formulas>
  <v:f eqn=3D"if lineDrawn pixelLineWidth 0"/>
  <v:f eqn=3D"sum @0 1 0"/>
  <v:f eqn=3D"sum 0 0 @1"/>
  <v:f eqn=3D"prod @2 1 2"/>
  <v:f eqn=3D"prod @3 21600 pixelWidth"/>
  <v:f eqn=3D"prod @3 21600 pixelHeight"/>
  <v:f eqn=3D"sum @0 0 1"/>
  <v:f eqn=3D"prod @6 1 2"/>
  <v:f eqn=3D"prod @7 21600 pixelWidth"/>
  <v:f eqn=3D"sum @8 21600 0"/>
  <v:f eqn=3D"prod @7 21600 pixelHeight"/>
  <v:f eqn=3D"sum @10 21600 0"/>
 </v:formulas>
 <v:path o:extrusionok=3D"f" gradientshapeok=3D"t" o:connecttype=3D"rect"/>
 <o:lock v:ext=3D"edit" aspectratio=3D"t"/>
</v:shapetype><v:shape id=3D"_x0000_s8193" type=3D"#_x0000_t75" alt=3D"LA" style=3D'position:absolute;
 margin-left:<?PHP echo ($tipo=='blanket'?'18.5':'15.5')?>cm;margin-top:-28.55pt;width:49.65pt;height:1in;z-index:1'>
 <v:imagedata src=3D"LAF.png" o:title=3D"LA"/>
</v:shape><![endif]--></span></b>
<b style=3D'mso-bidi-font-weight:normal'>
<span style=3D'font-size:10.0pt;line-height:75%;font-family:Arial'>P.O.Box 164900
	<span style=3D'mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</span>
	<span style=3D'mso-spacerun:yes'>&nbsp;
	</span>www.incabook.com<br>
	Miami, Florida 33116 - U.S.A.
	<span style=3D'mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</span>
	<span style=3D'mso-spacerun:yes'>&nbsp;</span>bookssur@aol.com
</span>
<span style=3D'mso-tab-count:1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span>
<span style=3D'mso-spacerun:yes'>&nbsp;</span>
</b>
<b style=3D'mso-bidi-font-weight:normal'>
<span style=3D'font-size:10.0pt;line-height:75%;font-family:Arial'>Página </span>
</b>
<span class=3DMsoPageNumber>
<b style=3D'mso-bidi-font-weight:normal'>
	<span style=3D'font-size:13.0pt;line-height:75%'>
		<span style=3D'mso-field-code:" PAGE "'>
			<span style=3D'mso-no-proof:yes'>1
			</span>
		</span>
	</span>
</b>
</span>
<span class=3DMsoPageNumber>
<b style=3D'mso-bidi-font-weight:normal'>
	<span style=3D'font-size:10.0pt;line-height:75%;font-family:Arial'>&nbsp;de
	</span>
</b>
</span>
<span class=3DMsoPageNumber>
<b style=3D'mso-bidi-font-weight:normal'>
<span style=3D'font-size:13.0pt;line-height:75%'>
	<span style=3D'mso-field-code:" SECTIONPAGES   \\* MERGEFORMAT "'>
		<span style=3D'mso-no-proof:yes'>1
		</span>
	</span>
</span>
</b>
</span>
<b style=3D'mso-bidi-font-weight:normal'>
	<span style=3D'font-size:10.0pt;line-height:75%;font-family:Arial'><o:p></o:p>
	</span>
</b>
</p>
</div>
</div>
</body>
</html>

------=_NextPart_01D0B67C.61A11150
Content-Location: file:///C:/B133A691/<?PHP echo $cat;?>_archivos/LAT.png
Content-Transfer-Encoding: base64
Content-Type: image/png

<?PHP
echo base64_encode_image('../images/LAT.png','png');
?>

------=_NextPart_01D0B67C.61A11150
Content-Location: file:///C:/B133A691/<?PHP echo $cat;?>_archivos/logo.png
Content-Transfer-Encoding: base64
Content-Type: image/png

<?PHP
echo base64_encode_image('../images/logo.png','png');
?>

------=_NextPart_01D0B67C.61A11150
Content-Location: file:///C:/B133A691/<?PHP echo $cat;?>_archivos/LAF.png
Content-Transfer-Encoding: base64
Content-Type: image/png

<?PHP
echo base64_encode_image('../images/LAF.png','png');
?>

------=_NextPart_01D0B67C.61A11150
Content-Location: file:///C:/B133A691/<?PHP echo $cat;?>_archivos/filelist.xml
Content-Transfer-Encoding: quoted-printable
Content-Type: text/xml; charset="utf-8"

<xml xmlns:o=3D"urn:schemas-microsoft-com:office:office">
 <o:MainFile HRef=3D"../<?PHP echo $cat;?>.htm"/>
 <o:File HRef=3D"LAT.png"/>
 <o:File HRef=3D"logo.png"/>
 <o:File HRef=3D"LAF.png"/>
 <o:File HRef=3D"header.htm"/>
 <o:File HRef=3D"filelist.xml"/>
</xml>
------=_NextPart_01D0B67C.61A11150--

