<?php
require __DIR__ . '/../repositories/userrepository.php';

class UserService
{

    private UserRepository $repository;
    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function getAll() {
        return $this->repository->getAll();
    }
    public function updateOne(User $user){
        $user->setPasswordhash($this->hashPassword($user->getPasswordhash()));
        $this->repository->updateOne($user);
    }
    public function insertOne(User $user){
        $user->setPasswordhash($this->hashPassword($user->getPasswordhash()));
        $this->repository->insertOne($user);
    }

    public function getOneByEmail(string $email){
        return $this->repository->getOneByEmail($email);
    }
    public function getOneByName(string $name){
        return $this->repository->getOneByEmail($name);
    }
    public function getOneById(int $id){
        return $this->repository->getOneByEmail($id);
    }

    private function hashPassword(string $password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function verifyPassword(string $password, string $hashedPassword){
        return password_verify($password, $hashedPassword);
    }
    public function login(string $email, string $password){
        $user = $this->getOneByEmail($email);
        if (!$this->verifyPassword($password, $user->getPasswordhash())){
            return http_response_code(400);
        }
        // do login
        $this->setSession($user);
    }

    private function setSession(User $user){
        // remove password from user object and put it in session['user']
        $user->setPasswordHash('');
        $_SESSION['user'] = $user;
    }

    public function verifySession(){
        $user = $this->getOneById($_SESSION['user']->getId());
        $user->setPasswordHash('');
        if (!$user === $_SESSION['user']){
            return http_redirect('/login?error=Session_corrupted');
        }
    }


}