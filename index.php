<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="image/obat.ico">
    <title>Sistem Informasi Persediaan Obat</title>
    <link rel="stylesheet" href="css/loginstyle.css" media="screen" title="no title" charset="utf-8">
  </head>
  <body style="max-width: 100%; overflow-y: hidden; background-image: url(image/batthern.png);">
    <form id="login" action="include/login.php" method="post">
      <div class="logo">

        <img Class="banner" src="image/logo.png" alt="" />
        <h4>LOGIN
            <p style="font-size:18px;">Sistem Informasi Persediaan Obat</p>
        </h4>
        <img Class="banner" style="width:75px; height:75px"src="image/obat.png" alt="" />

      </div>

      <div class="table">
        <div class="tr">
            <div class="td">
              <img Class="user" src="image/user.png" alt="" />
              <input type="text" name="username" value="" placeholder="Username" required>
            </div>
            <div class="td" align="right">
              <img Class="user" src="image/log.png" alt="" />
              <input type="password" name="password" value="" placeholder="Password" required>
            </div>
        </div>
        <input type="submit" name="login" value="LOGIN"><input type="reset" style="margin-top:-14px;" name="reset" value="CANCEL">
      </div>
    </form>
  </body>
</html>
