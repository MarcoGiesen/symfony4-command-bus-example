<?php

declare(strict_types=1);

namespace App\Domain\User\Command;

use App\Domain\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

class ChangeUserEmail implements CommandInterface
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
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
        $this->uuid = $payload['uuid'];
        $this->email = $payload['email'];
    }
}
