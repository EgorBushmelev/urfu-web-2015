<?

function error($error,$file){exit('<font face="verdana" size="1" color="#ffffff"><b>'.$error.'<br>['.htmlspecialchars($file).']</b></font>');}

if(!extension_loaded("gd"))	error("Нетю модуля GD2 на сервере",date("Дата: d.m.Y. Время: H:i:s",time()));

else
{
	if(!include("./inc/functions.inc.php")) error("не могу загрузить файл с функциями","./inc/functions.inc.php");

function read_dir($dir)
{
	if($OpenDir=opendir($dir))
	{
		while(($file=readdir($OpenDir))!==false)
		{
			if($file!="."&&$file!="..")
			{
				if(is_dir($dir."/".$file))
				{
					if(!is_readable($dir."/".$file))		error("нет прав для чтения текущий папки",$dir."/".$file);
					elseif(!is_writeable($dir."/".$file))	error("нет прав для записи в текущую папку",$dir."/".$file);
					else				read_dir($dir."/".$file);
				}

				else
				{
					if(!is_readable($dir."/".$file))		error("нет прав для чтения файла",$dir."/".$file);
					elseif(!is_writeable($dir."/".$file))	error("нет прав для записи в файл",$dir."/".$file);
				}
			}
		}
	}

	else error("нет прав",$dir);
}

	if(!is_readable("./inc"))		error("нет прав для чтения папки","./inc");
	elseif(!is_writeable("./inc"))		error("нет прав для записи в папку","./inc");
	else				read_dir("./inc");

$manlix=parse_ini_file("./inc/config.inc.dat",1) or error("не найден файл конфигурации","./inc/config.inc.dat");

$ip=(isset($_SERVER['REMOTE_ADDR']))?$_SERVER['REMOTE_ADDR']:0;

$a=$b=$c=null;

$today=date('d.m.Y',time());

$dateFile=manlix_read_file("./inc/data/date.inc.dat");

if(!isset($dateFile[0])) $dateFile[0]=0;

if($today!=$dateFile[0])
{
$OpenDate=fopen("./inc/data/date.inc.dat","w");
flock($OpenDate,1);
flock($OpenDate,2);
fwrite($OpenDate,$today);
fclose($OpenDate);

mkdir("./inc/data/".$today,0770);

$OpenToday=fopen("./inc/data/".$today."/today.inc.dat","a");
fclose($OpenToday);
}

if($ip)
{
$allFile=manlix_read_file("./inc/data/all.inc.dat");

	if(!isset($allFile[0])) $allFile[0]=0;

	$OpenAll=fopen("./inc/data/all.inc.dat","w");
	flock($OpenAll,1);
	flock($OpenAll,2);
	fwrite($OpenAll,($a=$allFile[0]+1));
	fclose($OpenAll);

	$OpenToday=fopen("./inc/data/".$today."/today.inc.dat","a");
	flock($OpenToday,1);
	flock($OpenToday,2);
	fwrite($OpenToday,$ip.chr(13).chr(10));
	fclose($OpenToday);

$todayFile=manlix_read_file("./inc/data/".$today."/today.inc.dat");

	$b=count($todayFile);
	$c=count(array_unique($todayFile));
}

if(strlen($a)>13||!isset($a))	$a="?";
if(strlen($b)>13||!isset($b))	$b="?";
if(strlen($c)>13||!isset($c))	$c="?";

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

if(file_exists("./images/All/".$a.".png"))			$image="All/".$a.".png";
elseif(file_exists("./images/AllToday/".$b.".png"))	$image="AllToday/".$b.".png";
elseif(file_exists("./images/UniqueToday/".$c.".png"))	$image="UniqueToday/".$c.".png";
else						$image="counter.png";

header("Content-type: image/png".chr(10).chr(10));

$image=ImageCreateFromPNG("./images/".$image);

$color1=ImageColorAllocate($image,$manlix['colors'][111],$manlix['colors'][111],$manlix['colors'][111]);
$color2=ImageColorAllocate($image,$manlix['colors'][222],$manlix['colors'][222],$manlix['colors'][222]);
$color3=ImageColorAllocate($image,$manlix['colors'][322],$manlix['colors'][333],$manlix['colors'][333]);

ImageString($image,1,2,2,	addSpace(manlix_normal_numeric("$a")),$color1);
ImageString($image,1,2,13,	addSpace(manlix_normal_numeric("$b")),$color2);
ImageString($image,1,2,21,	addSpace(manlix_normal_numeric("$c")),$color3);
ImagePNG($image);
}
?>