<?php

declare(strict_types=1);

namespace App\Domain\User\Command;

use App\Domain\CommandInterface;
use App\Domain\CreateCommand;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUser extends CreateCommand implements CommandInterface
{
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

    public function __construct(array $payload)
    {
        parent::__construct();
        $this->username = $payload['username'];
        $this->email = $payload['email'];
        $this->acceptedBusinessTermsTimestamp = new \DateTimeImmutable($payload['acceptedBusinessTermsTimestamp']);
    }
}
