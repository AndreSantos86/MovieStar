<?php
 class User{
     public $id;
     public $name;
     public $lastname;
     public $email;
     public $password;
     public $image;
     public $bio;
     public $token;

     public function generateToken(){
         return bin2hex(random_bytes(50));
     }
     public function generatePassword($password){
         return password_hash($password, PASSWORD_DEFAULT);
     }

 }

 interface UserDAOInterFace{
     public function buildUser($data); // recebe data 
     public function create(User $user, $authUser = false); // recebe usuario para conseguir fazer login
     public function update(User $user);//atualizar usuario
     public function verifyToken($protected = false); // verifica usuario , rota nao protegida, so redireciona se estiver logado
     public function setTokenToSession($token, $redirect = true);//login , redireciona para pagina especifica
     public function authenticateUser($email, $password);// fazer autenticação completa
     public function findByEmail($email); // buscar por email
     public function findByToken($token); // buscar usuario por token
     public function findById($id);// buscar usuario por id
     public function changePassword(User $user); // metodo para troca de senha
 }
?>