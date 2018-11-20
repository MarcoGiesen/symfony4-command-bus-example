<?php

declare(strict_types=1);

namespace App\Domain\User\Command;

use App\Domain\CommandInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUser implements CommandInterface
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
     * @var \DateTime
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
        $this->uuid = Uuid::uuid1();
        $this->username = $payload['username'];
        $this->email = $payload['email'];
        $this->acceptedBusinessTermsTimestamp = new \DateTime($payload['acceptedBusinessTermsTimestamp']);
    }
}
