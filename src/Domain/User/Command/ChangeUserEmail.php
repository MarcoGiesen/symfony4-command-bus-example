<?php

declare(strict_types=1);

namespace App\Domain\User\Command;

use App\Domain\CommandInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

class ChangeUserEmail implements CommandInterface
{
    /**
     * @var Uuid
     *
     * @Assert\NotBlank()
     * @Assert\Uuid()
     */
    public $uuid;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;

    /**
     * RegisterUser constructor.
     * @param array $payload
     * @throws \Exception
     */
    public function __construct(array $payload)
    {
        $this->uuid = Uuid::fromString($payload['uuid']);
        $this->email = $payload['email'];
    }
}
