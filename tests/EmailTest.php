<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class EmailTest extends TestCase
{
    public function testCanBeCreatedFromValidEmail(): void
    {
        $address = 'user@example.com';

        $email = Email::fromString($address);

        $this->assertInstanceOf(Email::class, $email);
        $this->assertSame($address, $email->asString());
        $this->assertStringContainsString('@', $email->asString());
    }

    #[DataProvider('validEmailProvider')]
    public function testAcceptsValidEmails(string $address): void
    {
        $email = Email::fromString($address);

        $this->assertSame($address, $email->asString());
    }

    public static function validEmailProvider(): array
    {
        return [
            'dengan titik' => ['nama.belakang@example.com'],
            'dengan angka' => ['user123@example.com'],
            'subdomain'    => ['user@mail.example.co.id'],
            'dengan plus'  => ['user+tag@example.com'],
        ];
    }
}