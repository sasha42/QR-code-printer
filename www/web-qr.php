<?php
$PLAY = $_POST['QR'];

if(empty($PLAY)) {
echo "<h2>Oups, this requires input</h2>\n" ;
die ("Go back and, try again. Kill will ignore the input.");
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="web.css">
    <title>QR Print</title>
  </head>
  <body>
    <div class="container">
      <div class="starter-template">
       <h1>Printed <small><?php echo $PLAY?></small></h1>  
        <script language="JavaScript" type="text/javascript">
        setTimeout("window.history.go(-1)",5000);
      </script>
      </div>
    </div>  
  </body>

<?php
ob_start();
system('/scripts/qr.sh '.escapeshellarg($_SERVER['HTTP_USER_AGENT']) .escapeshellarg('|') .escapeshellarg($_SERVER['REMOTE_ADDR']) .escapeshellarg('|qr|') .escapeshellarg($LANG) .escapeshellarg('|') .escapeshellarg($PLAY));
ob_end_clean();
?>