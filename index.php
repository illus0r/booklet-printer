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

?>
<div id="header">
<h1>Печаталка буклетов</h1>
</div>
<div id="description">
<p>При помощи этого сайта можно печатать буклеты. Не нужно ничего устанавливать. Понадобится программа, позволяющая печатать документ с указанием номеров страниц.</p>
<p>Ограничения - распечатать можно число страниц, которое делится на 4. Иначе последняя страница повторится 1-3 раза, чтобы заполнить место.</p>
</div>
<div id="intervals">
<form action="index.php" method="get">
Со страницы <input type="text" name="fromPage" value="<?php if($fromPage){echo($fromPage);}else{echo 1;}?>"><br />
По страницу <input type="text" name="toPage" value="<?php if($toPage){echo($toPage);}else{echo 20;}?>"><br />
<input type="submit" value="Считать">
</form>
</div>
<?php

if($fromPage and $toPage){
	$voidPageNumber = $toPage;

	# becouse we counting from 0
	$fromPage -= 1;
	$plus = $fromPage;
	$realAmount = $toPage - $fromPage;

	$printAmount = $realAmount;
	if ($printAmount%4 != 0){
		$addedPageAmount = 4-$printAmount%4;
		echo "<div class='warning'>Внимание! Последняя страница будет напечатана $addedPageAmount раз(а)! Если это нежелательно, добавьте в конец печатаемого документа ещё $addedPageAmount пустых страницы и задайте интервал от $fromPage+1 до $toPage+$addedPageAmount.</div><br />";
		$printAmount = $printAmount+$addedPageAmount;
	}

	$pagesA = array();
	$pagesB = array();
	for($i=1;$i<($printAmount/2)+1; $i+=2){
		$pagesA[] = $printAmount+1-$i+$plus;
		$pagesA[] = $i+$plus;
	}
	for($i=2;$i<($printAmount/2)+1; $i+=2){
		$pagesB[] = $i+$plus;
		$pagesB[] = $printAmount+1-$i+$plus;
	}
	foreach($pagesA as &$page){
		if($page>$realAmount)
			$page = $realAmount;
	}
	foreach($pagesB as &$page){
		if($page>$realAmount)
			$page = $realAmount;
	}


	# printing page arrays, replacing all pages over realAmount by voidPagesNumber
	echo "side A";
	outputPages("outputPagesA",$pagesA);
	echo "side B";
	outputPages("outputPagesB",$pagesB);
	
	?>
	<h2>Инструкция</h2>
	<?php
}

?>
<h2>twitter</h2>
