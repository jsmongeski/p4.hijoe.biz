<?php
class portfolios_controller extends base_controller {

    public function __construct() {
        parent::__construct();
        #echo "portfolios_controller construct called<br><br>";
    } 


    public function index() {
        #echo "This is the index page";
    }


    public function createpf($error = NULL, $hidden = NULL) {

        # Setup view
        $this->template->content = View::instance('v_pf_createpf');
        $this->template->title   = "Create New Portfolio";

        # Create an array of 1 or many client files to be included before the closing </body> tag
        #$client_files_body = Array( '/js/createpf.js',);

        # Use load_client_files to generate the links from the above array
        #$this->template->client_files_body = Utils::load_client_files($client_files_body);  

        $this->template->content->error = $error;
        $this->template->content->hidden = $hidden;

        # Render template
        echo $this->template;
    }


    # Receives post from v_pf_createpf, validate fields, dump portfolio
    # information to the  portfolio database.
    public function p_createpf() {


        # Debug: dump out results of POST to see what the form submitted
        #echo '<pre>';
        #print_r($_POST);
        #echo '</pre>';          
   
        # Check for blank fields:
        #foreach($_POST as $key => $value) {
        #if (empty($value) ||  !strcmp($value, "Portfolio Name"))  {
        #       #Router::redirect("/portfolios/createpf/error/blank");
        #       echo "empty value: " . $value;
        #   }
        #}
        
        if (empty($_POST['portfolio_name']) ||  !strcmp($_POST['portfolio_name'], "Portfolio Name")) {
           Router::redirect("/portfolios/createpf/blank");
           #echo "empty value: " . $_POST['portfolio_name'];
        }

        # ...Eventually the app will support email notifications:
        # Check for valid email:
        #if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
        #  Router::redirect("/portfolios/createpf/error/bademail");


        # Sanitize the data:
        $_POST = DB::instance(DB_NAME)->sanitize($_POST);

        # Check if this portfolio already exists:
        $q = "SELECT portfolio_name 
           FROM portfolios 
           WHERE portfolio_name = '".$_POST['portfolio_name']."'"; 

        $pfname = DB::instance(DB_NAME)->select_field($q);

        if($pfname ==  $_POST['portfolio_name']) {
           Router::redirect("/portfolios/createpf/exists");
           #echo "pfname: " . $pfname;
        }
        
        # Store created/modified timestamps with the user:
        $_POST['created']  = Time::now();
        $_POST['modified'] = Time::now();


        # Insert this portfolio into the database
        $portfolio_id = DB::instance(DB_NAME)->insert('portfolios', $_POST);


        # Then direct the user to the stock input page:
        $path = "/portfolios/createpf/" .$portfolio_id;
        Router::redirect($path);
    }



    public function listportfolios($action) {

       # Setup view
       $this->template->content = View::instance('v_pf_listall');
       $this->template->title   = "Show Portfolios";

       # Create an array of 1 or many client files to be included before the closing </body> tag
       $client_files_body = Array(
           '/js/portfolioTbl.js',
       );

       $this->template->client_files_body = Utils::load_client_files($client_files_body);  


       $q = "SELECT portfolio_name FROM portfolios";
       $portfolios = DB::instance(DB_NAME)->select_rows($q);

       $portfoliolist = "";

       foreach($portfolios as $row => $innerArray){
           foreach($innerArray as $innerRow => $value){
            $portfoliolist = $portfoliolist . $value . " ";
           }
       }     

       #echo "portfoliolist: " . $portfoliolist;
       $this->template->content->portfolios = $portfoliolist;
       $this->template->content->action = $action;

       # Render template
       echo $this->template;
    }

    public function deleteportfolio($pfname) {

       # Get the portfolio by name, then delete it.
       $q = "DELETE FROM portfolios
          WHERE portfolio_name = '" . $pfname. "'";
       
       DB::instance(DB_NAME)->query($q);
       Router::redirect("/");
    }

} # end of the class
