<?php
  session_start();
  if(!isset($_SESSION['key'])){
    header('location: login.html');
  }
  else{
    if($_SESSION['key'] != 2){
      header('location: login.html');
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
          <div class="">

          
          <form class="form-add" action="function.php" method="POST">
            <h2>DATOS USUARIO</h2>
            <br>
            <input type="text" class="add-user" name="newName" value="" placeholder="Ingresar Nombre" required>
            <input type="text" class="add-user" name="newSurname" value="" placeholder="Ingresar Apellidos" required>
            <div class="form-ci">
              <input type="number" class="add-user" name="newCi" value="" placeholder="Ingresar Carnet Identidad" style="width: 57%; padding-left: 10px;" minlength="7" required>
              <input type="text" class="add-user" name="newCiext" value="" placeholder="Ext." style="width: 20%;">
              <input type="text" class="add-user" name="newCiexp" value="" placeholder="Exp." list="ciudad" style="width: 20%;" required>
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
            <input type="date" class="add-user" name="newBirthdate" value="" placeholder="Ingresar Fecha Nacimiento" required>
            <input type="number" class="add-user" name="newTelephone" value="" placeholder="Ingresar Teléfono" minlength="7" required>
            <input type="email" class="add-user" name="newEmail" value="" placeholder="Ingresar Email">
            <input type="text" class="add-user" name="newUser" value="" placeholder="Ingresar Usuario" required>
            <input type="password" class="add-user" name="newPassword" value="" placeholder="Ingresar Password" minlength="6" required>
 
            <input type="number" name="newAccess" value="" placeholder="Ingresar Acceso" list="items" required>
              <datalist id="items">
                <option value="2">administrador</option>
                <option value="1">usuario</option>
              </datalist>

            <button type="submit" name="add" class="btn btn-user">AGREGAR USUARIO</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
