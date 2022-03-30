<?php
  require_once("templates/header.php");
  //verifica se o usuario ja esta autenticado
  require_once("models/Movie.php");
  require_once("dao/MovieDAO.php");

  $id = filter_input(INPUT_GET,"id");
  $movie;
  $movieDao = new MovieDAO($conn, $BASE_URL);

  if (empty($id)){
    $message->setMessage("O filme não foi encontrado!","error","index.php");
  }else{
    $movie = $movieDao->findById($id);

    //Verifica de o filme existe
    if(!$movie){
      $message->setMessage("O filme nao foi encontrado!","error","index.php");
    }
  }
  //checar se o filme tem imagem
  if($movie->image == ""){
    $movie->image = "movie_cover.jpg";
  }

  // checar se o filme e do usuario
  $userOwnsMovie = false;
  if(!empty($userData)){
    if($userData->id === $movie->users_id){
      $userOwnsMovie= true;
    }
  } // resgatar reviews do filme
  $alreadyReviewed = false;
?>
<div id="main-container" class="conteiner-fluid">
  <div class="row">
    <div class="offset-md-1 col-md-6 movie-container">
      <h1 class="page-title"><?=$movie->title?></h1>
      <p class="movie-details">
        <span>Duração: <?=$movie->length?></span>
        <span class="pipe"></span>
        <span><?=$movie->category?></span>
        <span class="pipe"></span>
        <span><i class="fas fa-star"></i>9</span>
      </p>
      <iframe src="<?=$movie->trailer?>" width="560" height="315" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
      <p><?=$movie->description?></p>
    </div>
    <div class="col-md-4">
      <div class="movie-image-container" style="background-image: url('<?=$BASE_URL?>/img/movies/<?=$movie->image?>')"></div>
    </div>
    <div class="offset-md-1 col-md-10" id="reviews-container">
      <h3 id="reviews-title">Avaliações:</h3>
      <!-- Verificar se habilita a review para o usuario ou nao -->
      <?php if(!empty($userData) && !$userOwnsMovie && !$alreadyReviewed): ?>
      <div class="col-md-12" id="review-form-container">
        <h4>Envie sua avaliação:</h4>
        <p class="page-description">Preencha o formulario com a nota e comentário sobre o filme</p>
        <form action="<?=$BASE_URL?>review_process.php" id="review-form" method="POST">
          <input type="hidden" name="type" value="create">
          <input type="hidden" name="movies_id" value="<?=$movie->id?>">
          <div class="form-group">
            <label for="rating">Nota do filme:</label>
            <select name="rating" id="rating" class="form-control">
              <option value="">selecione</option>
              <option value="10">10</option>
              <option value="9">9</option>
              <option value="8">8</option>
              <option value="7">7</option>
              <option value="6">6</option>
              <option value="5">5</option>
              <option value="4">4</option>
              <option value="3">3</option>
              <option value="2">2</option>
              <option value="1">1</option>
            </select>
          </div>
          <div class="form-group">
            <label for="review">Seu comentário:</label>
            <textarea name="review" id="review"  rows="3" class="form-control" placeholder="Oque voce achou do filme?"></textarea>
          </div>
          <input type="submit" value="Enviar comentário" class="btn card-btn">
        </form>
      </div>
      <?php endif; ?>
      <!--Comentarios-->
      <div class="col-md-12 review">
        <div class="row">
          <div class="col-md-1">
            <div class="profile-image-container review-image" style="background-image: url('<?=$BASE_URL?>img/users/user.png')"></div>
          </div>
          <div class="col-md-9 author-details-container">
            <h4 class="author-name">
              <a href="#">Andre</a>
            </h4>
            <p><i class="fas fa-star"></i>9</p>
          </div>
          <div class="col-md-12">
            <p class="comment-title">Comentário:</p>
            <p>Este é o comentario do usuário</p>
          </div>
        </div>
      </div>
      <div class="col-md-12 review">
        <div class="row">
          <div class="col-md-1">
            <div class="profile-image-container review-image" style="background-image: url('<?=$BASE_URL?>img/users/user.png')"></div>
          </div>
          <div class="col-md-9 author-details-container">
            <h4 class="author-name">
              <a href="#">Andre</a>
            </h4>
            <p><i class="fas fa-star"></i>9</p>
          </div>
          <div class="col-md-12">
            <p class="comment-title">Comentário:</p>
            <p>Este é o comentario do usuário</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  require_once("templates/footer.php");
?>
https://youtu.be/9oISQcXuki0