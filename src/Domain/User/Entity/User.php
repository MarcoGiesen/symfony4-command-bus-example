<?php

namespace App\Domain\User\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class User
{
    /**
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="string")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $userName;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    protected $acceptedBusinessTermsTimestamp;

    public function __construct(string $id, string $userName, string $email, \DateTimeImmutable $acceptedBusinessTermsTimestamp)
    {
        $this->id = $id;
        $this->userName = $userName;
        $this->email = $email;
        $this->acceptedBusinessTermsTimestamp = $acceptedBusinessTermsTimestamp;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->userName;
    }

    public function changeEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return \DateTime
     */
    public function getAcceptedBusinessTermsTimestamp(): \DateTime
    {
        return $this->acceptedBusinessTermsTimestamp;
    }
}
