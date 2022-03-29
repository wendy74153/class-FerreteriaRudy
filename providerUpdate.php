<?php
  session_start();
  include_once 'php/connection.php';
  $database = new Connection();
  $db = $database->open();
  $error = 0;

  if(!isset($_SESSION['key'])){
    header('location: login.html');
  }
  else{
    if($_SESSION['key'] != 2){
      header('location: login.html');
    }
  }

  if(isset($_GET['userList'])){
		$id=(int) $_GET['userList'];

		$buscar_id=$db->prepare('SELECT * FROM providers WHERE id_provider=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
  }
  else{
		header('Location: providerUpdate.php');
  }
/*
  if($_SESSION['activate'] == 'ON'){

    header('location: superuserUsers.php');
    $_SESSION['activate'] = "OFF";
  }
*/
	if(isset($_POST['update'])){
    $updateName = $_POST['newName'];
    $updateCategoria = $_POST['newCategoria'];
    $updateNit = $_POST['newNit'];
    $updateTelephone = $_POST['newTelephone'];
    $updateEmail = $_POST['newEmail'];

		$id=(int) $_GET['userList'];
    $value = (int)$updateCategoria;

    if($value < 1 || $value > 20){
      $error = 1;
    }
    else{
      $error = 0;
      $query = $db->prepare(' UPDATE providers SET 
      categoria_provider=:updateCategoria, 
      name_provider=:updateName,
      nit_provider=:updateNit,
      telephone_provider=:updateTelephone, 
      email_provider=:updateEmail
      WHERE id_provider=:id;');

      $state = $query->execute([':updateCategoria' =>$updateCategoria,
      ':updateName' =>$updateName,
      ':updateNit' =>$updateNit,
      ':updateTelephone' =>$updateTelephone,
      ':updateEmail' =>$updateEmail,
      ':id' =>$id]);
      header('Location: provider.php');
    }
	}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="css/admin.css">
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
        <div class="seccion">
          <form class="form-add" action="" method="POST">
            <h2>ACTUALIZAR USUARIO</h2>
            <br>
            <input type="text" class="add-user" name="newName" value="<?php if($resultado) echo $resultado['name_provider']; ?>" placeholder="Ingresar Nombre o Razón Social" required>
            <input type="number" class="add-user" name="newNit" value="<?php if($resultado) echo $resultado['nit_provider']; ?>" placeholder="Ingresar NIT" required>
            <input type="text" class="add-user" name="newCategoria" value="<?php if($resultado) echo $resultado['categoria_provider']; ?>" placeholder="Ingrese Categoría" list="categoria" required>
            <datalist id="categoria">
                  <option value="1">MATERIAL DE CONSTRUCCION</option>
                  <option value="2">MATERIAL DE ELECTRICIDAD</option>
                  <option value="3">MAQUINARIAS DE CONSTRUICCION Y ELECTRICIDAD</option>
                  <option value="4">MATERIALES DE PINTURA</option>
                  <option value="5">MATERIALES DE CARPINTERIA</option>
                  <option value="6">MAQUINARIAS DE PINTURA Y CARPINTERIA</option>
                  <option value="7">MATERIALES DE PLOMERIA</option>
                  <option value="8">MATERIALES DE SOLDADURA</option>
                  <option value="9">MATERIALES DE PLOMERIA Y SOLDADURA</option>
                </datalist>

            <input type="number" class="add-user" name="newTelephone" value="<?php if($resultado) echo $resultado['telephone_provider']; ?>" placeholder="Ingresar Teléfono" minlength="7" required>
            <input type="email" class="add-user" name="newEmail" value="<?php if($resultado) echo $resultado['email_provider']; ?>" placeholder="Ingresar Email">

            <button type="submit" name="update" value="update" class="btn">Actualizar</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
