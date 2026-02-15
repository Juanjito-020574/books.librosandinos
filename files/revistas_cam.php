<?PHP 
	eval("$row[nums];");
//print_pre($serid_);
foreach($serid_ as $i=>$v){
?>
<span class="link" style="display:inline-block;overflow:hidden;">
<span style='font-size:1.5em'>[</span>
	<a style="font-size: 1em;color:#800000;" onclick='ficha("<?PHP echo $v;?>")'><?PHP echo "No. $serno_[$i]. $servo_[$i]";?></a>
<span style='font-size:1.5em'>]</span>
</span>
<?PHP 
}
?>