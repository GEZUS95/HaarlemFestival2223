<?php

use Cassandra\Date;

class User
{

    private int $id;
    private string $name;
    private string $email;
    private string $passwordhash;
    private Date $created_at;
    private int $role_id;


    /**
     * @return Date
     */
    public function getCreatedAt(): Date
    {
        return $this->created_at;
    }

    /**
     * @param Date $created_at
     */
    public function setCreatedAt(Date $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPasswordhash(): string
    {
        return $this->passwordhash;
    }

    /**
     * @param string $passwordhash
     */
    public function setPasswordhash(string $passwordhash): void
    {
        $this->passwordhash = $passwordhash;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->role_id;
    }

    /**
     * @param int $role_id
     */
    public function setRoleId(int $role_id): void
    {
        $this->role_id = $role_id;
    }
}