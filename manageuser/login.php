<html>
    <head>
        <title>Asurance Optimize</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link rel="shortcut icon" href="img/logo.jpg"/>
        <link rel="stylesheet" href="css/menu.css"/>
        <link rel="stylesheet" href="css/main.css"/>
        <link rel="stylesheet" href="css/bgimg.css"/>
        <link rel="stylesheet" href="css/bgimg-parallax.css"/>
        <link rel="stylesheet" href="css/font.css"/>
        <link rel="stylesheet" href="css/font-awesome.min.css"/>
        <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
        <script type="text/javascript" src="js/parallax.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
    </head>
<body>
    <?php 
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == "gagal"){
            echo "Login Gagal! Email/Password Salah!!!";
        }else if($_GET['pesan'] == "logout"){
            echo "Anda Telah Berhasil Logout";
        }else if($_GET['pesan'] == "belum_login"){
            echo "Anda Harus Login Untuk Mengakses Halaman Admin";
        }
    }
    ?>
    <div class="background" id="background"></div>
    <div class="backdrop"></div>
    <div class="login-form-container" id="login-form">
        <div class="login-form-content">
            <div class="login-form-header">
                <div class="logo">
                    <img src="img/logo.jpg"/>
                </div>
                <h3>Login Admin</h3>
            </div>
            <form method="post" action="cek_login.php" class="login-form">
                <div class="input-container">
                    <i class="fa fa-envelope"></i>
                    <input type="email" class="input" name="email" placeholder="Email"/>
                </div>
                <div class="input-container">
                    <i class="fa fa-lock"></i>
                    <input type="password"  id="login-password" class="input" name="password" placeholder="Password"/>
                    <i id="show-password" class="fa fa-eye"></i>
                </div>
                <input type="submit" name="login" value="Login" class="button"/>
            </form>
        </div>
    </div>
    <script type="text/javascript">
    $('#background').mouseParallax({ moveFactor: 5 });
    </script>
</body>
</html>