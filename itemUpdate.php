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
    if($_SESSION['key'] != 1){
      header('location: login.html');
    }
  }

  if(isset($_GET['userList'])){
		$id=(int) $_GET['userList'];

		$buscar_id=$db->prepare('SELECT * FROM mtconstruccion WHERE id_mt=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
  }
  else{
		header('Location: itemUpdate.php');
  }
/*
  if($_SESSION['activate'] == 'ON'){

    header('location: superuserUsers.php');
    $_SESSION['activate'] = "OFF";
  }
*/
	if(isset($_POST['update'])){

    $updateName = $_POST['newName'];
    $updateDesc = $_POST['newDesc'];
    $updatePrecio = $_POST['newPrecio'];
    $updateStock = $_POST['newStock'];
    $updatePeso = $_POST['newPeso'];
    $updateFecha = $_POST['newFecha'];
    $updateMedida = $_POST['newMedida'];

		$id=(int) $_GET['userList'];
    $value = (int)$updateStock;

    if($value < 1 || $value > 200000){
      $error = 1;
    }
    else{
      $error = 0;
      $query = $db->prepare(' UPDATE mtconstruccion SET 
      name_mt=:updateName, 
      desc_mt=:updateDesc,
      precio_mt=:updatePrecio,
      stock_mt=:updateStock, 
      peso_mt=:updatePeso,
      fecha_mt=:updateFecha,
      medida_mt=:updateMedida
      WHERE id_mt=:id;');

      $state = $query->execute([':updateName' =>$updateName,
      ':updateName' =>$updateName,
      ':updateDesc' =>$updateDesc,
      ':updatePrecio' =>$updatePrecio,
      ':updateStock' =>$updateStock,
      ':updatePeso' =>$updatePeso,
      ':updateFecha' =>$updateFecha,
      ':updateMedida' =>$updateMedida,
      ':id' =>$id]);
      header('Location: user.php');
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
        <a href="user.php"><li><img src="css/img/provider.png" alt="" class="list-nav">&nbsp;<span>Mat-Construcción</span></li></a>
        <a href="provider.php"><li><img src="css/img/provider.png" alt="" class="list-nav">&nbsp;<span>Mat-Electricidad</span></li></a>
        <a href="provider.php"><li><img src="css/img/provider.png" alt="" class="list-nav">&nbsp;<span>Maq-Cons-Elec</span></li></a>
        <a href="provider.php"><li><img src="css/img/provider.png" alt="" class="list-nav">&nbsp;<span>Mat-Pintura</span></li></a>
        <a href="provider.php"><li><img src="css/img/provider.png" alt="" class="list-nav">&nbsp;<span>Mat-Carpinteria</span></li></a>
        <a href="provider.php"><li><img src="css/img/provider.png" alt="" class="list-nav">&nbsp;<span>Maq-Pint-Carp</span></li></a>
        <a href="provider.php"><li><img src="css/img/provider.png" alt="" class="list-nav">&nbsp;<span>Mat-Plomería</span></li></a>
        <a href="provider.php"><li><img src="css/img/provider.png" alt="" class="list-nav">&nbsp;<span>Mat-Soldadura</span></li></a>
        <a href="provider.php"><li><img src="css/img/provider.png" alt="" class="list-nav">&nbsp;<span>Maq-Plom-Sold</span></li></a>
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
          <h2>DATOS PRODUCTO</h2>
            <br>
            <input type="text" class="add-user" name="newName" value="<?php if($resultado) echo $resultado['name_mt']; ?>" placeholder="Ingresar Nombre Producto" required>
            <input type="text" class="add-user" name="newDesc" value="<?php if($resultado) echo $resultado['desc_mt']; ?>" placeholder="Ingrese Descripción" required>
            <input type="number" class="add-user" name="newPrecio" value="<?php if($resultado) echo $resultado['precio_mt']; ?>" placeholder="Ingresar Precio" step="any" required>
            <input type="number" class="add-user" name="newStock" value="<?php if($resultado) echo $resultado['stock_mt']; ?>" placeholder="Ingresar Stock" required>
            <input type="number" class="add-user" name="newPeso" value="<?php if($resultado) echo $resultado['peso_mt']; ?>" placeholder="Ingresar Peso" step="any" required>
            <input type="date" class="add-user" name="newFecha" value="<?php if($resultado) echo $resultado['fecha_mt']; ?>" placeholder="Ingrese Fecha" required>
            <input type="number" class="add-user" name="newMedida" value="<?php if($resultado) echo $resultado['medida_mt']; ?>" placeholder="Ingresar Medida" step="any" required>
            <button type="submit" name="update" value="update" class="btn">ACTUALIZAR PRODUCTO</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
