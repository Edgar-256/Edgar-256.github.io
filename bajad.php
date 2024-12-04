<HTML>
<FORM ACTION=bajad.php METHOD=post>
DAME CLAVE A ELIMINAR:<INPUT TYPE=text NAME=CLAVE><BR>
<INPUT TYPE=submit NAME=OK VALUE="BAJA"><BR>
</FORM></HTML>

<?php
$OK=$_POST["OK"];
$CLAVE=$_POST["CLAVE"];
@$NOMBRE=$_POST["NOMBRE"];
@$EDAD=$_POST["EDAD"];
@$ESTATURA=$_POST["ESTATURA"];
if ($OK == "BAJA") {

// tamano registro y cantidad de registros
$TR=47; $CR=filesize('datos.dat') / $TR;

// creando y abriendo archivo
$archivo=fopen('datos.dat','r+') or die("no puedo abrir archivo");

// colocandonos en byte de registro a leer
if ( $CLAVE * $TR < filesize('datos.dat') )
{
fseek($archivo, ($CLAVE-1) * $TR);

// leyendo y desempacando el registro
$reg=fread($archivo,$TR);
$reg= unpack("iclave/A30nombre/iedad/destatura/A1bandera", $reg);

// cambiando la bandera del registro para ponerla en baja
$reg['bandera']="B";

// empacando otra vez
$reg =pack("IA30idA1",$reg['clave'],$reg['nombre'],$reg['edad'],$reg['estatura'],$reg['bandera']);

// regresando apuntador al principio del renglon
rewind($archivo);
fseek($archivo, ($CLAVE-1) * $TR);

// regrabando registro
fwrite($archivo,$reg,strlen($reg));
};

//cerrando archivo
fclose($archivo);

// avisando
echo "REGISTRO ELIMINADO";
};
?>
