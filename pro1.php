<?php
  session_start();
  header('Content-Type: text/html; charset=UTF-8'); 
  include_once 'php/connection.php';
  $database = new Connection();
  $db = $database->open();

  $query = "SELECT * FROM mtconstruccion WHERE item_mt = '2' ORDER BY id_mt ASC";
  $result = $db->query($query);

  if(!isset($_SESSION['key'])){
    header('location: login.html');
  }
  else{
    if($_SESSION['key'] != 1){
      header('location: login.html');
    }
  }

  if(isset($_GET['userState'])){
    $id=(int) $_GET['userState'];
    $updateState = '';
    $state = '';
    $buscar_id=$db->prepare('SELECT * FROM users WHERE id_user=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
    if($resultado){
      $state = $resultado['state_user'];
    }

    if($state == 'habilitado'){
      $updateState = 'deshabilitado';
    }
    if($state == 'deshabilitado'){
      $updateState = 'habilitado';
    }
    if($updateState != ''){
      $sdb = $db->prepare(' UPDATE users SET
      state_user=:updateState WHERE id_user=:id;');

      $state = $sdb->execute([
      ':updateState' =>$updateState,
      ':id' =>$id]);
      header('location: admin.php');
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/admin.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.js"></script>
  </head>
  <body>
    <div class="side-menu">

      <div class="brand-img">
        <img src="css/img/user.png" alt="" class="brand-logo">
      </div>

      <div class="brand-name">
        <h2> <?php echo $_SESSION['name'] ?></h2> 
      </div>

      <div class="brand-surname">
        <h2> <?php echo $_SESSION['surname'] ?> </h2> 
      </div>

      <div class="brand-bar"></div>

      <ul>
        <a href="user.php"><li style="padding: 7px;padding-left: 5px;"><img src="css/img/provider.png" alt="" class="list-nav"><span style="font-size: 18px;">Mat-Construcción</span></li></a>
        <a href="pro1.php"><li style="padding: 7px;padding-left: 5px;"><img src="css/img/provider.png" alt="" class="list-nav"><span style="font-size: 18px;">Mat-Electricidad</span></li></a>
        <a href="pro2.php"><li style="padding: 7px;padding-left: 5px;"><img src="css/img/provider.png" alt="" class="list-nav"><span style="font-size: 18px;">Maq-Cons-Elec</span></li></a>
        <a href="pro3.php"><li style="padding: 7px;padding-left: 5px;"><img src="css/img/provider.png" alt="" class="list-nav"><span style="font-size: 18px;">Mat-Pintura</span></li></a>
        <a href="pro4.php"><li style="padding: 7px;padding-left: 5px;"><img src="css/img/provider.png" alt="" class="list-nav"><span style="font-size: 18px;">Mat-Carpinteria</span></li></a>
        <a href="pro5.php"><li style="padding: 7px;padding-left: 5px;"><img src="css/img/provider.png" alt="" class="list-nav"><span style="font-size: 18px;">Maq-Pint-Carp</span></li></a>
        <a href="pro6.php"><li style="padding: 7px;padding-left: 5px;"><img src="css/img/provider.png" alt="" class="list-nav"><span style="font-size: 18px;">Mat-Plomería</span></li></a>
        <a href="pro7.php"><li style="padding: 7px;padding-left: 5px;"><img src="css/img/provider.png" alt="" class="list-nav"><span style="font-size: 18px;">Mat-Soldadura</span></li></a>
        <a href="pro8.php"><li style="padding: 7px;padding-left: 5px;"><img src="css/img/provider.png" alt="" class="list-nav"><span style="font-size: 18px;">Maq-Plom-Sold</span></li></a>
      </ul>
    </div>

    <div class="container">
      <div class="header">
        <div class="nav">
          <div class="nav-logo">
            <p>RU <span class="namelog">DY</span></p>
          </div>

          <div class="nav-logout">
            <a href="login.php?close" class="btn-logout"><li>LOGOUT &nbsp; <img src="css/img/logout.png" alt="" class="list-nav"></li></a>
          </div>
        </div>
      </div>

      <div class="content">
        <div class="menu-nav">
          <div class="col-md-3">
            <input type="text" name="userlook" id="itemlook" class="form-control" placeholder="Nombre Producto" />
          </div>
          
          <div>
          <input type="image" name="filte" id="filte" value="Buscar" class="btn menu-search " src="css/img/search.png" />
          </div>

          <div class="col-md-5">
            <a href="itemAdd.php">
            <input type="button" name="addUser"  value="Agregar" class="btn btn-info">
            </a>
          </div>
        </div>

        <div class="seccion">
          <form>
            <h2></h2>
            <div id="order_table">
              <table class="content-table">
                <thead>
                  <tr class="active-row">
                    <th class="bg-primary" scope="col">PRODUCTO</th>
                    <th class="bg-primary" scope="col">DESCRIPCION</th>
                    <th class="bg-primary" scope="col">PRECIO</th>
                    <th class="bg-primary" scope="col">STOCK</th>
                    <th class="bg-primary" scope="col">PESO</th>
                    <th class="bg-primary" scope="col">VENCE</th>
                    <th class="bg-primary" scope="col">MEDIDA</th>
                    <th class="bg-primary" scope="col">OPCIONES</th>
                  </tr>
                </thead>

                <?php
                foreach($result as $res):?>
                <tbody>
                  <tr>
                    <td><?php echo $res["name_mt"]; ?></td>
                    <td style="width: 20px;"><?php echo $res["desc_mt"]; ?></td>
                    <td><?php echo $res["precio_mt"]; ?></td>
                    <td><?php echo $res["stock_mt"]; ?></td>
                    <td><?php echo $res["peso_mt"]; ?></td>
                    <td><?php echo $res["fecha_mt"]; ?></td>
                    <td><?php echo $res["medida_mt"]; ?></td>
                    <td>
                      <a href="function.php?itemSend=<?php echo $res['id_mt']; ?>" class="btnAction btn btn-info">Solicitar</a>
                      <a href="itemUpdate.php?userList=<?php echo $res['id_mt']; ?>" class="btnAction btn btn-info">Editar</a>
                      <a href="function.php?itemDelete=<?php echo $res['id_mt']; ?>" class="btnAction btn btn-info">Eliminar</a>
                    </td>
                  </tr>
                </tbody>
                <?php endforeach ?>
              </table>
            </div>
          </form>
        </div>  
      </div>
    </div>

  </body>
</html>

<script>
     $(document).ready(function(){
          $('#filte').click(function(){
               var itemlook = $("#itemlook").val();
               if(itemlook != '')
               {
                    $.ajax({
                         url:"function.php",
                         method:"POST",
                         data:{itemlook:itemlook},
                         success:function(data)
                         {
                              $('#order_table').html(data);
                         }
                    });
               }
               else
               {
                    alert("Por favor, introduzca el ci de usuario.");
               }
          });

          $('#habilitados').click(function(){
               var habilitados = $("#habilitados").val();
               $.ajax({
                         url:"function.php",
                         method:"POST",
                         data:{habilitados:habilitados},
                         success:function(data)
                         {
                              $('#order_table').html(data);
                         }
              });
          });

          $('#deshabilitados').click(function(){
               var deshabilitados = $("#deshabilitados").val();
               $.ajax({
                         url:"function.php",
                         method:"POST",
                         data:{deshabilitados:deshabilitados},
                         success:function(data)
                         {
                              $('#order_table').html(data);
                         }
              });
          });
     });
</script>
