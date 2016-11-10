<?php
function generateHeader($currentButton){
	$buttons = [
		'Начало' => 'index.php',
		'За нас' => 'about.php'
	];
	echo "
	<nav>
		<ul>";
	foreach($buttons as $name => $link){
		echo "
			<li><a " . (($name === $currentButton) ? " class='current'" : "href='$link'") . ">$name</a></li>";
	}
	echo "
		</ul>
	</nav>";
}
