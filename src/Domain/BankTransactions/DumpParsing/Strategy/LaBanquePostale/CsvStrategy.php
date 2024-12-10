<?php

declare(strict_types=1);

namespace App\Domain\BankTransactions\DumpParsing\Strategy\LaBanquePostale;

use App\Domain\BankTransactions\DumpParsing\Strategy\Strategy;
use App\Domain\Data\Model\ParsedBankTransaction;
use App\Domain\Data\ValueObject\BankId;
use App\Domain\Data\ValueObject\BankTransactions\UserDump;
use App\Domain\Exception\DumpParsingException;
use Money\Currency;
use Money\Money;
use Override;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use function Symfony\Component\String\s;

final readonly class CsvStrategy implements Strategy
{
    /**
     * https://regex101.com/r/U449Uk/1
     */
    private const FR_CURRENCY_REGEX = '/Solde \((?P<currency>[^)]+)\)\s+;/';

    public function __construct(
        private DecoderInterface $decoder,
    ) {
    }

    public function supports(BankId $bankId, UserDump $dump): bool
    {
        return $bankId->equals(BankId::LA_BANQUE_POSTALE)
           // TODO: && $dump->mimeType->isCsv()
        ;
    }

    #[Override]
    public function parse(UserDump $dump): array
    {
        $currency = $this->extractCurrency($dump);

        return $this->extractTransactions($dump, $currency);
    }

    private function extractCurrency(UserDump $dump): Currency
    {
        $matches = s($dump->content)->match(self::FR_CURRENCY_REGEX);
        if (! isset($matches['currency'])) {
            throw DumpParsingException::unableToGuessCurrency();
        }

        return match ($matches['currency']) {
            'EUROS' => new Currency('EUR'),
            default => throw DumpParsingException::unsupportedCurrency($matches['currency']),
        };
    }

    /**
     * @return array<ParsedBankTransaction>
     * @throws DumpParsingException
     */
    private function extractTransactions(UserDump $dump, Currency $currency): array
    {
        $content = $dump->content;

        $rows = explode("\n", $content);
        if ($rows[5] === '') {
            // We can assume that the first 5 lines are the header
            $content = implode("\n", array_slice($rows, 6));
        }

        $data = $this->decoder->decode($content, CsvEncoder::FORMAT, [
            CsvEncoder::DELIMITER_KEY => ';',
            CsvEncoder::ENCLOSURE_KEY => '"',
            CsvEncoder::NO_HEADERS_KEY => true,
        ]);

        $numberFormatter = match ($currency->getCode()) {
            'EUR' => new \NumberFormatter('fr_FR', \NumberFormatter::DECIMAL),
            default => throw DumpParsingException::unsupportedCurrency($currency->getCode()),
        };

        $transactions = [];
        foreach ($data as $row) {
            // The header is present in the data since we used NO_HEADERS_KEY (because the headers are hard to use)
            if ($row[0] === 'Date') {
                continue;
            }

            $date = \DateTimeImmutable::createFromFormat($dateFormat = 'd/m/Y', $row[0]);
            if ($date === false) {
                throw DumpParsingException::unableToParseDate($row[0], $dateFormat);
            }

            $transactions[] = new ParsedBankTransaction(
                date: $date->setTime(0, 0),
                label: s($row[1])->trim()->toString(),
                money: new Money((int) ($numberFormatter->parse($row[2]) * 100), $currency),
            );
        }

        return $transactions;
    }
}
