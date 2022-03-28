<?php
  session_start();
  include_once 'php/connection.php';
  $database = new Connection();
  $db = $database->open();

  $query = "SELECT * FROM providers ORDER BY categoria_provider ASC";
  $result = $db->query($query);

  if(!isset($_SESSION['key'])){
    header('location: login.html');
  }
  else{
    if($_SESSION['key'] != 2){
      header('location: login.html');
    }
  }
/*
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
  */
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
        <a href="admin.php"><li><img src="css/img/people.png" alt="" class="list-nav">&nbsp; <span>Usuarios</span></li></a>
        <a href="provider.php"><li><img src="css/img/provider.png" alt="" class="list-nav">&nbsp;<span>Proveedores</span></li></a>
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

          <div class="col-md-5">
            <a href="providerAdd.php">
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
                    <th class="bg-primary" scope="col">RAZÓN SOCIAL</th>
                    <th class="bg-primary" scope="col">CATEGORÍA</th>
                    <th class="bg-primary" scope="col">NIT</th>
                    <th class="bg-primary" scope="col">TELEFONO</th>
                    <th class="bg-primary" scope="col">EMAIL</th>
                    <th class="bg-primary" scope="col">OPCIONES</th>
                  </tr>
                </thead>

                <?php
                foreach($result as $res):?>
                <tbody>
                  <tr>
                    <td><?php echo $res["name_provider"]; ?></td>
                    <td><?php echo $res["categoria_provider"]; ?></td>
                    <td><?php echo $res["nit_provider"]; ?></td>
                    <td><?php echo $res["telephone_provider"]?></td>
                    <td><?php echo $res["email_provider"]; ?></td>


                    <td>
                      <a href="providerUpdate.php?userList=<?php echo $res['id_provider']; ?>" class="btnAction btn btn-info">Editar</a>
                      <a href="function.php?providerDelete=<?php echo $res['id_provider']; ?>" class="btnAction btn btn-info">Eliminar</a>
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
               var cilook = $("#cilook").val();
               if(cilook != '')
               {
                    $.ajax({
                         url:"function.php",
                         method:"POST",
                         data:{cilook:cilook},
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
