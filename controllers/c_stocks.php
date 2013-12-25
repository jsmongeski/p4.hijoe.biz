<?php


class stocks_controller extends base_controller {

    public function __construct() {
        parent::__construct();

    }

    public function add($portfolio_id) {

        
        # Setup view
        $this->template->content = View::instance('v_stocks_add');
        $this->template->title   = "Add Stocks";
        $this->template->content->portf_id   =  $portfolio_id;
        
        # Create an array of 1 or many client files to be included before the closing </body> tag
        $client_files_body = Array(
                "/js/portfolioTbl.js",
        );
        # Use load_client_files to generate the links from the above array
        $this->template->client_files_body = Utils::load_client_files($client_files_body);  

        $q = "SELECT portfolio_name FROM portfolios WHERE portfolio_id = '$portfolio_id'";
        $pfname = DB::instance(DB_NAME)->select_field($q);

        $this->template->content->pfname = $pfname ;

        # Render template
        echo $this->template;

    }# add



    public function p_add($update) {
	   	   
	     # This function will add a row of the html stock table to a row in the db stock table:

	     #echo '<br>';
	     #echo '<pre>';
	     #print_r($_POST); 
	     #echo '</pre>';

        $i = 0;
	     foreach($_POST as $key => $value) {
            
            if ( $i == 3) {

               $values[$i] = $value;

               $stockArr['symbol']  = $values[0];
               $stockArr['purchase_price']  = $values[1];
               $stockArr['portfolio_id'] = $values[2];
               $stockArr['nshares'] = $values[3];
               #$stockArr['broker_url'] = $values[4];

               $stockArr['created']  = Time::now();
               $stockArr['modified'] = Time::now();

               if($update == 0) {

                  # New set of stocks, insert them as they are:
                  DB::instance(DB_NAME)->insert('stocks', $stockArr);

               } else {

                   # Updating existing stocks for this portfolio, skip over those that exist,
                   # insert new stocks into table:
                    
                   $wherestr =  "WHERE symbol = '" . mysql_real_escape_string($stockArr['symbol']). "'" . "AND portfolio_id ='" .  mysql_real_escape_string($stockArr['portfolio_id']). "'"; 

                   
                   $q = "SELECT symbol FROM stocks ".$wherestr;
                   $sym = DB::instance(DB_NAME)->select_field($q);

                   if ($sym != $stockArr['symbol']) {
                      # Insert new stock:
                      DB::instance(DB_NAME)->insert('stocks', $stockArr);
                   } 
               }
               
               $i = 0;

            } else {
                $values[$i] = $value;
                $i++;
                continue;
            }
        }

        Router::redirect("/");
    }# p_add



    public function p_pfget($pfname) {

       # Setup view
       $this->template->content = View::instance('v_stocks_add');
       $this->template->title   = "Get Stocks";
        
       # Create an array of 1 or many client files to be included before the closing </body> tag
       $client_files_body = Array(
                "/js/portfolioTbl.js",
       );
       # Use load_client_files to generate the links from the above array
       $this->template->client_files_body = Utils::load_client_files($client_files_body);  


       $q = "SELECT portfolio_id FROM portfolios WHERE portfolio_name = '$pfname'";
       $pfid = DB::instance(DB_NAME)->select_field($q);
       $this->template->content->portf_id   =  $pfid ;

       $q = "SELECT * FROM stocks WHERE portfolio_id = '$pfid'";
       $symbols = DB::instance(DB_NAME)->select_array($q, 'stock_id');
       

       $restorelist = "";

       foreach($symbols as $row => $innerArray) {
           foreach($innerArray as $innerRow => $value) {
              if ($innerRow == "symbol" ) {
                  $restorelist = $restorelist . $value . " ";
              }
              if ($innerRow == "purchase_price" ) {
                  $restorelist = $restorelist . $value . " ";
              }
              if ($innerRow == "nshares" ) {
                  $restorelist = $restorelist  .$value . " ";
              }
              #if ($innerRow == "broker_url" ) {
              #    $restorelist = $restorelist  .$value . " ";
              #}
           }     
       }     

       $this->template->content->restorelist = $restorelist ;
       $this->template->content->pfname = $pfname ;

       # Render template
       echo $this->template;

    }# p_pfget



    public function deletestock() {
        echo "Got into stock delete";
       
	     print_r($_POST); 

       $q = "DELETE FROM stocks
          WHERE symbol = '" . mysql_real_escape_string($_POST['symbol']). "'";
       

       DB::instance(DB_NAME)->query($q);

    }# deletestock
}
?>
