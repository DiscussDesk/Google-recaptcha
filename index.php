<?php
   if(isset($_REQUEST['submit']) and $_REQUEST['submit']!=""){
   
   $user_name      = filter_var($_REQUEST['name'], FILTER_SANITIZE_STRING);
   $user_email     = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
   $mobile     = filter_var($_POST["mobile"], FILTER_SANITIZE_STRING);
   $comment   = filter_var($_POST["comment"], FILTER_SANITIZE_STRING);
   
   if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
     // Google reCAPTCHA API secret key 
     $secretKey = '<reCAPTCHA API SECRET KEY>'; 
     // Verify the reCAPTCHA response 
     $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']); 
     // Decode json data 
     $responseData = json_decode($verifyResponse); 
     if($responseData->success){ 
        
       $message = 'Data has been captured and mail has been sent';
      /*======== Start: Mail Sent function ============*/
      $to = "<YOUR TO MAIL ID>";

$subject = "Enquiry mail Subject";
$txt = "
<br>Name:   ". $name." 
<br> Email:   ". $email." 
<br> Phone:   ". $mobile." 
<br> Comment:   ". $comment." 
<br> Date:   ".date("d/M/y");

$email_from = "<SET YOUR FROM Mail>"; // Who the email is from
$headers = "MIME-Version: 1.0\r\n";
$headers .="Content-type: text/html;";
$headers .= " charset=iso-8859-1\r\n";
$headers .= "From: $email_from \r\n";

mail($to,$subject,$txt,$headers);
      /*======== End: Mail Sent function ============*/

   
     } else {
       $message = 'Something goes wrong. Please try later.';
   
     }
     }
   
     }
     ?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Google reCapctha Example</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script src='https://www.google.com/recaptcha/api.js'></script>	
   </head>
   <body>
      <div class="container col-sm-5">
         <h1 style="font-size: 21px; font-weight: bold;">Demo of Integrate Google recaptcha in PHP with example</h1>
         <?php if(isset($message) and $message!=""){?>
         <div class="alert alert-success"> <strong><?php echo $message;?></strong></div>
         <?php } ?>
         <form action="" method="post">
            <div class="form-group">
               <label for="pwd">Name:</label>
               <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name" required>
            </div>
            <div class="form-group">
               <label for="email">Email:</label>
               <input type="email" class="form-control" id="email" placeholder="Enter your email" name="email" required>
            </div>
            <div class="form-group">
               <label for="email">Mobile:</label>
               <input type="text" class="form-control" id="mobile"  placeholder="Enter your mobile" name="mobile" required> 
            </div>
            <div class="form-group">
               <label for="email">Comment:</label>
               <textarea name="comment" class="form-control" id="comment" placeholder="Enter your comment" required></textarea>
            </div>
            <div class="g-recaptcha" data-sitekey="<reCAPTCHA API SITE KEY>"></div>
            <div class="form-group form-check">
               <label class="form-check-label">
               <input class="form-check-input" type="checkbox" name="remember"> Remember me
               </label>
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-primary btn-lg" style="padding: 6px 46px; margin: 16px 0 0 0;">
         </form>
      </div>
   </body>
</html>


