<?php

declare(strict_types=1);

namespace App\Domain\User\Handler;

use App\Domain\CommandInterface;
use App\Domain\HandlerInterface;
use App\Domain\User\Command\ChangeUserEmail;
use App\Domain\User\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class ChangeUserEmailHandler implements HandlerInterface
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(CommandInterface $command): void
    {
        if (!$command instanceof ChangeUserEmail) {
            throw new \InvalidArgumentException();
        }

        // change soon -> constructor DI
        $userRepository = $this->entityManager->getRepository(User::class);

        /** @var User $user */
        $user = $userRepository->find($command->uuid);

        $user->changeEmail($command->email);

        $this->entityManager->flush();
    }
}
