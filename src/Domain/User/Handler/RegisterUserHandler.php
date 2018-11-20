<?php

declare(strict_types=1);

namespace App\Domain\User\Handler;

use App\Domain\CommandInterface;
use App\Domain\HandlerInterface;
use App\Domain\User\Command\RegisterUser;
use App\Domain\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class RegisterUserHandler implements HandlerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(CommandInterface $command): void
    {
        if (!$command instanceof RegisterUser) {
            throw new \InvalidArgumentException();
        }

        $user = new User(
            $command->uuid->toString(),
            $command->username,
            $command->email,
            $command->acceptedBusinessTermsTimestamp
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
