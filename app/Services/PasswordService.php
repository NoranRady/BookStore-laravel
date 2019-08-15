<?php
namespace App\Services;

use App\Repositories\Interfaces\PasswordRepositoryInterface;
use App\Services\Interfaces\PasswordServiceInterface;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;

class PasswordService implements PasswordServiceInterface
{
    private $passwordRepo;
    public function __construct(PasswordRepositoryInterface $passwordRepo)
    {

        $this->passwordRepo = $passwordRepo;
    }
    public function create($email)
    {
        return $this->passwordRepo->create($email);
    }
    public function find($token)
    {
        return $this->passwordRepo->find($token);

    }
    public function reset($email,$password,$token)
    {
        return $this->passwordRepo->reset($email,$password,$token);
    }
}
