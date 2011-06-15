<html>
<head>
<style>
a.splash-info-link{
color: silver;
}
a.splash-info-link .splash-info-container{
display:none;
}
a.splash-info-link:hover .splash-info-container{
display:inline-block;
position:absolute;
max-width:300px;
background: black;
color:white;
}
</style>
<!-- Google Analytics -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-11185551-2']);
  _gaq.push(['_setDomainName', '.booklet-printer.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</head>
<body>
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
<h1>Печаталка брошюр</h1>
</div>
<div id="description">
<p><img src="http://img824.imageshack.us/img824/7131/img0051du.jpg"></p>
<p>При помощи этого сайта можно печатать брошюры<a class="splash-info-link">(?)
			<span class="splash-info-container">
				Брошюра — это непериодическое текстовое книжное издание объёмом свыше 4, но не более 48 страниц, соединённых между собой ниткой при помощи шитья, скрепкой (скобкой), винтовой проволокой и др. Соединения скобкой могут быть нескольких видов: 1. обычное, с двумя отверстиями в корешке для каждой скобки; 2. с тремя отверстиями для каждой скобки, при этом соединении скобка вставляется в крайние отверстия, концы скобки загибаются и заводятся в третье центральное отверстие, при этом соединении концы скобок не царапают.
			</span></a>. Не нужно ничего устанавливать. Понадобится программа, позволяющая печатать документ с указанием номеров печатаемых страниц<a class="splash-info-link">(?)<span class="splash-info-container">
				<img src="intervals_ru.png" alt="Диалог печати с возможностью указания номеров печатаемых страниц" /></span></a>.</p>
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
		echo "<div class='warning'>Внимание! Последняя страница будет напечатана ";
		echo $addedPageAmount+1;
		echo " раза! Если это нежелательно, добавьте в конец печатаемого документа ещё ";
		echo $addedPageAmount;
		echo " пустых страницы и используйте интервал от ";
		echo $fromPage+1;
		echo " до ";
		echo $toPage+$addedPageAmount;
		echo ".</div><br />";
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
	echo "Сторона A:";
	outputPages("outputPagesA",$pagesA);
	echo "Сторона B:";
	outputPages("outputPagesB",$pagesB);
	
	?>
	<h2>Инструкция</h2>
	<ol>
		<li>Настройте принтер<a class="splash-info-link">(?)
			<span class="splash-info-container">
			<ol>
				<li>Печатать <strong>2</strong> страницы на листе</li>
				<li>Разобрать по копиям: <strong>включено</strong> (если печатается несколько экземпляров)</li>
				<li>Двусторонняя печать: <strong>отключено</strong></li>
				<li>Обратный порядок: <strong>отключено</strong></li>
			</ol>
			</span></a></li>
		<li>Распечатайте страницы стороны А<a class="splash-info-link">(?)
			<span class="splash-info-container">
				<img src="pasting_ru.png" alt="Ввод номеров страниц в диалог печати" />
			</span></a></li>
		<li>Переверните напечатанную стопку<a class="splash-info-link">(?)
			<span class="splash-info-container">При перевороте левая длинная кромка стопки остаётся слева, правая - справа:<br /><img src="printer.png" alt="Схема переворачивания стопки распечатанных листов" /></span></a></li>
		<li>Распечатайте страницы стороны B</li>
		<li>Проверьте, всё ли правильно</li>
		<li>Согните стопку пополам и сшейте её</li>
	</ol>
	<?php
}

?>
<h2>Поддержите проект</h2>
<p>Просто расскажите о нём знакомым.</p>
<!-- Put this script tag to the <head> of your page --> 
<script type="text/javascript" src="http://userapi.com/js/api/openapi.js?32"></script> 
 
<script type="text/javascript"> 
  VK.init({apiId: 2380474, onlyWidgets: true});
</script> 
 
<!-- Put this div tag to the place, where the Like block will be --> 
<div id="vk_like"></div> 
<script type="text/javascript"> 
VK.Widgets.Like("vk_like", {type: "button"});
</script>
<!-- twitter -->
<a href="http://twitter.com/share" class="twitter-share-button" data-count="horizontal" data-via="z_o_r">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>

<iframe src="http://www.facebook.com/plugins/like.php?href=booklet-printer.com" scrolling="no" frameborder="0" style="border:none; width:450px; height:80px"></iframe>

<h2>Обратная связь</h2>
<p>Вопросы, пожелания и предложения жду по адресу zor667@gmail.com</p>
</body>
</html>
