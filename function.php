<?php
session_start();
include_once 'php/connection.php';
$database = new Connection();
$db = $database->open();
$query = "";
$output = "";


if(isset($_GET['itemDelete'])){
  $id=(int) $_GET['itemDelete'];

  $queryLevel = "DELETE FROM mtconstruccion WHERE id_mt='".$id."' LIMIT 1";
  $resultLevel = $db->query($queryLevel);
  $resultLevel->execute();

  header('Location: user.php');
}

if(isset($_GET['userDelete'])){
  $id=(int) $_GET['userDelete'];

  $queryLevel = "DELETE FROM users WHERE id_user='".$id."' LIMIT 1";
  $resultLevel = $db->query($queryLevel);
  $resultLevel->execute();

  header('Location: admin.php');
}

if(isset($_GET['providerDelete'])){
  $id=(int) $_GET['providerDelete'];

  $queryLevel = "DELETE FROM providers WHERE id_provider='".$id."' LIMIT 1";
  $resultLevel = $db->query($queryLevel);
  $resultLevel->execute();

  header('Location: provider.php');
}

if(isset($_POST['add'])){
  $name = $_POST['newName'];
  $surname = $_POST['newSurname'];
  $ci = $_POST['newCi'];
  $ciext = $_POST['newCiext'];
  $ciexp = $_POST['newCiexp'];
  $birthdate = $_POST['newBirthdate'];
  $telephone = $_POST['newTelephone'];
  $email = $_POST['newEmail'];
  $user = $_POST['newUser'];
  $password = $_POST['newPassword'];
  $access = $_POST['newAccess'];

  $queryCi = "SELECT * FROM users WHERE ci_user='".$ci."'";
  $resultCi = $db->query($queryCi);
  $resultCi->execute();

  $queryUser = "SELECT * FROM users WHERE user_user='".$user."'";
  $resultUser = $db->query($queryUser);
  $resultUser->execute();

  if ($resultCi->rowCount() > 0 || $resultUser->rowCount() > 0) {
    if($resultUser->rowCount() > 0){
      echo "<script languaje='javascript'>alert('Este nombre usuario ya existe.'); location.href = 'admin.php';</script>";
    }
    else{
      echo "<script languaje='javascript'>alert('Esta cuenta ya existe, contactarse con un administrador si tiene problemas para conectarse.'); location.href = 'admin.php';</script>";
    }

  }
  else {
    $sql = "INSERT INTO users (name_user, surname_user, ci_user, extci_user, expci_user, birthdate_user, telephone_user, email_user, user_user, password_user, access_user, state_user)
            VALUES ('".$name."', '".$surname."', '".$ci."', '".$ciext."', '".$ciexp."', '".$birthdate."', '".$telephone."', '".$email."', '".$user."', '".$password."', '".$access."', 'habilitado')";

    $db->exec($sql);
    echo "<script languaje='javascript'>alert('Usuario agregado correctamente.'); location.href = 'admin.php';</script>";
  }
}

if(isset($_POST['addprovider'])){
  $name = $_POST['newName'];
  $nit = $_POST['newNit'];
  $categoria = $_POST['newCategoria'];
  $telephone = $_POST['newTelephone'];
  $email = $_POST['newEmail'];

  $queryCi = "SELECT * FROM providers WHERE nit_provider='".$nit."'";
  $resultCi = $db->query($queryCi);
  $resultCi->execute();

  $queryUser = "SELECT * FROM providers WHERE name_provider='".$name."'";
  $resultUser = $db->query($queryUser);
  $resultUser->execute();

  if ($resultCi->rowCount() > 0 || $resultUser->rowCount() > 0) {
    if($resultUser->rowCount() > 0){
      echo "<script languaje='javascript'>alert('Este nombre usuario ya existe.'); location.href = 'admin.php';</script>";
    }
    else{
      echo "<script languaje='javascript'>alert('Esta cuenta ya existe, contactarse con un administrador si tiene problemas para conectarse.'); location.href = 'admin.php';</script>";
    }

  }
  else {
    $sql = "INSERT INTO providers (categoria_provider, name_provider, nit_provider, telephone_provider, email_provider)
            VALUES ('".$categoria."', '".$name."', '".$nit."', '".$telephone."', '".$email."')";

    $db->exec($sql);
    echo "<script languaje='javascript'>alert('proveedor agregado correctamente.'); location.href = 'provider.php';</script>";
  }
}

