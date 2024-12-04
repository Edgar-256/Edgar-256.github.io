<HTML>

<FORM ACTION=lecturad.php METHOD=post>
<INPUT TYPE=submit NAME=OK VALUE="consulta"><BR>
</FORM></HTML>

<?php
$OK=$_POST['OK'];
if (@$OK == "consulta") {

// tamano registro y cantidad de registros
$TR=47;$CR=filesize('datos.dat') / $TR;

// creando y abriendo archivo
$archivo=fopen('datos.dat','r+') or die("no puedo abrir archivo");

//empezando una tabla html
echo "<HTML><TABLE Border=10 CellPadding=5><TR>";
echo"<th bgcolor=Green>CLAVE</th><th bgcolor=White>NOMBRE</th><th bgcolor=Red>EDAD</th><th bgcolor=YellowRed>ESTATURA</th></TR>";

// abriendo en lectura el registro
for($x=1; $x<=(int)$CR; $x=$x+1)
{
// leyendo y desempacando el registro
$reg=fread($archivo,$TR);
$reg= unpack("iclave/A30nombre/iedad/destatura/A1bandera", $reg);

// desplegando
if ($reg['bandera'] == "A"){

echo"<tr>";
echo "<td>".$reg['clave']."</td>";
echo "<td>".$reg['nombre']."</td>";
echo "<td>".$reg['edad']."</td>";
echo "<td>".$reg['estatura']."</td>";
echo"</tr>"; };
};

//cerrando archivo y tabla
echo "</table>";
fclose($archivo);
};
?>
