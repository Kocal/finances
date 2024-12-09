<?php
declare(strict_types=1);

namespace App\Tests\Func\Domain\UseCase\ParseDump;

use App\Application\Model\DataFixtures\BankAccountFixtures;
use App\Domain\Data\Model\ParsedBankTransaction;
use App\Domain\Data\ValueObject\BankAccountId;
use App\Domain\Data\ValueObject\BankId;
use App\Domain\Data\ValueObject\BankTransactions\UserDump;
use App\Domain\Data\ValueObject\MimeType;
use App\Domain\Exception\DumpParsingException;
use App\Domain\UseCase\BankTransactions\ParseDump;
use App\Tests\Func\FunctionalTestCase;
use Money\Money;
use Symfony\Component\HttpFoundation\File\UploadedFile;

final class HandlerTestCase extends FunctionalTestCase
{
    private ParseDump\Handler $handler;

    /**
     * @param array<ParsedBankTransaction> $expectedParsedBankTransactions
     * @dataProvider provideSuccessfulImport
     */
    public function testSuccessfulImport(BankAccountId $bankAccountId, string $dumpPath, array $expectedParsedBankTransactions): void
    {
        $output = $this->handleCommand(new ParseDump\Input(
            $bankAccountId,
            UserDump::fromUploadedFile(
                new UploadedFile(
                    $dumpPath,
                    basename($dumpPath),
                    mime_content_type($dumpPath) ?: throw new \RuntimeException(sprintf('Unable to detect mimetype of file "%s".', $dumpPath)),
                    test: true,
                )
            ),
        ));

        self::assertEquals($expectedParsedBankTransactions, $output->parsedBankTransactions);
    }

    public static function provideSuccessfulImport(): iterable
    {
        yield 'LaBanquePostale CSV' => [
            BankAccountId::fromString(BankAccountFixtures::LA_BANQUE_POSTALE_DONNA),
            __DIR__.'/../../../../Resources/BankTransactionsDump/LaBanquePostale-CSV-1.csv',
            [
                new ParsedBankTransaction(new \DateTimeImmutable('2024-12-05 00:00:00'), 'ACHAT CB CFTA RHONE     04.12.24 CARTE NUMERO                458  ', Money::EUR(-2910)),
                new ParsedBankTransaction(new \DateTimeImmutable('2024-12-05 00:00:00'), 'ACHAT CB BURGER KING    04.12.24 EUR         18,30 CARTE NO  458 APPLE PAY ', Money::EUR(-1830)),
                new ParsedBankTransaction(new \DateTimeImmutable('2024-12-05 00:00:00'), 'ACHAT CB WIENER LINIEN  04.12.24 EUR          2,40 CARTE NO  458 APPLE PAY ', Money::EUR(-240)),
                new ParsedBankTransaction(new \DateTimeImmutable('2024-12-04 00:00:00'), 'VIREMENT DE MR ALLIAUME HUGO DEFAULT REFERENCE : 018133841111111 ', Money::EUR(70000)),
                new ParsedBankTransaction(new \DateTimeImmutable('2024-12-03 00:00:00'), 'VIREMENT PERMANENT POUR MR ALLIAUME HUGO COMPTE FR9310011011111111111111X REFERENCE : 0221111111111111', Money::EUR(-50000)),
                new ParsedBankTransaction(new \DateTimeImmutable('2024-12-03 00:00:00'), 'PRELEVEMENT DE PayPal Europe S.a l. et Cie S.C.A REF : 1038611111111 1038111111111/PAYPAL', Money::EUR(-2146)),
                new ParsedBankTransaction(new \DateTimeImmutable('2024-11-25 00:00:00'), 'PRELEVEMENT DE PayPal Europe S.a l. et Cie S.C.A REF : 1038311111111 1038111111111/PAYPAL', Money::EUR(-1299)),
                new ParsedBankTransaction(new \DateTimeImmutable('2024-11-25 00:00:00'), 'ACHAT CB MOMENTO FAMILY 23.11.24 EUR         31,50 CARTE NO  458 APPLE PAY ', Money::EUR(-3150)),
                new ParsedBankTransaction(new \DateTimeImmutable('2024-11-25 00:00:00'), 'ACHAT CB  CUMUL         23.11.24 EUR          4,00 CARTE NO  458  ', Money::EUR(-400)),
                new ParsedBankTransaction(new \DateTimeImmutable('2024-11-25 00:00:00'), 'ACHAT CB BHN            23.11.24 EUR          1,50 CARTE NO  458 APPLE PAY ', Money::EUR(-150)),
                new ParsedBankTransaction(new \DateTimeImmutable('2024-10-30 00:00:00'), 'CREDIT CARTE BANCAIRE AMAZON PRIME FR 29.10.24 CARTE NUMERO                458 ', Money::EUR(6990)),
            ]
        ];
    }
    /**
     * @dataProvider provideFailingImport
     */
    public function testFailingImport(BankAccountId $bankAccountId, string $dumpPath, \Exception $expectedException): void
    {
        self::expectExceptionObject($expectedException);

        $this->handleCommand(new ParseDump\Input(
            $bankAccountId,
            UserDump::fromUploadedFile(
                new UploadedFile(
                    $dumpPath,
                    basename($dumpPath),
                    mime_content_type($dumpPath) ?: throw new \RuntimeException(sprintf('Unable to detect mimetype of file "%s".', $dumpPath)),
                    test: true,
                )
            ),
        ));
    }

    public static function provideFailingImport(): iterable
    {
        yield 'unsupported bank' => [
            BankAccountId::fromString(BankAccountFixtures::CAISSE_EPARGNE_CLARA),
            __DIR__.'/../../../../Resources/BankTransactionsDump/UnsupportedBank-CSV-1.csv',
            DumpParsingException::unsupportedDumpForBankAndType(BankId::CAISSE_EPARGNE, MimeType::fromString('text/plain')),
        ];
    }
}
