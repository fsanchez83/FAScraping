<?php
header("Content-Type:text/html; charset=utf-8");
ini_set('max_execution_time', 0);

error_reporting(E_ALL);


 ## Nombre del archivo.
$archivo = "RatingsLetterboxd.csv";
	
	##Generamos el archivo
	$f=fopen($archivo,"w");

	fputs($f,"Title,Directors,Year,Country,Rating10\n");
	

include 'simple_html_dom.php';

$iduser = $_POST['url'];

$url="http://www.filmaffinity.com/en/userratings.php?user_id=".$iduser;


//echo $url."<p>";

$html=file_get_html($url);


$buscaNP1=stristr($html,"pager");
$buscaNP2=strripos($buscaNP1,"</a> <a");
$buscaNP3=substr($buscaNP1,$buscaNP2-3,3);
$buscaNP4=stristr($buscaNP3,">");
$buscaNP5=substr($buscaNP4,1);

if ($buscaNP5==false){
	$NP=$buscaNP3;
} else {
	$NP=$buscaNP5;
}
//echo $NP."<p>";


$i=0;


while ($i<$NP){
	
	$i++;
	
	$url="http://www.filmaffinity.com/en/userratings.php?user_id=".$iduser."&p=".$i."&orderby=4";
	$html=file_get_html($url);
	
	$buscaFecha=stristr($html,"Rated on");
	$buscaFecha2=stristr($buscaFecha,"</div>", true);
	$fechavot=substr($buscaFecha2,1);
	
// BUSCAR TÍTULO, AÑO, PAÍS Y DIRECTOR

while (true){
	
//	$posfecha=strpos($html,"Rated on");
	$postit=strpos($html,"mc-title");

	if ($postit==false) break;
	
/* 	if ($posfecha<$postit && $posfecha>0){
		//Hay que actualizar fecha
		$buscaFecha=stristr($html,"Rated on");
		$buscaFecha2=stristr($buscaFecha,"</div>", true);
		$fechavot=substr($buscaFecha2,16);
 		echo "<br>Entra en el if, posfecha:".$posfecha."<br>";
		echo "<br>Entra en el if, postit:".$postit."<br>";
		 */
/*	}
	
	$fechavot=$fechavot; */
$buscaTit1=stristr($html,"mc-title");


$buscaTit2=stristr($buscaTit1, ") <img src=", true);
$buscaTit3=stristr($buscaTit2," title");
$buscaTit4=stristr($buscaTit3,">");
if ($buscaTit5=stristr($buscaTit4,")", true)!=false) {
	$titulo1=substr(stristr($buscaTit4,"(", true),1,-1);
} else{
$titulo1=substr($buscaTit4,1,-10);
}

$titulo=str_replace("&amp;","&",$titulo1);

/*
echo $buscaTit1;
echo $buscaTit2;
echo $buscaTit3;
echo $buscaTit4;
echo $titulo1;
 echo $titulo;
echo "<br><br><br><br><br><br><br>";
*/
// echo "<p>";

$buscaanno=stristr($buscaTit3, "(");
$anno=substr($buscaanno,-4);
// echo $anno;

// echo "<p>";
$buscaPais1=stristr($buscaTit1, "></div>", true);
$buscaPais2=stristr($buscaPais1," alt");
$buscaPais3=stristr($buscaPais2," title");
$pais=substr($buscaPais3,8,-1);
/* echo $pais;

echo "<p>"; */

$buscaDir=stristr($buscaTit1,"mc-director");
$buscaDir1=stristr($buscaDir, "</a>", true);
$buscaDir2=stristr($buscaDir1,"title=");
$buscaDir3=stristr($buscaDir2,">");
$director=substr($buscaDir3,1);

$buscaRat1=stristr($buscaTit1,"ur-mr-rat");
$buscaRat2=stristr($buscaRat1,"</div>", true);
$rating=substr($buscaRat2,11);


//echo $titulo.",".$director.",".$anno.",".$pais.",".$rating.",".$fechavot."<br>";

$contenido=($titulo.",".$director.",".$anno.",".$pais.",".$rating."\n");

fputs($f,$contenido);

//echo "<p>";

$html=stristr($buscaTit1,"ur-mr-rat-text");





}

usleep(1000000);
}




fclose($f);

//readfile($archivo);
//}
/* 	$enlace = $archivo;
	header ("Content-Disposition: attachment; filename=".$enlace);
	header ("Content-Type: application/octet-stream");
	header ("Content-Length: ".filesize($enlace));
	readfile($enlace); */



?>