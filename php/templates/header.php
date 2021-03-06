<?php
function generateHeader($activeCategory){
	echo "
	<!-- header.css -->
	<header>
		<form class='login no-animation'>
			<div class='wrapper'>
				<input type='text' placeholder='e-mail'/>
				
				<input type='password' placeholder='парола' />
			</div>
			<input type='submit' value='Вход'/>
		</form>
		<h1 class='logo'><a href='/'>GIGA NET</a></h1>
		<nav>
			<a " . (($activeCategory === 'Начало') ? " class='current'" : "href='/'") . ">Начало</a>
			<a " . (($activeCategory === 'Продукти') ? " class='current'" : "href='/products'") . ">Продукти</a>
			<a " . (($activeCategory === 'За нас') ? " class='current'" : "href='/about'") . ">За нас</a>
			<div class='search'>
				<input class='search-input' type='text' placeholder='Търсене...'/>
				<svg class='search-button' height='26' viewBox='0 0 24 24' width='26' xmlns='http://www.w3.org/2000/svg'>
				    <path d='M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 
				        9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01
				        5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z'/>
					<path d='M0 0h24v24H0z' fill='none'/>
				</svg>
			</div>
		</nav>
	</header>";
}
