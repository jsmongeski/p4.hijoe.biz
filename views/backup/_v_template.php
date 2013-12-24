<!DOCTYPE html>

<html>

<head>

	<title><?=APP_NAME?> </title>
   <link rel="stylesheet" type="text/css" href="/style.css">
	<!-- Note: for some reason the live server does not find /css/main.css. -->
	<!-- It does find /style.css, so using that instead, for now.           -->
   <!--link rel="stylesheet" type="text/css" href="/css/main.css"-->

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
</head>


<h1>
    <a  href='/'><img id="dollars" src="/images/dollars.jpg" alt="dollars" ></a> &nbsp;
    <?=APP_NAME?>!  &nbsp; &nbsp; &nbsp; 

</h1>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>

    <div id='menu'>


    <ul>
        <li><a  href='/'>Home&nbsp;</a></li>
        <li><a  href='/portfolios/createpf'>Create Portfolio &nbsp;</a></li>
        <li><a  href='/portfolios/listportfolios/get'>List All Portfolios &nbsp; </a></li>
        <li><a  href='/portfolios/listportfolios/delete'>Delete Portfolio</a></li>
    </ul>

    </div>
    <p></p>

    <div id='content'>
    <?php if(isset($content)) echo $content; ?>
    <?php if(isset($client_files_body)) echo $client_files_body; ?>
    </div>

</html>

<!--
        <li><a  href='/about/about'>About Portfolio Plus</a></li>
-->
