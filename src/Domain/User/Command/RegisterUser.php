<?php

declare(strict_types=1);

namespace App\Domain\User\Command;

use App\Domain\CommandInterface;
use App\Domain\UuidAwareInterface;
use App\Domain\UuidAwareTrait;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUser implements CommandInterface, UuidAwareInterface
{
    use UuidAwareTrait;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(min=3)
     */
    public $username;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    public $email;

    /**
     * @var \DateTimeImmutable
     *
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    public $acceptedBusinessTermsTimestamp;

    /**
     * RegisterUser constructor.
     * @param array $payload
     * @throws \Exception
     */
    public function __construct(array $payload)
    {
        $this->username = $payload['username'];
        $this->email = $payload['email'];
        $this->acceptedBusinessTermsTimestamp = new \DateTimeImmutable($payload['acceptedBusinessTermsTimestamp']);
    }
}
