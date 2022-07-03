<!doctype html>
<html>
<head>
    <script src="API_crud.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
</head>
<body>
<form id="loginform" method="post">
    <div>
        Username:
        <input type="text" name="username" id="username" />
        Password:
        <input type="password" name="password" id="password" />    
        <input type="submit" name="loginBtn" id="loginBtn" value="Login" />
    </div>
</form>

<div id="container"></div>

<script type="text/javascript">
$(document).ready(function() {
    $('#loginform').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'login.php',
            data: $(this).serialize(),
            success: function(response)
            {
                //console.log(response);
                var jsonData = JSON.parse(response);
                // user is logged in successfully in the back-end
                // let's redirect
                if (jsonData.success == "1")
                {
                    console.log(true);
                    //location.href = 'my_profile.php';
                }
                else
                {
                    alert('Invalid Credentials!');
                }
           }
       });
     });
});
</script>
</body>
</html>

<!-- 
serialize() convierte los datos de los input del form, o checks seleccionados, en un string 
ya que lo que recibe y envia el servidor siempre es string

Los datos enviados con serialize se obtienen llamando de forma normal a $_POST["username"] o $_GET

---PARA CONVERTIR A JSON
    JSON.parse() convierte el string en un objeto JSON
    json_encode(array('success' => 1)) convierte lo de adentro (array u objeto) en JSON
-->

<?php
/* 
$myObj = new stdClass(); //para crear un objeto vacio
$myObj->name = "John";
$myObj->age = 30;
$myObj->city = "New York";

$myJSON = json_encode($myObj);

echo $myJSON;
*/

?>