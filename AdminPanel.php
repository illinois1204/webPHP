<?php
require_once 'vendor/autoload.php';
$loader = new \Twig\Loader\FilesystemLoader('pages');
$twig = new \Twig\Environment($loader);
$template = $twig->loadTemplate('AdminPanel.html');


include('ConnectDB.php');
$genre = [];
$result_genr = $SQLCONN->query("select * from genre");
while ($r = mysqli_fetch_object($result_genr)){
    $genre[]=$r;
}
$Session = (isset($_COOKIE['RequestSessionIWP']) and $_COOKIE['RequestSessionIWP'] != '');

echo $template->render(array('session' => $Session, 'genres' => $genre));


?>