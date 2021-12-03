<?php
require_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('pages');
$twig = new \Twig\Environment($loader);
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo $twig->render('Login.html', array());
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['pass']);

    include('ConnectDB.php');
    $user = $SQLCONN->query("select * from users where email = '$email' limit 1")->fetch_assoc();
    if($user){
        $pass = explode('@', $user['password']);
        if ($pass[1] == sha1($password.$pass[0])){
//            echo "Welcome ".$user['username'];
            header('Location: /');
        }
        else{
            echo $twig->render('Login.html', array('notfound' => true));
            $SQLCONN->close();
            exit();
        }
    }
    else {
        echo $twig->render('Login.html', array('notfound' => true));
        $SQLCONN->close();
        exit();
    }
}
?>

