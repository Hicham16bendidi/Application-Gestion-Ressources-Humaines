<?php
include_once 'conn.php';
include_once 'user.php';
  $PDO = DB_conn();
  session_start();

  if(isset($_GET["id"])) {
    // Get data from the user table based on the ID
    $stm = $PDO->prepare("SELECT * FROM users WHERE ID=?");
    $resl = $stm->execute([$_GET["id"]]);
    $resl = $stm->fetch();
}
$admin = $_SESSION["userData"];
// If the form is submitted
if(isset($_POST['Register'])) {
    // Get the form data
    $id = $_POST['id']; // Assuming ID is passed through a hidden input
    $name = $_POST['Name'];
    $username = $_POST['Username'];
    $password = $_POST['Password'];
    $phone=$_POST['telephone'];
    $email=$_POST['email'];
    $prenom=$_POST['prenom'];
    $depart=$_POST['Departement'];
    $salaire=$_POST['salaire'];
    $poste=$_POST['poste'];
    // Assuming other form fields are here

    // Update the user info in the database
    $stmt = $PDO->prepare("UPDATE users SET Name=?, Username=?, Password=? ,Email=?,Telephone=?,Prenom=? WHERE ID=?");
    $result = $stmt->execute([$name, $username, $password,$email,$phone,$prenom, $id]);
    $stmt = $PDO->prepare("UPDATE employe SET Departement=?, Salaire=?, Poste=? WHERE ID=?");
    $result = $stmt->execute([$depart, $salaire, $poste, $id]);

    if($result) {
        echo "User info updated successfully.";
        header("Location: /rh-app/respopage.php");
    } else {
        echo "Error updating user info.";
    }
}
?>
<!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Admin Sign Up</title>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body> 
    <form action="edituser.php" method="POST">
    <section class="vh-100" style="background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1)">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="box-shadow:3px 3px blue, -1em 0 .4em purple;border-radius: 25px; background: linear-gradient(to right, rgba(100, 10, 100, 100), rgba(37, 117, 252, 1)">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">

                                <div class="col-md-6 mb-4">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="form3Example1c" class="form-control" name="id"
                                                value="<?php echo $resl['ID']; ?>" readonly />
                                            <label class="form-label" for="form3Example1c"></label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="form3Example1c" class="form-control"
                                                name="Name" value="<?php echo $resl['Name']; ?>" required />
                                            <label class="form-label" for="form3Example1c"></label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="username" id="form3Example3c" class="form-control"
                                                name="Username" value="<?php echo $resl["Username"]; ?>"
                                                required />
                                            <label class="form-label" for="form3Example3c"></label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="form3Example4c" class="form-control"
                                                name="Password" value="<?php echo $resl["Password"]; ?>"
                                                required />
                                            <label class="form-label" for="form3Example4c"></label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="password" id="form3Example4cd" class="form-control"
                                                name="Password1" value="<?php echo $resl["Password"]; ?>"
                                                required />
                                            <label class="form-label" for="form3Example4cd"></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="form3Example1c" class="form-control"
                                                name="prenom" 
                                                <?php if (is_null($resl["Telephone"])) { ?>
                                                placeholder="Prénom"
                                                <?php } else { ?>
                                                 value="<?php echo $resl["Prenom"]; ?>"
                                                <?php } ?>
                                               
                                                required />
                                            <label class="form-label" for="form3Example1c"></label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="email" id="form3Example3c" class="form-control"
                                                name="email"
                                                <?php if (is_null($resl["Telephone"])) { ?>
                                                placeholder="E-mail"
                                                <?php } else { ?>
                                                value="<?php echo $resl["Email"]; ?>"
                                                <?php } ?> 
                                                required />
                                            <label class="form-label" for="form3Example3c"></label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                        <input type="number" id="form3Example4c" class="form-control" name="telephone"
                                        <?php if (is_null($resl["Telephone"])) { ?>
                                            placeholder="Telephone"
                                        <?php } else { ?>
                                            value="<?php echo $resl["Telephone"]; ?>"
                                        <?php } ?>
                                        required />
                                            <label class="form-label" for="form3Example4c"></label>
                                        </div>
                                    </div>
                                    <?php if ($resl['user_type'] === NULL && $admin->getusertype() !== NULL) { ?>
                                    <!-- Departement -->
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="form3Example4c" class="form-control" name="Departement" placeholder="Departement" required/>
                                            <label class="form-label" for="form3Example4c"></label>
                                        </div>
                                    </div>

                                    <!-- Poste -->
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="text" id="form3Example4cd" class="form-control" name="poste" placeholder="Poste" required/>
                                            <label class="form-label" for="form3Example4cd"></label>
                                        </div>
                                    </div>

                                    <!-- Salaire -->
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <input type="number" id="form3Example4ce" class="form-control" name="salaire" placeholder="Salaire" required/>
                                            <label class="form-label" for="form3Example4ce"></label>
                                        </div>
                                    </div>
                                <?php } ?>

                                    <div class="col-12">
                                        <p class="fw-bold text-white text-center  mt-5 mb-0">Abandon? <a
                                                href="admnpage.php" class="fw-bold text-body">Cancel</a></p>
                                        <br></br>
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit"
                                                class="btn btn-outline-dark btn-lg px-5" name="Register">Register
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</form>

              
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      
    </body>
  </html>