<?php   
set_exception_handler(
   function ($e) {
       die($e->getMessage());
   }
);

foreach($billetList as $billet){
   echo $billet['titre'];
}
 
?>
