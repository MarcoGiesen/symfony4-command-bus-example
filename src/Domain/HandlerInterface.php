<?php

declare(strict_types=1);

namespace App\Domain;

interface HandlerInterface
{
    public function handle(CommandInterface $command);
}