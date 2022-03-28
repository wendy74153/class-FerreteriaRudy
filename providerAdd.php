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
            <h2>DATOS PROVEEDOR</h2>
            <br>
            <input type="text" class="add-user" name="newName" value="" placeholder="Ingresar Razón Social" required>
            <input type="number" class="add-user" name="newNit" value="" placeholder="Ingresar NIT" required>
            <input type="text" class="add-user" name="newCategoria" value="" placeholder="Ingrese Categoría" list="categoria" required>
              <datalist id="categoria">
                  <option value="1">MATERIAL DE CONSTRUCCION</option>
                  <option value="2">MATERIAL DE ELECTRICIDAD</option>
                  <option value="3">MAQUINARIAS DE CONSTRUCCION Y ELECTRICIDAD</option>
                  <option value="4">MATERIALES DE PINTURA</option>
                  <option value="5">MATERIALES DE CARPINTERIA</option>
                  <option value="6">MAQUINARIAS DE PINTURA Y CARPINTERIA</option>
                  <option value="7">MATERIALES DE PLOMERIA</option>
                  <option value="8">MATERIALES DE SOLDADURA</option>
                  <option value="9">MATERIALES DE PLOMERIA Y SOLDADURA</option>
                </datalist>

            <input type="number" class="add-user" name="newTelephone" value="" placeholder="Ingresar Teléfono" minlength="7" required>
            <input type="email" class="add-user" name="newEmail" value="" placeholder="Ingresar Email">

            <button type="submit" name="addprovider" class="btn btn-user">AGREGAR PROVEEDOR</button>
          </form>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
