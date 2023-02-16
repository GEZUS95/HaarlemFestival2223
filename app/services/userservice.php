<?php
require __DIR__ . '/../repositories/userrepository.php';

class UserService
{
    private UserRepository $repository;

    public function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function getAll(): false|array|null
    {
        return $this->repository->getAll();
    }

    public function updateOne(User $user): void
    {
        $user->setPasswordhash($this->hashPassword($user->getPasswordhash()));
        $this->repository->updateOne($user);
    }

    public function insertOne(User $user): void
    {
        $user->setPasswordhash($this->hashPassword($user->getPasswordhash()));
        $this->repository->insertOne($user);
    }

    public function getOneByEmail(string $email): User
    {
        return $this->repository->getOneByEmail($email);
    }

    public function getOneByName(string $name): User
    {
        return $this->repository->getOneByEmail($name);
    }

    public function getOneById(int $id): User
    {
        return $this->repository->getOneByEmail($id);
    }

    public function login(string $email, string $password): void
    {
        session_unset();
        $user = $this->getOneByEmail($email);
        if (!$user) {
            $this->redirect('/login?error=user not found');
        }
        if (!$this->verifyPassword($password, $user->getPasswordHash())) {
            $this->redirect('/login?error=passwords does not match');
        }
        // do login
        $this->setSession($user);
        //redirect to home page
        $this->redirect('/?success=you have been successfully logged in');
    }

    public function verifySession(): void
    {
        $user = $this->getOneById($_SESSION['user']->getId());
        $user->setPasswordHash('');
        if (!$user === $_SESSION['user']) {
            $this->redirect('/login?error=Session_corrupted');
        }
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        $this->redirect('/?success=You have been successfully logged out');
    }

    // Private Functions
    private function redirect(string $url): void
    {
        header("Location: $url");
    }

    private function setSession(User $user): void
    {
        // remove password from user object and put it in session['user']
        $user->setPasswordhash('');
        $_SESSION['user']['id'] = $user->getId();
        $_SESSION['user']['name'] = $user->getName();
        $_SESSION['user']['email'] = $user->getEmail();
        $_SESSION['user']['roleId'] = $user->getRoleId();
    }

    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function verifyPassword(string $password, string $hashedPassword): bool
    {
        return password_verify($password, $hashedPassword);
    }
}