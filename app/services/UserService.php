<?php

namespace services;

use helpers\RedirectHelper;
use repositories\UserRepository;
use repositories\RoleRepository;
use models\User;

class UserService
{

    private UserRepository $repository;
    private RoleRepository $roleRepository;
    private PasswordResetService $passwordResetService;
    private RedirectHelper $redirectHelper;

    public function __construct()
    {
        $this->repository = new UserRepository();
        $this->roleRepository = new RoleRepository();
        $this->passwordResetService = new PasswordResetService();
        $this->redirectHelper = new RedirectHelper();
    }

    public function getAll(): false|array|null
    {
        return $this->repository->getAll();
    }

    public function updateOne(User $user): void
    {
        $this->repository->updateOne(
            $user->getName(),
            $user->getEmail(),
            $user->getRoleId(),
            $user->getId()
        );
    }

    public function insertOne(User $user): void
    {
        $passwordHash = $this->hashPassword($user->getPasswordhash());
        $this->repository->insertOne($user->getRoleId(), $user->getName(), $user->getEmail(), $passwordHash);
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
            $this->redirectHelper->redirect('/login?error=user not found');
        }
        if (!$this->verifyPassword($password, $user->getPasswordHash())) {
            $this->redirectHelper->redirect('/login?error=passwords does not match');
        }
        // do login
        $this->setSession($user);
        //redirect to home page
        $this->redirectHelper->redirect('/?success=you have been successfully logged in');
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
        $this->redirectHelper->redirect('/?success=You have been successfully logged out');
    }

    public function resetPassword(string $uuid, string $newpassword, string $newpasswordcheck)
    {
        if ($newpassword !== $newpasswordcheck) {
            $this->redirectHelper->redirect('/resetpassword?error=passwords does not match');
        }
        $userId = $this->passwordResetService->getOneWithUuid($uuid)['user_id'];

        $user = $this->getOneById($userId);

        $user->setPasswordhash($this->hashPassword($newpassword));

        $this->updatePassword($user);

        $this->passwordResetService->deleteOne($uuid);

        $this->redirectHelper->redirect('/login?success=Password is successfully reset!');
    }

    public function register(string $name, string $email, string $emailVerify, string $password, string $passwordVerify)
    {
        if ($email !== $emailVerify) {
            $this->redirectHelper->redirect('/register?error=email does not match');
        }

        $this->checkName($name, 'register');
        $this->checkEmail($email, 'register');

        if ($password !== $passwordVerify) {
            $this->redirectHelper->redirect('/register?error=passwords does not match');
        }

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPasswordhash($password);
        $user->setRoleId(1);

        $this->insertOne($user);

        $this->redirectHelper->redirect('/login?success=You have successfully registered');
    }

    public function update(string $name, string $email, string $emailVerify, int $id)
    {
        if ($email !== $emailVerify) {
            $this->redirectHelper->redirect('/user/update?error=email does not match');
        }

        $user = $this->getOneById($id);

        if ($name !== $user->getName()) {
            $this->checkName($name, 'user/update');
            $user->setName($name);
        }

        if ($email !== $user->getEmail()) {
            $this->checkEmail($email, 'user/update');
            $user->setEmail($email);
        }

        $this->updateOne($user);
        $this->setSession($user);

        $this->redirectHelper->redirect('/user/update?success=You have successfully updated your information');
    }


    public function deleteOne($userId): void
    {
        $this->repository->deleteOne($userId);
        $this->redirectHelper->redirect('/admin/users?success=You successfully deleted user');
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

    public function getUserFromSession(): User
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

    public function verifySession(): void
    {
        $user = $this->getOneById($_SESSION['user']['id']);
        $user->setPasswordHash('');
        if (!$user == $this->getUserFromSession()) {
            $this->redirectHelper->redirect('/login?error=Session_corrupted');
        }
    }

    private function checkEmail(string $email, string $uri)
    {
        $user = $this->getOneByEmail($email);
        if ($user) {
            $this->redirectHelper->redirect("/$uri?error=Email already in use");
        }
    }
    private function checkName(string $name, string $uri)
    {
        $user = $this->getOneByEmail($name);
        if ($user) {
            $this->redirectHelper->redirect("/$uri?error=Name already in use");
        }
    }

    public function updateUser(int $userId, string $name, string $email, int $role)
    {
        $user = $this->getOneById($userId);
        $user->setName($name);
        $user->setEmail($email);
        $user->setRoleId($role);
        $this->updateOne($user);
        $this->redirectHelper->redirect('/admin/users?success=You have successfully updated user');
    }

    public function createUser(string $name, string $email, int $roleId, string $password)
    {
        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setRoleId($roleId);
        $user->setPasswordhash($password);
        $this->insertOne($user);
        $this->redirectHelper->redirect('/admin/users?success=You have created a new user');
    }

    private function updatePassword(User $user)
    {
        $this->repository->updatePassword($user->getId(), $user->getPasswordhash());
    }

    public function requestPasswordReset(string $email)
    {
        $user = $this->getOneByEmail($email);
        if ($this->passwordResetService->checkIfAlreadyExist($user->getId())) {
            $this->redirectHelper->redirect(
                '/resetpassword?error=there is already an request,
                 please try again or check your email'
            );
        }
        $this->passwordResetService->newRequest($user->getEmail(), $user->getId());
        $this->redirectHelper->redirect('/?success=Email sent with a link for changing your password');
    }
}
