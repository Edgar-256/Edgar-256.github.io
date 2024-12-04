<FORM ACTION=altas.php METHOD=post><HTML>

CLAVE:<INPUT TYPE=text NAME=CLAVE><BR>
NOMBRE:<INPUT TYPE=text NAME=NOMBRE><BR>
EDAD:<INPUT TYPE=text NAME=EDAD><BR>
ESTATURA:<INPUT TYPE=text NAME=ESTATURA><BR>
<INPUT TYPE=submit NAME=OK VALUE="insertar"><BR>
</FORM></HTML>

<?php
$OK=$_POST["OK"];
$CLAVE=$_POST["CLAVE"];
$NOMBRE=$_POST["NOMBRE"];
$EDAD=$_POST["EDAD"];
$ESTATURA=$_POST["ESTATURA"];

if ($OK == "insertar") {
// creando y abriendo archivo

$archivo=fopen('datos.dat','r+') or die("no puedo abrir archivo");
// empacando los campos del registro
// recordar que la clave debe empezar en 0
// recordar crear y poner en 'A' campo de status ver bajas en unidad anterior

$bandera='A';
$registro =pack("IA30idA1",$CLAVE,$NOMBRE,$EDAD,$ESTATURA,$bandera);
$pos=($CLAVE-1)*47;
fseek($archivo, $pos, SEEK_SET);

// grabando el registro
fwrite($archivo,$registro,strlen($registro));

//cerrando archivo
fclose($archivo);

//avisando
echo "registro # ".$CLAVE." insertado"."<br>";
};
?>
