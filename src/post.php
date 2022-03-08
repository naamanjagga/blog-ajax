<?php
  session_start();
  if(!isset($_SESSION['blog'])){
      $_SESSION['blog'] = array();
  }
?>
<?php
    if(isset($_POST['action']) && $_POST['action']=='blog'){
       $blog = $_POST['blog'];
       array_push($_SESSION['blog'] ,$blog);
       echo json_encode($_SESSION['blog']);
   }
   if(isset($_POST['action']) && $_POST['action']=='edit'){
    array_splice($_SESSION['blog'],$_POST['id'],1,$_POST['u_value']);
    echo json_encode($_SESSION['blog']);
   } 
    if(isset($_POST['action']) && $_POST['action']=='delete'){
   $blog = $_POST['blog'];
   array_splice($_SESSION['blog'],$_POST['id'],1);
    echo json_encode($_SESSION['blog']);
   }
  
?>