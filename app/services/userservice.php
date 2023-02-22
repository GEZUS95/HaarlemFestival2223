<?php
namespace services;

use repositories\UserRepository;
use repositories\RoleRepository;
use models\User;

class UserService
{

    private UserRepository $repository;
    private RoleRepository $roleRepository;

    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->roleRepository = new RoleRepository();
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
        $passwordHash = $this->hashPassword($user->getPasswordhash());
        $this->repository->insertOne($user->getRoleId(),$user->getName(),$user->getEmail(),$passwordHash);
    }

    public function getOneByEmail(string $email)
    {
        return $this->repository->getOneByEmail($email);
    }

    public function getOneByName(string $name)
    {
        return $this->repository->getOneByName($name);
    }

    public function getOneById(int $id): User
    {
        return $this->repository->getOneById($id);
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

    public function checkPermissions(string $roleName): bool
    {
        $this->verifySession();
        $role = $this->roleRepository->getOneById($_SESSION['user']['role_id']);
        if ($role->getName() !== $roleName) {
            return false;
        }
        return true;
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
        $this->redirect('/?success=You have been successfully logged out');
    }

    public function redirect(string $url): void
    {
        header("Location: $url", true);
        die;
    }

    public function resetPassword(string $uuid, string $newpassword, string $newpasswordcheck)
    {
        // todo: Check if uuid is correct with the user it issued

        if ($newpassword !== $newpasswordcheck) {
            $this->redirect('/user/resetpassword?passwords does not match');
        }
        $user->setPasswordhash($newpassword);
        $this->updateOne($user);
    }

    public function register(string $name, string $email, string $emailVerify, string $password, string $passwordVerify)
    {
        if ($email !== $emailVerify) {
            $this->redirect('/register?error=email does not match');
        }

        $this->checkNameAndEmail($name, $email);

        if ($password !== $passwordVerify) {
            $this->redirect('/register?error=passwords does not match');
        }

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPasswordhash($password);
        $user->setRoleId(1);

        $this->insertOne($user);

        $this->redirect('/login?success=You have successfully registered');
    }
    public function deleteOne($userId): void
    {
        $this->repository->deleteOne($userId);
        $this->redirect('/admin/users?success=You successfully deleted user');
    }


// Private Functions
    private function setSession(User $user): void
    {
        // remove password from user object and put it in session['user']
        $user->setPasswordhash('');
        $_SESSION['user']['id'] = $user->getId();
        $_SESSION['user']['name'] = $user->getName();
        $_SESSION['user']['email'] = $user->getEmail();
        $_SESSION['user']['password'] = $user->getPasswordhash();
        $_SESSION['user']['role_id'] = $user->getRoleId();
        $_SESSION['user']['created'] = $user->getCreatedAt();
    }

    private function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function verifyPassword(string $password, string $hashedPassword): bool
    {
        return password_verify($password, $hashedPassword);
    }

    private function getUserFromSession(): User
    {
        $user = new  User();

        $user->setId($_SESSION['user']['id']);
        $user->setName($_SESSION['user']['name']);
        $user->setEmail($_SESSION['user']['email']);
        $user->setPasswordhash($_SESSION['user']['password']);
        $user->setRoleId($_SESSION['user']['role_id']);
        $user->setCreatedAt($_SESSION['user']['created']);

        return $user;
    }

    private function verifySession(): void
    {
        $user = $this->getOneById($_SESSION['user']['id']);
        $user->setPasswordHash('');
        if (!$user == $this->getUserFromSession()) {
            $this->redirect('/login?error=Session_corrupted');
        }
    }

    private function checkNameAndEmail(string $name, string $email)
    {
        $username = $this->getOneByName($name);
        $useremail = $this->getOneByEmail($email);

        if ($username) {
            $this->redirect('/register?error=Name already in use');
        } elseif ($useremail) {
            $this->redirect('/register?error=Email already in use');
        }
    }
}
