<?php

declare(strict_types=1);

namespace App\Domain\BankTransaction\TypeAndCategoryGuesser\Strategy;

use App\Domain\Data\ValueObject\BankTransaction\Category;
use App\Domain\Data\ValueObject\BankTransaction\Type;

final class BuiltInStrategy implements Strategy
{
    public function guess(string $label): ?array
    {
        $label = mb_strtolower($label);

        return match (true) {
            // Essential
            str_contains($label, 'prelevement de sdc') => [Type::Essential, Category::HousingMiscellaneousExpenses],
            str_contains($label, 'prelevement de edf') => [Type::Essential, Category::HousingElectricity],
            str_contains($label, 'prelevement de echeance pret') => [Type::Essential, Category::BankLoanRepayment],
            str_contains($label, 'prelevement de sas fitness') => [Type::Essential, Category::LeisureSport],
            str_contains($label, 'prelevement de iriade') || str_contains($label, 'iard') => [Type::Essential, Category::BankLoanRepayment],
            str_contains($label, 'seuil de non-perception') && str_contains($label, 'agios') => [Type::Essential, Category::Unknown],
            str_contains($label, 'utilisation du decouvert') => [Type::Essential, Category::Unknown],
            str_contains($label, 'cotisation trimestrielle') => [Type::Essential, Category::BankLoanRepayment],
            str_contains($label, 'avantage tarifaire patrimonial') => [Type::Essential, Category::BankCharges],
            str_contains($label, 'prelevement de lbp assurances') => [Type::Essential, Category::VariousInsurance],
            str_contains($label, 'prelevement de orange') && str_contains($label, 'fibre') => [Type::Essential, Category::SubscriptionInternet],
            str_contains($label, 'prelevement de orange') && str_contains($label, 'mobile') => [Type::Essential, Category::SubscriptionMobileTelephony],
            str_contains($label, 'prelevement de direction general') && str_contains($label, 'finances publ') => [Type::Essential, Category::TaxesAndDuties],
            str_contains($label, 'achat cb crf') || str_contains($label, 'achat cb carrefour') => [Type::Essential, Category::FoodAndGroceriesSupermarket],
            str_contains($label, 'achat cb franprix') => [Type::Essential, Category::FoodAndGroceriesSupermarket],
            str_contains($label, 'achat cb grand frais') => [Type::Essential, Category::FoodAndGroceriesSupermarket],
            str_contains($label, 'achat cb casa solari') => [Type::Essential, Category::FoodAndGroceriesSupermarket],
            str_contains($label, 'achat cb magasin u') => [Type::Essential, Category::FoodAndGroceriesSupermarket],
            str_contains($label, 'achat cb monoprix') => [Type::Essential, Category::FoodAndGroceriesSupermarket],
            str_contains($label, 'achat cb boucheries and') => [Type::Essential, Category::FoodAndGroceriesSupermarket],
            str_contains($label, 'achat cb') && str_contains($label, 'epicuri') => [Type::Essential, Category::AestheticAndCareHair],
            str_contains($label, 'retrait dab') => [Type::Essential, Category::Withdrawal],
            str_contains($label, 'achat cb google gsuite') => [Type::Essential, Category::ProfessionalOnlineService],
            str_contains($label, 'achat cb cloudflare') => [Type::Essential, Category::ProfessionalOnlineService],
            str_contains($label, 'indy') => [Type::Essential, Category::ProfessionalAccounting],

            // Pleasure
            str_contains($label, 'achat cb keolis') => [Type::Pleasure, Category::TransportPublicTransport],
            str_contains($label, 'achat cb sncf') || str_contains($label, 'carte bancaire sncf') => [Type::Pleasure, Category::TransportTrainTicket],
            str_contains($label, 'achat cb service navigo') => [Type::Pleasure, Category::TransportPublicTransport],
            str_contains($label, 'achat cb ratp') => [Type::Pleasure, Category::TransportPublicTransport],
            str_contains($label, 'achat cb cfta rhone') => [Type::Pleasure, Category::TransportTrainTicket],
            str_contains($label, 'achat cb') && str_contains($label, 'bus') => [Type::Pleasure, Category::TransportPublicTransport],
            str_contains($label, 'achat cb mcdonalds') => [Type::Pleasure, Category::FoodAndGroceriesFastFood],
            str_contains($label, 'achat cb burger king') || str_contains($label, 'achat cb burgerking') => [Type::Pleasure, Category::FoodAndGroceriesFastFood],
            str_contains($label, 'achat cb amazon') => [Type::Pleasure, Category::PurchasesAndShoppingOther],
            str_contains($label, 'achat cb botanic') => [Type::Pleasure, Category::HousingOutdoorAndGarden],
            str_contains($label, 'achat cb emmaus') => [Type::Pleasure, Category::Unknown],
            str_contains($label, 'achat cb chikin bang') => [Type::Pleasure, Category::FoodAndGroceriesRestaurant],
            str_contains($label, 'achat cb sushi 6eme') => [Type::Pleasure, Category::FoodAndGroceriesRestaurant],
            str_contains($label, 'achat cb euro d asie') => [Type::Pleasure, Category::FoodAndGroceriesRestaurant],
            str_contains($label, 'achat cb patiss nicolas') => [Type::Pleasure, Category::FoodAndGroceriesOther],
            str_contains($label, 'achat cb henri desmouli') => [Type::Pleasure, Category::FoodAndGroceriesOther],
            str_contains($label, 'achat cb decathlon') => [Type::Pleasure, Category::PurchasesAndShoppingSport],
            str_contains($label, 'achat cb euro disney') => [Type::Pleasure, Category::LeisureOther],

            // Extra
            str_contains($label, 'paypal') => [Type::Extra, Category::VariousPayPal],
            str_contains($label, 'achat cb apple.com') => [Type::Extra, Category::PurchasesAndShoppingHighTech],
            str_contains($label, 'achat cb brico depot') => [Type::Extra, Category::Various],
            str_contains($label, 'achat cb booking.com') => [Type::Extra, Category::LeisureHotel],

            default => null,
        };
    }
}
