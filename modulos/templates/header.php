<?php session_start();?>
<head>
  <title>The Cave Atrs</title>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="../../css/style.css" type="text/css" media="all" />
  <link rel="stylesheet" href="../../css/obra.css" type="text/css" media="all" />
  <link rel="stylesheet" href="../../css/footer.css" type="text/css" media="all" />
  <link rel="stylesheet" href="../../css/estilos.css" type="text/css" />
  <link rel="stylesheet" href="../../css/layout.css" type="text/css" media="all" />
  <link rel="stylesheet" href="../../css/login.css" type="text/css" media="all" />
  <link rel="shortcut icon" type="image/x-icon" href="../../css/images/favicon.ico" />
  <link rel="stylesheet" href="../../../css/venta.css" type="text/css" media="all" />
  <script type="text/javascript" src="../../js/jquery1.4.2.js"></script>
  <script type="text/javascript" src="../../js/jquery-ui-1.8.2.custom.min.js"></script>
  <script type="text/javascript" src="../../js/login.js"></script>   
  <script src="../../js/jquery-1.7.2.min.js"></script>
  <script src="../../js/AjaxUpload.2.0.min.js"></script>


  <?php include('../../lib/connect.php') ?>
  <?php include('../../lib/librerias.php') ?>

  <script>    
  $(document).ready(function(){
        //Lo primero que hago es capturar el evento de submit es decir cuando se envia el form para 
        //evitar que se procese normalmente y lo haga por ajax
        $('#login_form').submit(function(event){
         //recupero los valores ingresados en los input con id usuario e id password
         var usuario = $('#usuario').val();
         var password =  $('#password').val();
         //controlo que no se envien vacios
         if(usuario=='' || password==''){
          alert('El Usuario no Existe');
        }else{
         $.ajax({
          type: "POST",
          url: '../login/validar.php',
          data: {usuario:usuario, password:password},
          async: false,
          dataType: "json",
          success: function(data){
            if(data.control == 1){
             return true;
           }else{
                        //con esta funcion se previene que el formulario se envie
                        event.preventDefault();
                        alert('Los Datos ingresados no son correctos.');
                      }
                    },                           
                    error: function(qhx, trownError){
                      alert(trownError);
                    }   

                  });
       }
     });
});

</script>



</head>
<body>

	<div class="header">
   <div id="menu">
    <div id="logo">
      <img src="../../img/logo.png"/>
</div>


    <!--SETEO DE USUARIO PARA CARGA DEL MENU_______ -->
      <?php
      if(isset($_SESSION['usuario_id']))
      {
        $usuario_tipo=$_SESSION['usuario_tipo'];
        if($usuario_tipo==1){
          ?>
          <ul>
            <li><a href="../../index.php">Home</a></li>
            <li><a href="<?php echo "../usuario/usuario_edit.php?usua_id=". $_SESSION['usuario_id']?>">Edit User</a></li>
            <li><a href="../categoria/cate_listado.php">Category</a></li>
            <li><a href="../obra/obra_new.php">Obra</a></li>
            <li><a href="../usuario/usuario_listado.php">Users</a></li>
            <li><a href="../venta/venta_listado.php">Sales</a></li>
            <li><a href="../venta/venta_new.php">My Cart</a></li>
          </ul>
          <?php
        } 
        if($usuario_tipo==2){ ?>
        <ul>
          <li><a href="../../index.php">Home</a></li>
          <li><a href="<?php echo "../usuario/usuario_edit.php?usua_id=". $_SESSION['usuario_id']?>">Edit User</a></li>
          <li><a href="../venta/venta_new.php">My Cart</a></li>
        </ul>
        <?php }

      }else{?>
      <ul>
        <li><a href="../../index.php">Home</a></li>
        <li><a href="../usuario/usuario_new.php">Register</a></li>
      </ul>
      <?php }?>
      <!--SETEO DE USUARIO PARA CARGA DEL MENU_______ -->



    <?php 
    if(isset($_SESSION['usuario_nombre'])){
     ?>


     <div class="logd">
      <div id="tab-logd">
        <h2><?php echo $_SESSION['usuario_nombre']; ?></h2>
        <a href="../login/logout.php">Log-Out</a>
        <a href="../venta/venta_new.php">My Cart(<?php 
          if(isset($_SESSION['ventas'])){
            echo count($_SESSION['ventas']);
          }else{
            echo "0";
          }
          ?>)</a>
        </div>
      </div>


      <?php
    }else
    { ?>
    <div class="lnk">
      <a href="#" class="login_btn"><span>Login</span><div class="triangle"></div></a>
    </div>
    <div id="login_box">
      <div id="tab"><a href="..." class="login_btn"><span>Login</span><div class="triangle"></div></a></div>
      <div id="login_box_content"></div>
      <div id="login_box_content">
        <form id="login_form" action="#" method="post">
          <h2>Ingresa Tus Datos...</h2>
          <input type="text" id="usuario" placeholder="Username" />
          <input type="password" id="password" placeholder="Password" />
          <button type="submit" value="Log-In">Log-In</button>
        </form>
      </div>
    </div>
    <?php }?>

  </div>
</div>    

