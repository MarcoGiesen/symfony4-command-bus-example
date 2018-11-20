<?php

declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\NoHandlerClassFound;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CommandBus
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function dispatch($command)
    {
        $handlerClassName = $this->resolveHandlerClass($command);

        if (!class_exists($handlerClassName)) {
            throw new NoHandlerClassFound(
                sprintf('Handler-Class for Domain Request %s not found', \get_class($command))
            );
        }

        /** @var HandlerInterface $handlerClass */
        $handlerClass = $this->container->get($handlerClassName);

        $handlerClass->handle($command);
    }

    private function resolveHandlerClass(CommandInterface $command): string
    {
        $reflectionClass = new \ReflectionClass($command);

        return sprintf(
            '%s\Handler\%sHandler',
            preg_replace('/\\\\Command/', '', $reflectionClass->getNamespaceName()),
            $reflectionClass->getShortName()
        );
    }
}