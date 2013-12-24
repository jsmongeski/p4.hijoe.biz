p4.hijoe.biz
============

Repo for dwa15 project 4

This is the start of a stock tracker that I plan to use for my own investing.  Currently, from the main menu,
the user can:

- Create a portfolio

  The portfolio name is taken and an entry is made in the portfolio table in the 
  db. (See the db structure in p4_hijoe_biz.sql). Each portfolio has a portfolio_id field which is 
  used as a foreign key in the stocks table, to link the users stocks to the desired portfolio (see below).

   o Upon entering the portfolio name, the user can then access the stocks table page, or go to any of the
     other pages via the navigation list.  If the user goes to the stock table page, he/she can then populate 
     the portfolio with stocks, entering the symbol, purchase price and number of shares. 
   
   o The stock tabe displays stock information in a js generated html table which shows:
   
     The current (Last) price, average and current volume, original and current value and gain/loss for each stock.
   
   o There is a Delete button at the end of each row which allows the user to delete a stock from the portfolio 
     (the stock table in the database is updated immediately). 
   
   o There is a "Save Portfolio" button button which using javascript will collect the symbol, cost and number of shares data
     from the table, and post them to the stock table in database. The stocks are linked to the correct portfolio
     by use of the portfolio_id foreign key mentioned earlier. 
   
   Currently, the values for Last, Average and current volume, current value and gain/loss are all simulated.
   Upon clicking the update button in a table row, the current (Last) price is updated from 0 to 25, the current volume
   updates by 33000,  and the current value and gain/loss are updated based on the new last price.  If the stock
   has a gain, the gain/loss field is highlighted in green.  If it has a loss, the background turns red.

-List all Portfolios

    The portfolios are displayed in a column of links. Each link has the portfolio name, which when clicked, will bring
    the user to the stocks table page, displaying that portfolio of stocks.  From there the user can add and delete stocks
    and save the updated portfolio to the database.

-Delete Portfolios

    The portfolios are again displayed in a column of links. Each link has the portfolio name, which when clicked, will 
    delete the portfolio from the portfolio table and will also delete all stock entries linked with that portfolio_id.


Error checking:

-Cannot enter a blank portfolio name
-Cannot enter a portfolio name that already exists in the portfolio database

-Cannot enter a blank stock symbol

-Cannot enter a stock symbol greater than 6 characters long (according to Nasdaq that's the limit). Note, at this point
  the application is not actually conected to any quote server, so verifying that a stock symbol actually exists is
  not possible at this time. (See Future plans below).  Note that you CAN enter numeric stock symbols, the number 3
  is actually a symbol for a Hong Kong Oil and Gas, per cnbc.com.

-Cannot enter a non-numeric or negative purchase price
-Cannot enter a non-numeric or negative number of shares


Known issues:

For some reason, on the live server using /css/main.css for the style sheet does not work. If the css file is /style.css
then everything works.  So for now, the live server is using /style.css. 

Future plans for Portfolio Plus:

- Real time stock updates:

  The plan is to connect this application to Yahoo Finance for real updates, using the Yahoo Query Language (a sandbox 
  of this is currently working), but not fully implemented.  

- Broker link:
  Each portfolio will have a broker url associated with it, and displayed on the screen.  User will provide this 
  url when creating the portfolio.  Clicking on the url will take the user to the broker's site in a new tab.
  Some of this code is already present, but not working as yet.

- Display additional information for each stock, eg Next earnings date, link to news for the stock, etc.



