<?php

namespace App\Domain;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

abstract class CreateCommand implements CommandInterface
{
    /**
     * @var Uuid
     *
     * @Assert\NotBlank()
     * @Assert\Uuid()
     */
    public $uuid;

    public function __construct()
    {
        $this->uuid = Uuid::uuid4();
    }
}