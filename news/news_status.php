<?php
session_start();
 include '../db.php';
$id=$_GET['id'];
$select_status="SELECT * FROM news WHERE id=$id";
$select_status_result=mysqli_query($bd_connect,$select_status);
$status_after_assoc=mysqli_fetch_assoc($select_status_result);
       // news status count
       $select_user=" SELECT COUNT(*) as counts FROM news WHERE status=1";
       $select_user_result=mysqli_query($bd_connect,$select_user);
       $after_count=mysqli_fetch_assoc($select_user_result);

    if ($status_after_assoc['status']==1) {
          
                 if($after_count['counts']==2){
                    $_SESSION['news_2_item']='Must be 2 Item Active ';
                    header('location:view_news.php');
                     
                 }
                 else{
                    $update_status="UPDATE news SET status=0 WHERE id=$id";
                    $udate_result=mysqli_query($bd_connect,$update_status);
                    $_SESSION['news_deactive_access']='Deactive Success';
                    header('location:view_news.php');
                 }
    }

   else{
       
      if($after_count['counts']==3){
         $_SESSION['news_3_item_only']='Only 3 item Active ';
         header('location:view_news.php');
          
      }
      else{
        $update_status="UPDATE news SET status=1 WHERE id=$id";
        $udate_result=mysqli_query($bd_connect,$update_status);
        $_SESSION['news_active_access']='Active Success';
        header('location:view_news.php');
            
        
        }

      }



?>