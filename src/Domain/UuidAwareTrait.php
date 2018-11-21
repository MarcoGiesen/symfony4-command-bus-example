<?php

namespace App\Domain;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;

trait UuidAwareTrait {

    /**
     * @var Uuid
     *
     * @Assert\NotBlank()
     * @Assert\Uuid()
     */
    public $uuid;
}
