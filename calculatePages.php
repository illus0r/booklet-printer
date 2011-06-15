<?php

function outputPages($divClass,$pages){
	$outputString = "";
	foreach($pages as $page){
		$outputString .= "$page";
		$outputString .= ',';
}
$outputString = substr($outputString,0,-1);
echo '<div class='.$divClass.'>
<p>'.$outputString.'</p>
</div>
';
}

$fromPage = $_GET["fromPage"];
$toPage = $_GET["toPage"];

$voidPageNumber = 16;

# becouse we counting from 0
$fromPage -= 1;
$plus = $fromPage;
$realAmount = $toPage - $fromPage;

$printAmount = $realAmount;
if ($printAmount%4 != 0){
    echo "pages must be 4, 8, 12 etc, otherwise another pages will be turned to last page";
    $printAmount = $printAmount+(4-$printAmount%4);
	echo "printAmount =". $printAmount;
}

$pagesA = array();
$pagesB = array();
for($i=1;$i<($printAmount/2)+1; $i+=2){
	$pagesA[] = $printAmount+1-$i;
	$pagesA[] = $i;
}
for($i=2;$i<($printAmount/2)+1; $i+=2){
	$pagesB[] = $i;
	$pagesB[] = $printAmount+1-$i;
}


# printing page arrays, replacing all pages over realAmount by voidPagesNumber
echo "side A";
outputPages("outputPagesA",$pagesA);
echo "side B";
outputPages("outputPagesB",$pagesB);

require("index.php");
require("info.php");
?>

