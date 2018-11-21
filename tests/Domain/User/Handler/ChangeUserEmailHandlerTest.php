<?php

namespace App\Tests\Domain\User\Handler;

use App\Domain\User\Command\ChangeUserEmail;
use App\Domain\User\Entity\User;
use App\Domain\User\Handler\ChangeUserEmailHandler;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Prophecy\Argument;
use Prophecy\Prophecy\ObjectProphecy;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class ChangeUserEmailHandlerTest extends KernelTestCase
{
    public function testRegisterUser(): void
    {
        $handler = new ChangeUserEmailHandler($this->getEntityManagerMock()->reveal());

        $payload = [
            'uuid' => '0c35dda0-eca0-11e8-b7fe-02249769545f',
            'email' => 'testest@sdad.de',
        ];

        $request = new ChangeUserEmail($payload);

        $handler->handle($request);
    }

    /**
     * @return ObjectProphecy
     */
    private function getEntityManagerMock(): ObjectProphecy
    {
        $user = new User('0c35dda0-eca0-11e8-b7fe-02249769545f', 'user', 'test@mail.de', new \DateTimeImmutable());

        $userRepositoryMock = $this->prophesize(EntityRepository::class);
        $userRepositoryMock->find(Argument::any())->willReturn($user);

        $entityManagerMock = $this->prophesize(EntityManager::class);

        $entityManagerMock->getRepository(User::class)->willReturn($userRepositoryMock);
        $entityManagerMock->flush()->shouldBeCalled();

        return $entityManagerMock;
    }
}
