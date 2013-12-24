
<!-- 

  This view file simply sets a hidden input tag with a value of stock info for a given portfolio as 
 currently found in the stock db.  The js file attaches to the id in order to use the stock iformation 
 to rebuild the stock table with stocks contained within a specified portfolio_id.

 Although this seems kludgy, and what I read on stackoverflow seemed to lean that way, I've 
 also read and heard that it is a legit way of passing php variables to javascript.  I also considered
 using ajax to do this, (but did not go that way due to time constraints in getting p4 done)!
   <link rel="stylesheet" type="text/css" href="/css/noMainMenu.css">
-->
    <div id='results'></div>

    <?php if(isset($restorelist)): ?>
       <input id="restorelist" type="hidden" value="<?=$restorelist?>">
    <?php endif; ?>

