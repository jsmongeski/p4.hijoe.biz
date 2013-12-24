<?php

public function displaylastname ($user = NULL) {

   $q = "SELECT last_name FROM users WHERE first_name = '$user'";
   $lastnm = DB::instance(DB_NAME)->select_field($q);
   echo "Found last name " . $lastnm;
}

            

$users = array();
$q = "SELECT first_name FROM users";
$users = DB::instance(DB_NAME)->select_rows($q);


<?php foreach($users as $user): ?>


   <a href='/users/displaylastname/<?=$user['first_name']?>' target= "_blank"><?=$user['first_name']?>get lastname</a-->


    <br><br>
<?php endforeach; ?>
