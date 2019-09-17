<html>
<head>
  <link href="./assets/plugins/fakeLoader/fakeLoader.css" rel="stylesheet" type="text/css">
  <link href="./assets/plugins/fakeLoader/fakeLoader.css" rel="stylesheet" type="text/css">
  <link href="./assets/plugins/fakeLoader/fakeLoader.css" rel="stylesheet" type="text/css">
  <link href="./assets/plugins/fakeLoader/fakeLoader.css" rel="stylesheet" type="text/css">
  <link href="./assets/plugins/plugin-css/plugin-offcanvas.min.css" rel="stylesheet" type="text/css">
  <link href="https://unpkg.com/js-offcanvas/dist/_css/prefixed/js-offcanvas.css" rel="stylesheet" type="text/css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/assets/owl.carousel.min.css" rel="stylesheet" type="text/css">
  <link href="./assets/plugins/plugin-css/plugin-owl-carousel.min.css" rel="stylesheet" type="text/css">
  <link href="./assets/plugins/plugin-css/plugin-sticky-classes.min.css" rel="stylesheet" type="text/css">
  <link href="./assets/plugins/fakeLoader/fakeLoader.css" rel="stylesheet" type="text/css">
  <link href="./assets/plugins/plugin-css/plugin-blazy.min.css" rel="stylesheet" type="text/css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" rel="stylesheet" type="text/css">

  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="Main.css">
  <!-- @todo: fill with your company info or remove -->
  <meta name="description" content="">
  <meta name="author" content="Themelize.me">

  <!-- Bootstrap v4.1.1 CSS via CDN -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">

  <!-- Plugins required on all pages NOTE: Additional non-required plugins are loaded ondemand as of AppStrap 2.5 -->

  <!-- Theme style -->
  <link href="assets/css/theme-style.min.css" rel="stylesheet">

  <!-- Shop UI CSS - required if using shopping cart or any shop pages -->
  <link href="assets/css/theme-shop.min.css" rel="stylesheet">

  <!--Your custom colour override-->
  <link href="#" id="colour-scheme" rel="stylesheet">

  <!-- Your custom override -->
  <link href="assets/css/custom-style.css" rel="stylesheet">



  <!-- Optional: ICON SETS -->
  <!-- Iconset: Font Awesome 5.0.13 via CDN -->
  <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
  <!-- Iconset: flag icons - http://lipis.github.io/flag-icon-css/ -->
  <link href="assets/plugins/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
  <!-- Iconset: ionicons - http://ionicons.com/ -->
  <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet">
  <!-- Iconset: Linearicons - https://linearicons.com/free -->
  <link href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css" rel="stylesheet">
  <!-- Iconset: Lineawesome - https://icons8.com/articles/line-awesome -->
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">


  <!-- Le fav and touch icons - @todo: fill with your icons or remove, try https://realfavicongenerator.net -->
  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/favicons/favicon-16x16.png">
  <link rel="manifest" href="assets/favicons/manifest.json">
  <link rel="shortcut icon" href="assets/favicons/favicon.ico">
  <meta name="msapplication-config" content="assets/favicons/browserconfig.xml">
  <meta name="theme-color" content="#ffffff">


  <!-- Google fonts -->
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700,300" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Rambla:400,700" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Calligraffitti" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,700" rel="stylesheet" type="text/css">
  <link href="http://fonts.googleapis.com/css?family=Roboto:100,400,700" rel="stylesheet" type="text/css">

  <!--Plugin: Retina.js (high def image replacement) - @see: http://retinajs.com/-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/retina.js/1.3.0/retina.min.js"></script>
</head>
<body>
  <div class="header">
	  <div class="header-inner container">
      <!--branding/logo -->
      <div class="header-brand flex-first">
        <a class="header-brand-text" href="" title="Home">
          <h1>
            <span>Remote</span>Debugging<span></span>
          </h1>
        </a>
      </div>
    </div>
  </div>
	<!-- Features -->
  <div id="features" class="container py-4 py-lg-6">
    <hr class="hr-lg mt-0 mb-3 w-50 mx-auto hr-primary">
    <h2 class="text-center text-uppercase font-weight-bold my-0">
      Authentication
    </h2>
    
    <hr class="mb-5 w-50 mx-auto">
    <div>
      <form action="login.php" method="POST">
        <table class="mx-auto">
          <tbody><tr>
            <td class="text-center">Username</td>
          </tr>
          <tr>
            <td><input required="" class="form-control form-control-rounded" type="text" name="Username_Textbox"></td>
          </tr>
          <tr>
            <td class="text-center"><div class="mt-2">Password</div></td>
          </tr>
          <tr>
            <td><input required="" class="form-control form-control-rounded" type="password" name="Password_Textbox"></td>
          </tr>
          <tr>
            <td class="text-center"><input class="w-65 mb-1 mt-3 btn btn-primary btn-rounded" name="user_login" type="submit" value="Login"></td>
          </tr>
          <tr>
            <td class="text-center"><p style="color: red;"></p></td>
          </tr>
        </tbody></table>
      </form>
    </div>    
  </div>
</body></html>