<?php
 require_once("templates/header.php");
 require_once("dao/UserDao.php");

 $userDao = new UserDao($conn, $BASE_URL);
 $userData = $userDao->verifyToken();
?>
    <div id="main-container" class="container-fluid">
        <h1>Edição de Perfil</h1>
    </div>

<?php
 require_once("templates/footer.php");
?> 