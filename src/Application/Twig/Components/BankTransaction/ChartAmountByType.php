<?php

declare(strict_types=1);

namespace App\Application\Twig\Components\BankTransaction;

use App\Domain\Data\ValueObject\BankTransaction\Type;
use Money\Money;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsTwigComponent]
final class ChartAmountByType
{
    /**
     * @var array<value-of<Type>, Money>
     */
    public array $amountByType;

    public function __construct(
        private readonly ChartBuilderInterface $chartBuilder,
        private readonly TranslatorInterface $translator,
    ) {
    }

    /**
     * @param array<string, mixed> $data
     * @return array<string, mixed>
     */
    #[PreMount]
    public function preMount(array $data): array
    {
        $optionsResolver = new OptionsResolver();
        $optionsResolver->setIgnoreUndefined();
        $optionsResolver
            ->define('amountByType')
            ->required()
            ->allowedTypes('array')
        ;

        return $optionsResolver->resolve($data) + $data;
    }

    public function chart(): Chart
    {
        $chart = $this->chartBuilder->createChart(Chart::TYPE_DOUGHNUT);

        $labels = [];
        $data = [];
        $colors = [];
        foreach ($this->amountByType as $type => $amount) {
            $type = Type::from($type);
            $labels[] = $type->trans($this->translator);
            $data[] = $amount->absolute()->getAmount();
            $colors[] = $type->getColor();
        }

        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Expenses per type',
                    'backgroundColor' => $colors,
                    'data' => $data,
                ],
            ],
        ]);

        $chart->setOptions([
            'responsive' => true,
            'plugins' => [
                'legend' => [
                    'position' => 'right',
                ],
            ],
        ]);

        return $chart;
    }
}
