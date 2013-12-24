<!-- 

  This view file simply sets a hidden input tag with a value of all portfolios currently found in
 the db.  The js file attaches to the id in order to build a form which presents all portfolios to 
 the user, for a specific action, eg retrieve the portfolio or delete the portfolio.
 
 Although this seems kludgy, and what I read on stackoverflow seemed to lean that way, I've 
 also read and heard that it is a legit way of passing php variables to javascript.  I also considered
 using ajax to do this, (but did not go that way due to time constraints in getting p4 done)!
   <link rel="stylesheet" type="text/css" href="/css/noMainMenu.css">
-->


   <input id="pfaction" type="hidden" value="<?=$action?>">
   <input id="portflist" type="hidden" value="<?=$portfolios?>">


