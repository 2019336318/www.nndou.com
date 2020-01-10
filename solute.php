<?php
  include 'header.php';
  $service_arr = select_all('service');
  $serv_arr = select_all('serv_type');
  // pre( $serv_arr);

  include 'views/solute.html';
  // echo $this_url;
  
  include 'footer.php';
?>