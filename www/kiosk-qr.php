<?php
$PLAY = $_POST['QR'];

if(empty($PLAY)) {
echo "<html>
  <head>
    <link rel=\"stylesheet\" href=\"kiosk.css\">
    <title>Error</title>
  </head>
  <body>
    <div class=\"container\">
      <div class=\"starter-template\">
       <h5>This requires input</h5>
       <script language=\"JavaScript\" type=\"text/javascript\">
        setTimeout(\"window.history.go(-1)\",1500);
      </script>
      </div>
    </div>
    </div>
  </body>";
die ("");
}
?>
<script language="JavaScript" type="text/javascript">
history.go(-1);
</script>
<?php
ob_start();
system('/scripts/qr.sh '.escapeshellarg($_SERVER['HTTP_USER_AGENT']) .escapeshellarg('|') .escapeshellarg($_SERVER['REMOTE_ADDR']) .escapeshellarg('|qr|') .escapeshellarg($LANG) .escapeshellarg('|') .escapeshellarg($PLAY));
ob_end_clean();
?>
