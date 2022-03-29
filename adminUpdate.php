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

		$buscar_id=$db->prepare('SELECT * FROM users WHERE id_user=:id LIMIT 1');
		$buscar_id->execute(array(
			':id'=>$id
		));
		$resultado=$buscar_id->fetch();
  }
  else{
		header('Location: adminUpdate.php');
  }
/*
  if($_SESSION['activate'] == 'ON'){

    header('location: superuserUsers.php');
    $_SESSION['activate'] = "OFF";
  }
*/
	if(isset($_POST['update'])){
    $updateName = $_POST['newName'];
    $updateSurname = $_POST['newSurname'];
    $updateCi = $_POST['newCi'];
    $updateCiext = $_POST['newCiext'];
    $updateCiexp = $_POST['newCiexp'];
    $updateBirthdate = $_POST['newBirthdate'];
    $updateTelephone = $_POST['newTelephone'];
    $updateEmail = $_POST['newEmail'];
    $updateUser = $_POST['newUser'];
    $updatePassword = $_POST['newPassword'];
    $updateAccess = $_POST['newAccess'];

		$id=(int) $_GET['userList'];
    $value = (int)$updateAccess;

    if($value < 1 || $value > 3){
      $error = 1;
    }
    else{
      $error = 0;
      $query = $db->prepare(' UPDATE users SET 
      name_user=:updateName, 
      surname_user=:updateSurname,
      ci_user=:updateCi,
      extci_user=:updateCiext,
      expci_user=:updateCiexp,
      birthdate_user=:updateBirthdate, 
      telephone_user=:updateTelephone, 
      email_user=:updateEmail,
      user_user=:updateUser,
      password_user=:updatePassword,
      access_user=:updateAccess
      WHERE id_user=:id;');

      $state = $query->execute([':updateName' =>$updateName,
      ':updateSurname' =>$updateSurname,
      ':updateCi' =>$updateCi,
      ':updateCiext' =>$updateCiext,
      ':updateCiexp' =>$updateCiexp,
      ':updateBirthdate' =>$updateBirthdate,
      ':updateTelephone' =>$updateTelephone,
      ':updateEmail' =>$updateEmail,
      ':updateUser' =>$updateUser,
      ':updatePassword' =>$updatePassword,
      ':updateAccess' =>$updateAccess,
      ':id' =>$id]);
      header('Location: admin.php');
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
        <a href="list.php"><li><img src="css/img/provider.png" alt="" class="list-nav">&nbsp;<span>Solicitudes</span></li></a>
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
            <input type="text" class="add-user" name="newName" value="<?php if($resultado) echo $resultado['name_user']; ?>" placeholder="Ingresar Nombre" required>
            <input type="text" class="add-user" name="newSurname" value="<?php if($resultado) echo $resultado['surname_user']; ?>" placeholder="Ingresar Apellidos" required>
            <div class="form-ci">
              <input type="number" class="add-user" name="newCi" value="<?php if($resultado) echo $resultado['ci_user']; ?>" placeholder="Ingresar Carnet Identidad" style="width: 57%; padding-left: 10px;" minlength="7" required>
              <input type="text" class="add-user" name="newCiext" value="<?php if($resultado) echo $resultado['extci_user']; ?>" placeholder="Ext." style="width: 20%;">
              <input type="text" class="add-user" name="newCiexp" value="<?php if($resultado) echo $resultado['expci_user']; ?>" placeholder="Exp." list="ciudad" style="width: 20%;" required>
              <datalist id="ciudad">
                  <option value="CB">Cochabamba</option>
                  <option value="CH">Chuquisaca</option>
                  <option value="LP">La Paz</option>
                  <option value="OR">Oruro</option>
                  <option value="PT">Potosí</option>
                  <option value="TJ">Tarija</option>
                  <option value="SC">Santa Cruz</option>
                  <option value="BE">Beni</option>
                  <option value="PD">Pando</option>
                </datalist>
            </div>
            <input type="date" class="add-user" name="newBirthdate" value="<?php if($resultado) echo $resultado['birthdate_user']; ?>" placeholder="Ingresar Fecha Nacimiento" required>
            <input type="number" class="add-user" name="newTelephone" value="<?php if($resultado) echo $resultado['telephone_user']; ?>" placeholder="Ingresar Teléfono" minlength="7" required>
            <input type="email" class="add-user" name="newEmail" value="<?php if($resultado) echo $resultado['email_user']; ?>" placeholder="Ingresar Email">
            <input type="text" class="add-user" name="newUser" value="<?php if($resultado) echo $resultado['user_user']; ?>" placeholder="Ingresar Usuario" required>
            <input type="password" class="add-user" name="newPassword" value="<?php if($resultado) echo $resultado['password_user']; ?>" placeholder="Ingresar Password" minlength="6" required>
 
            <input type="number" name="newAccess" value="<?php if($resultado) echo $resultado['access_user']; ?>" placeholder="Ingresar Acceso" list="items" required>
              <datalist id="items">
                <option value="2">administrador</option>
                <option value="1">usuario</option>
              </datalist>
            <button type="submit" name="update" value="update" class="btn">Actualizar</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