if(isset($_POST['additem'])){
  $name = $_POST['newName'];
  $desc = $_POST['newDesc'];
  $precio = $_POST['newPrecio'];
  $stock = $_POST['newStock'];
  $peso = $_POST['newPeso'];
  $fecha = $_POST['newFecha'];
  $medida = $_POST['newMedida'];


  $queryCi = "SELECT * FROM mtconstruccion WHERE id_mt='".$ci."'";
  $resultCi = $db->query($queryCi);
  $resultCi->execute();

  $queryUser = "SELECT * FROM mtconstruccion WHERE name_mt='".$user."'";
  $resultUser = $db->query($queryUser);
  $resultUser->execute();

  if ($resultCi->rowCount() > 0 || $resultUser->rowCount() > 0) {
    if($resultUser->rowCount() > 0){
      echo "<script languaje='javascript'>alert('Este nombre producto ya existe.'); location.href = 'user.php';</script>";
    }
    else{
      echo "<script languaje='javascript'>alert('Este producto ya existe.'); location.href = 'user.php';</script>";
    }

  }
  else {
    $sql = "INSERT INTO mtconstruccion (name_mt, desc_mt, precio_mt, stock_mt, peso_mt, fecha_mt, medida_mt)
            VALUES ('".$name."', '".$desc."', '".$precio."', '".$stock."', '".$peso."', '".$fecha."', '".$medida."')";

    $db->exec($sql);
    echo "<script languaje='javascript'>alert('Producto agregado correctamente.'); location.href = 'user.php';</script>";
  }
}


if(isset($_POST["cilook"]) || isset($_POST["habilitados"]) || isset($_POST["deshabilitados"])){
  if(isset($_POST["cilook"])){
    $query = "SELECT * FROM users WHERE ci_user ='".$_POST["cilook"]."' ";
  }
  if(isset($_POST["habilitados"])){
    $query = "SELECT * FROM users WHERE state_user ='habilitado' ";
  }
  if(isset($_POST["deshabilitados"])){
    $query = "SELECT * FROM users WHERE state_user ='deshabilitado' ";
  }

  $result = $db->query($query);
  $output .= '
              <table class="content-table">
                <thead>
                  <tr class="active-row">
                    <th class="bg-primary" scope="col">USUARIO</th>
                    <th class="bg-primary" scope="col">PASSWORD</th>
                    <th class="bg-primary" scope="col">NOMBRE</th>
                    <th class="bg-primary" scope="col">CI</th>
                    <th class="bg-primary" scope="col">ACCESO</th>
                    <th class="bg-primary" scope="col">ESTADO</th>
                    <th class="bg-primary" scope="col">OPCIONES</th>
                  </tr>
                </thead>
     ';
     if($result->rowCount() > 0)
     {
       $value = '';
          while($res = $result->fetch(PDO::FETCH_BOTH))
          {
            if($res["state_user"] == 'habilitado'){
              $value= "Deshabilitar";
            }
            else{
              $value= "Habilitar";
            }
               $output .= '
               <tbody>
                    <tr>
                         <td>'. $res["user_user"] .'</td>
                         <td>'. $res["password_user"] .'</td>
                         <td>'. $res["name_user"] . ''. " " .''. $res["surname_user"] .'</td>
                         <td>'. $res["ci_user"] .'</td>
                         <td>'. $res["access_user"] .'</td>
                         <td>'. $res["state_user"] .'</td>
                         <td>
                           <a href="admin.php?userState='.$res['id_user'].'" class="btnAction btn btn-info">
                             '.$value.'
                           </a>
                           <a href="adminUpdate.php?userList='.$res['id_user'].'" class="btn">Editar</a>
                           <a href="function.php?userDelete='.$res['id_user'].'" class="btn">Eliminar</a>
                        </td>
                    </tr>
                  </tbody>
               ';
          }
     }
     else
     {
          $output .= '
               <tr>
                    <td colspan="8" style="text-align:center;">Datos no encontrados</td>
               </tr>
          ';
     }
     $output .= '</table>';
     echo $output;
   }
 ?>
