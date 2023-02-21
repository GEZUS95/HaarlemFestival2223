<?php
require __DIR__ . '/../repositories/userrepository.php';
require __DIR__ . '/../repositories/rolerepository.php';

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
        $user->setPasswordhash($this->hashPassword($user->getPasswordhash()));
        $this->repository->insertOne($user);
    }

    public function getOneByEmail(string $email): User
    {
        return $this->repository->getOneByEmail($email);
    }

    public function getOneByName(string $name): User
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

    public function checkPermissions(string $role_name): bool
    {
        $this->verifySession();
        $role = $this->roleRepository->getOneById($_SESSION['user']['role_id']);
        if ($role->getName() !== $role_name) {
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
        header("Location: $url");
    }

    public function resetPassword(string $oldpassword, string $newpassword, string $newpasswordcheck)
    {
        if ($this->checkPermissions('admin') || $this->checkPermissions('super-admin')) {
            //get user id
            $user = $this->getOneById($givenId);
        } else {
            $user = $this->getUserFromSession();
        }
        if ($user->getPasswordhash() !== $oldpassword) {
            $this->redirect('/user/resetpassword?password incorrect');
        }
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

        $this->insertOne($user);
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
        return new  User(
            $_SESSION['user']['id'],
            $_SESSION['user']['name'],
            $_SESSION['user']['email'],
            $_SESSION['user']['password'],
            $_SESSION['user']['role_id']
        );
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
