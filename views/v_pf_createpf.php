
<head>
    <TITLE> Portfolio Plus!</TITLE>
</head>


<?php if(isset($error)): ?>

   <?php if(!strcmp($error, "blank"))  : ?>
           <p>Please enter a portfolio name: <a = "createpf" href='/portfolios/createpf'>Create Portfolio</a></p>

   <?php elseif(!strcmp($error, "bademail")) : ?>
           <p>Invalid email address, please click "Create Portfolio" and try again.</p>

    <?php elseif(!strcmp($error, "exists")) : ?>
            Portfolio already exists! Please try again: <a = "createpf" href='/portfolios/createpf'>Create Portfolio</a>

    <?php else : ?>
            Now add stocks to the portfolio:  <a = "createpf" href='/stocks/add/<?=$error?>'>Add Stocks!</a>
    <?php endif; ?>

<?php else : ?>

	     <?php if(isset($client_files_body)) echo $client_files_body; ?>

        <p>
            Start by giving a name to your portfolio:
        </p>


      <form method='POST' action='/portfolios/p_createpf'>
   
        <input type='text' placeholder="Portfolio Name" name='portfolio_name' id="portfolio_name">

        <input type='submit' value='Submit'>
   
      </form>
<?php endif; ?>

<!--
        <input type='text' placeholder="Your Email Address" name='email' id='email'>
    <link rel="stylesheet" href="/css/noMainMenu.css" type="text/css">
        <input type='text' placeholder="Broker Url" name='broker_url' id='brokerurl'>
-->
