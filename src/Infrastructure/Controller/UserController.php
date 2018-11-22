<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Domain\CommandBus;
use App\Domain\CommandResolver;
use App\Domain\User\Command\ChangeUserEmail;
use App\Domain\User\Command\RegisterUser;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController
{
    private $commandBus;
    private $commandResolver;

    public function __construct(CommandBus $commandBus, CommandResolver $commandResolver)
    {
        $this->commandBus = $commandBus;
        $this->commandResolver = $commandResolver;
    }

    /**
     * @Route("/user/register", methods={"POST"}, name="user_register")
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \ReflectionException
     */
    public function registerAction(Request $request): JsonResponse
    {
        /** @var RegisterUser $registerUser */
        $registerUser = $this->commandResolver->resolve($request, RegisterUser::class);

        $this->commandBus->dispatch($registerUser);

        return new JsonResponse([
            'status' => 'success',
            'message' => 'ok'
        ]);
    }

    /**
     * @Route("/user/changeEmail", methods={"POST"}, name="user_change_email")
     *
     * @param Request $request
     * @return JsonResponse
     * @throws \ReflectionException
     */
    public function changeEmailAction(Request $request): JsonResponse
    {
        /** @var RegisterUser $registerUser */
        $registerUser = $this->commandResolver->resolve($request, ChangeUserEmail::class);

        $this->commandBus->dispatch($registerUser);

        return new JsonResponse([
            'status' => 'success',
            'message' => 'ok'
        ]);
    }
}
