<?php

declare(strict_types=1);

namespace App\Application\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag(name: 'knp_menu.menu_builder', attributes: [
    'method' => 'createMainMenu',
    'alias' => 'main',
])]
final readonly class MenuBuilder
{
    public function __construct(
        private FactoryInterface $factory,
    ) {
    }

    public function createMainMenu(): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('app.menu.bank_accounts', [
            'route' => 'app_bank_accounts_home',
        ]);

        $menu->addChild('app.menu.income_splitter', [
            'route' => 'app_income_splitter_home',
        ]);

        return $menu;
    }
}
