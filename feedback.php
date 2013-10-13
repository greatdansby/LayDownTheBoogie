<html>
<body>
<?php
if (isset($_REQUEST['message']))
//if "email" is filled out, send email
  {
  //send email
  $email = $_REQUEST['email'] ;
  $subject = 'feedback' ;
  $message = $_REQUEST['message'] ;
  mail("danielmitus@gmail.com", $subject,
  $message, "From:" . $email);
  echo "Thank you for sending your feedback";
  }
else
//if "email" is not filled out, display the form
  {
  echo "<form method='post' action='feedback.php'>
  Email: <input name='email' type='text'><br>
  Message:<br>
  <textarea name='message' rows='5' cols='40'>
  </textarea><br>
  <input type='submit'>
  </form>";
  }
?>
</body>
</html>