<?php 

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "salon";
  $ip=getenv("REMOTE_ADDR");
  date_default_timezone_set('Asia/Kolkata');
  $time=date("Y-m-d h:i:sa");
  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) 
  {
    die("Connection failed: " . mysqli_connect_error());
  }
  /*use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  require 'C:/xampp/htdocs/PHPMailer/PHPMailer-master/src/Exception.php';
  require 'C:/xampp/htdocs/PHPMailer/PHPMailer-master/src/PHPMailer.php';
  require 'C:/xampp/htdocs/PHPMailer/PHPMailer-master/src/SMTP.php';*/

  if(isset($_POST['submit']))
  {
    $name=$_POST['full_name'];
    $mobile=$_POST['phone_number'];
    $email=$_POST['email'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];
      
    if ((preg_match ("/^[a-zA-z]*$/", $name)) && (preg_match ("/^[0-9]*$/", $mobile) ) && (preg_match ("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $email)))   
    {  
      $sql = "INSERT INTO contact_form  VALUES ('$name','$mobile','$email','$subject','$message','$ip','$time')";
  
      if(mysqli_query($conn, $sql))
      {
        echo "";
        $msg="Client Name :-".$name."\nPhone No:-".$mobile."\nEmail:-".$email."\n     ".$message; 
        //mail sending
        $mail=mail("salon@gmail.com",$subject,$msg);
        if($msg==true)
        {
          echo "send successfully";
        }
        /*
        $mail = new PHPMailer(true);
        try {
          // Server settings
          $mail->isSMTP();
          $mail->Host       = 'smtp.gmail.com';
          $mail->SMTPAuth   = true;
          $mail->Username   = 'salon';
          $mail->Password   = '';
          $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail->Port       = 587;

          // Recipients
          $mail->setFrom('nilambarokothavale4@gmail.com', 'nilambari');
          $mail->addAddress('komalmengane8833@gmail.com', 'komal Name');

          // Content
          $mail->isHTML(true);
          $mail->Subject = $subject;
          $mail->Body    = $msg;

          $mail->send();
          echo 'Email sent successfully';
        } 
        catch (Exception $e) 
        {
          echo "Email sending failed. Error: {$mail->ErrorInfo}";
        }*/
      } 
      else
      {
        echo "ERROR: Hush! Sorry $sql. ". mysqli_error($conn);
      }
    } 
    else
    {

      $ErrMsg = "Only alphabets and whitespace are allowed.";  
      echo $ErrMsg;  

    }
  }

?>