<?php
 require_once("templates/header.php");

 //verifica se o usuario ja esta autenticado
 require_once("models/User.php");
 require_once("dao/UserDao.php");
 require_once("dao/MovieDAO.php");
 

 $user = new User();
 $userDao = new UserDao($conn, $BASE_URL);
 $movieDao = new MovieDao($conn,$BASE_URL);

 $userData = $userDao->verifyToken(true);
 $usermovies = $movieDao->getMoviesByUserId($userData->id);

?>
  <div id="main-container" class="conteiner-fluid">
    <h2 class="section-title">Dashboard</h2>
    <p class="section-description">Adicione ou atualize as informaçoes dos filmes que você enviou</p>
    <div class="col-md-12" id="add-movie-container">
      <a href="<?=$BASE_URL?>newmovie.php" class="btn card-btn">
        <i class="fas fa-plus"></i>Adicionar Filme
      </a>
    </div>
    <div class="col-md-12" id="movies-dashboard">
      <table class="table">
        <thead>
          <th scope="col">#</th>
          <th scope="col">Titulo</th>
          <th scope="col">Nota</th>
          <th scope="col" class="actions-colunm">Ações</th>
        </thead>      
      <tbody>
        <?php foreach($usermovies as $movie): ?>
        <tr>
          <td scope = row><?=$movie->id?></td>
          <td><a href="<?=$BASE_URL?>movie.php?id<?=$movie->id?>" class="table-movie-title"><?=$movie->title?></a></td>
          <td><i class="fas fa-star"></i>9</td>
          <td class="actions-column">
            <a href="<?=$BASE_URL?>editmovie.php?id=<?=$movie->id?>" class="edit-btn">
              <i class="far fa-edit"></i>Editar
            </a>
            <form action="<?=$BASE_URL?>movie_process.php" method="POST">
              <input type="hidden" name="type" value="delete">
              <input type="hidden" name="id" value="<?=$movie->id?>">
              <button type="submit" class="delete-btn">
                <i class="fas a-times"></i>Deletar
              </button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    </div>
  </div>

<?php
  require_once("templates/footer.php");
?>