<?php

namespace App\Tests\Domain\User\Handler;

use App\Domain\CommandInterface;
use App\Domain\User\Command\RegisterUser;
use App\Domain\User\Entity\User;
use App\Domain\User\Handler\RegisterUserHandler;
use Doctrine\ORM\EntityManager;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class RegisterUserHandlerTest extends KernelTestCase
{
    public function testRegisterUser(): void
    {
        $handler = new RegisterUserHandler($this->getEntityManagerMock()->reveal());

        $payload = [
            'username' => 'user',
            'email' => 'asdad@sdad.de',
            'acceptedBusinessTermsTimestamp' => '',
        ];

        $request = new RegisterUser($payload);

        $request->uuid = Uuid::uuid4();

        $handler->handle($request);
    }

    public function testRegisterUserInvalidArgumentException(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $handler = new RegisterUserHandler($this->prophesize(EntityManager::class)->reveal());

        $class = new class implements CommandInterface {};

        $handler->handle($class);
    }

    /**
     * @return ObjectProphecy
     */
    private function getEntityManagerMock(): ObjectProphecy
    {
        $entityManagerMock = $this->prophesize(EntityManager::class);

        $entityManagerMock->persist(Argument::type(User::class))->shouldBeCalled();
        $entityManagerMock->flush()->shouldBeCalled();

        return $entityManagerMock;
    }
}
