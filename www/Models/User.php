<?php

namespace App\Models;

use App\Core\Sql;

class User extends Sql
{

    protected Int $id = 0;
    protected String $firstname;
    protected String $lastname;
    protected String $email;
    protected String $password;
    protected String $date_updated;
    protected String $status = 'FALSE';

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
     * @return String
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param String $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = ucwords(strtolower(trim($firstname)));
    }

    /**
     * @return String
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param String $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = strtoupper(trim($lastname));
    }

    /**
     * @return String
     */
    // public function getCountry(): string
    // {
    //     return $this->country;
    // }

    /**
     * @param String $country
     */
    // public function setCountry(string $country): void
    // {
    //     $this->country = strtoupper(trim($country));
    // }

    /**
     * @return String
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param String $email
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower(trim($email));
    }

    /**
     * @return String
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param String $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return int
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**EVENT_MAIN
     * @param int $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getDateUpdated()
    {
        return $this->date_updated;
    }

    /**
     * @param int $updated
     */
    public function setDateUpdated(): void
    {
        date_default_timezone_set('Europe/Paris');
        $currentDateTime = date('Y-m-d H:i:s');
        $this->date_updated = $currentDateTime;
    }
}
