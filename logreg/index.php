<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MVC Skeleton</title>
    </head>
    <body>
        <?php
    require_once('connection.php');// database connection in a class
        
    if (isset($_GET['controller']) && isset($_GET['action'])) { //if the values are set(in this case in the URL), the function takes the value from the variables), if the parameter exits in the URL, $_GET array takes the values from the parameter 
        $controller = $_GET['controller'];// assigning a value to the variable
        $action     = $_GET['action'];//as above
  } else {
        $controller = 'pages';//if the values are not set then it should stay on the Home page 
        $action     = 'home';
  }

    require_once('C:\xampp\htdocs\logreg\layout.php');// HTML layout page (landing page)
        ?>
    </body>
</html>
