<HTML>

 <FORM ACTION=ediciond.php METHOD=post>

 DAME CLAVE A BUSCAR:<INPUT TYPE=text NAME=CLAVE><BR>

 <INPUT TYPE=submit NAME=OK VALUE="BUSCAR"><BR>

</FORM></HTML>



<?php

if($_SERVER['REQUEST_METHOD']=='POST'){

     $OK=($_POST['OK']);

     $CLAVE=($_POST['CLAVE']);

   }

   if(isset($OK)) {

     if ($OK == "BUSCAR") {

     // tamano registro y cantidad de registros

     $TR=47; $CR=filesize('datos.dat') / $TR;



     // creando y abriendo archivo

     $archivo=fopen('datos.dat','r+') or die("no puedo abrir archivo");



     // colocandonos en byte de registro a leer

     if (($CLAVE-1) * $TR < filesize('datos.dat') )

      {

       fseek($archivo, ($CLAVE-1) * $TR);

    

       // leyendo y desempacando el registro

       $reg=fread($archivo,$TR);

       $reg= unpack("iclave/A30nombre/iedad/destatura/A1bandera", $reg);



       // construyendo forma dinamica

       echo "<FORM ACTION=ediciond.php METHOD=post>";

       echo "CLAVE:<INPUT TYPE=text NAME=CLAVE value=$reg[clave]><BR>";



       // recordar que strings se encadenan con .

       echo "NOMBRE:<INPUT TYPE=text NAME=NOMBRE value= \"".$reg['nombre']."\"><BR>";

       echo "EDAD:<INPUT TYPE=text NAME=EDAD value=$reg[edad]><BR>";

       echo "ESTATURA:<INPUT TYPE=text NAME=ESTATURA value=$reg[estatura]><BR>";

       echo "<input type=hidden name=bandera value=$reg[bandera]>";

       echo "<INPUT TYPE=submit NAME=OK VALUE=editar><BR>";

       echo "</FORM>";

    };

    //cerrando archivo

    fclose($archivo);

  };

      $OK=$_POST["OK"];

      $CLAVE=$_POST["CLAVE"];

      $NOMBRE=$_POST['NOMBRE'];

      $EDAD=$_POST['EDAD'];

      $ESTATURA=$_POST["ESTATURA"];

    

   $bandera="A";

   if(isset($OK)) {

     if ($OK == "editar") {

     // creando y abriendo archivo

     $archivo=fopen('datos.dat','r+') or die("no puedo abrir archivo");



     // empacando los campos del registro

     $registro =pack("IA30idA1",$CLAVE,$NOMBRE,$EDAD,$ESTATURA,$bandera);



     // colocandonos en posicion

     // tamano registro y cantidad de registros

     $TR=47; $CR=filesize('datos.dat') / $TR;



     // colocandonos en byte de registro a grabar

     if ( ($CLAVE -1) * $TR < filesize('datos.dat') )

      {

       fseek($archivo, ($CLAVE - 1) * $TR);



       // grabando

       fwrite($archivo,$registro,strlen($registro));

    };



   //cerrando archivo

   fclose($archivo);



   //avisando

   echo "registro editado<br>";

  };

 }}

?>