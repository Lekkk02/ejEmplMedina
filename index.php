<?php 
session_start();
$arrayEmpl = [];
$arrayTest = [];
if(isset($_SESSION['EmplBackup'])){
  $arrayEmpl = $_SESSION['EmplBackup'];

}
if(isset($_POST['destroy'])){
  session_destroy();
  header("Location: index.php");
}
class Empleado {
    public $nombre_Emp;
    public $apellido_Emp;
    public $edad_Emp;
    public $civil_Emp;
    public $sexo_Emp;
    public $sueldo_Emp;
    public function __construct($nombre,$apellido,$edad, $civil, $sexo, $sueldo){ 
      $this->nombre_Emp = $nombre;
      $this->apellido_Emp = $apellido;
      $this->edad_Emp = $edad;
      $this->civil_Emp = $civil;
      $this->sexo_Emp = $sexo;
      $this->sueldo_Emp = $sueldo;
    }
    public function getNombre(){
      return $this->nombre_Emp;
    }    
     public function getApellido(){
        return $this->apellido_Emp;
      }        public function getSueldo(){
        return $this->sueldo_Emp;
      }    
      public function getSexo(){
        return $this->sexo_Emp;
      }        public function getCivil(){
        return $this->civil_Emp;
      } 
      public function getEdad(){
        return $this->edad_Emp;   
    }    
      
  }
  

    if((isset($_POST['txtNombre']) && isset($_POST['txtApellido']) && isset($_POST['txtEdad'])) && (isset($_POST['txtCivil']) && isset($_POST['txtSexo'])  && isset($_POST['txtSueldo']))){
        if((!empty($_POST['txtNombre']) && !empty($_POST['txtApellido']) && !empty($_POST['txtEdad'])) && (!empty($_POST['txtCivil']) && !empty($_POST['txtSexo'])  && !empty($_POST['txtSueldo']))){
            $nombre = $_POST['txtNombre'];
            $apellido = $_POST['txtApellido'];
            $edad = $_POST['txtEdad'];
            $civil = $_POST['txtCivil'];
            $sexo = $_POST['txtSexo'];
            $sueldo = $_POST['txtSueldo'];

            $arrayTest = new Empleado($nombre,$apellido, $edad, $civil, $sexo, $sueldo);
            array_push($arrayEmpl, $arrayTest);
            $_SESSION['EmplBackup'] = $arrayEmpl;  


        }else{

        }
    }



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registro Empleadosw</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <link href="styles.css" rel="stylesheet" />
  </head>
  <body>
    <section>
      <nav class="navbar center">
        <div class="container">
          <div class="item">
            <a href="<?php echo $_SERVER['PHP_SELF'] ?>" class="nav-link">Inicio</a>
          </div>
          <div class="item">
            <a href="#stats" class="nav-link">Estadisticas</a>
          </div>
        </div>
      </nav>
    </section>

    <main class="mainSec">
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="form-group">
          <div class="row">
            <div class="col">
              <input
                type="text"
                class="form-control"
                placeholder="Nombre"
                name="txtNombre"
              />
            </div>
            <div class="col">
              <input
                type="text"
                class="form-control"
                placeholder="Apellido"
                name="txtApellido"
                
              />
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEdad">Edad</label>
          <input
            type="number"
            class="form-control"
            placeholder="Edad"
            min="18"
            max="65"
            name="txtEdad"
          />
        </div>
        <div class="form-group">
          <label for="estadoCivil">Estado civil</label>
          <select
            class="form-control"
            name="txtCivil"
          >
            <option>Soltero</option>
            <option>Casado</option>
            <option>Viudo</option>
            <option>Es complicado</option>
          </select>
        </div>
        <div class="form-group">
          <label for="inputSexo">Sexo</label>
          <select
            class="form-control"
            name="txtSexo"
          >
            <option>Masculino</option>
            <option>Femenino</option>
          </select>
        </div>
        <div class="form-group">
            <label for="inputSueldo">Sueldo</label>
            <select
              class="form-control"
              name="txtSueldo"
            >
              <option value="1000">Menos de 1000 Bs</option>
              <option value="1500">Entre 1000 y 2500 Bs</option>
              <option value="2500">Más de 2500Bs</option>
            </select>
          </div>
         

        <button
          type="submit"
          class="btn btn-primary"
          name="btn"
        >
          Registrar
        </button>
        <button
          type="submit"
          class="btn btn-secondary"
          name="destroy"
        >
          Borrar Registros
        </button>
      </form>

      <div id="table">
        <h1 class='my-4'>Lista de empleados</h1>
      <table class="table table-bordered my-2">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Apellido</th>
      <th scope="col">Sexo</th>
      <th scope="col">Estado Civil</th>
    </tr>
  </thead>
  <tbody>
  <?php 
      foreach($arrayEmpl as $empleado){
        echo "<tr>";
        echo "<td>", $empleado->getNombre(), "</td>";
        echo "<td>", $empleado->getApellido(), "</td>";
        echo "<td>", $empleado->getSexo(), "</td>";
        echo "<td>", $empleado->getCivil(), "</td>";

        echo "</tr>";
      }
      
      ?>

  </tbody>
</table>
      </div>
    </main>

    <section id="stats">
      <h1>Estadisticas</h1>
      <div id="table">
      <table class="table table-bordered my-2">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Total empleados femeninos</th>
      <th scope="col">Hombres casados con sueldo mayor a 2500Bs</th>
      <th scope="col">Viudas con sueldo mayor a 1000Bs</th>
      <th scope="col">Edad promedio hombres</th>
    </tr>
    <tr>
    <?php 
      $cantFem = 0;
      $cantHCS2500 = 0;
      $cantFemViuda = 0;
      $cantH = 0;
      $edadPromedioH = 0;
      foreach($arrayEmpl as $empleado){ 
        if($empleado->getSexo() == "Femenino"){
          $cantFem += 1;
        }
        if($empleado->getCivil() == "Casado" && $empleado->getSueldo() == "2500"){
          $cantHCS2500 += 1;
        }
        if($empleado->getCivil() == "Viudo" && $empleado->getSexo() == "Femenino" && ($empleado->getSueldo() == "1500" || $empleado->getSueldo() == "2500")){
          $cantFemViuda += 1;
        }
        if($empleado->getSexo() == "Masculino"){
          $cantH += 1;
          $edadPromedioH += $empleado->getEdad();
        }
      }

      echo "<td>";
      echo $cantFem;
      echo "</td>";
      echo "<td>";
      echo $cantHCS2500;
      echo "</td>";
      echo "<td>";
      echo $cantFemViuda;
      echo "</td>";
      echo "<td>";
      try{
        echo $edadPromedioH/$cantH;
      }catch(DivisionByZeroError){
        echo "0";
      }

      echo "</td>";
      ?>

    </tr>
 
  </thead>
  <tbody>


  </tbody>
</table>
    </section>
    <script src="js/index.js"></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
