<?php

namespace App\Tests\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    /**
     * @return array
     */
    public function userRegisterActionProvider()
    {
        return [
            [
                'user_1',
                'validemail@asdadasdasdadasd.de',
                '2018-12-12 12:00',
                200,
            ],
            [
                'sh',
                'validemail@asdadasdasdadasd.de',
                '2018-12-12 12:00',
                400,
            ],
            [
                'user_2',
                'not valid',
                '2018-12-12 12:00',
                400,
            ],
        ];
    }

    /**
     * @dataProvider userRegisterActionProvider
     */
    public function testUserRegisterAction($username, $email, $acceptedDate, $httpCode): void
    {
        $client = static::createClient();

        $payload = [
            'username' => $username,
            'email' => $email,
            'acceptedBusinessTermsTimestamp' => $acceptedDate
        ];

        $crawler = $client->request(
            'POST',
            '/user/register',
            $payload
        );

        $this->assertEquals($httpCode, $client->getResponse()->getStatusCode());
    }
}
