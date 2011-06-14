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
<h1>��������� ��������</h1>
</div>
<div id="description">
<p>��� ������ ����� ����� ����� �������� �������. �� ����� ������ �������������. ����������� ���������, ����������� �������� �������� � ��������� ������� �������.</p>
<p>����������� - ����������� ����� ����� �������, ������� ������� �� 4. ����� ��������� �������� ���������� 1-3 ����, ����� ��������� �����.</p>
</div>
<div id="intervals">
<form action="index.php" method="get">
�� �������� <input type="text" name="fromPage" value="<?php if($fromPage){echo($fromPage);}else{echo 1;}?>"><br />
�� �������� <input type="text" name="toPage" value="<?php if($toPage){echo($toPage);}else{echo 20;}?>"><br />
<input type="submit" value="�������">
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
		echo "<div class='warning'>��������! ��������� �������� ����� ���������� $addedPageAmount ���(�)! ���� ��� ������������, �������� � ����� ����������� ��������� ��� $addedPageAmount ������ �������� � ������� �������� �� $fromPage+1 �� $toPage+$addedPageAmount.</div><br />";
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
	<h2>����������</h2>
	<?php
}

?>
<h2>twitter</h2>
