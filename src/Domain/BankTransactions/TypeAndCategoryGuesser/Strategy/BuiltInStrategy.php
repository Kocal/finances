<?php

declare(strict_types=1);

namespace App\Domain\BankTransactions\TypeAndCategoryGuesser\Strategy;

use App\Domain\Data\ValueObject\BankTransactionCategory;
use App\Domain\Data\ValueObject\BankTransactionType;

final class BuiltInStrategy implements Strategy
{
    public function guess(string $label): ?array
    {
        $label = mb_strtolower($label);

        return match (true) {
            // Essential
            str_contains($label, 'prelevement de sdc') => [BankTransactionType::Essential, BankTransactionCategory::HousingMiscellaneousExpenses],
            str_contains($label, 'prelevement de edf') => [BankTransactionType::Essential, BankTransactionCategory::HousingElectricity],
            str_contains($label, 'prelevement de echeance pret') => [BankTransactionType::Essential, BankTransactionCategory::BankLoanRepayment],
            str_contains($label, 'prelevement de sas fitness') => [BankTransactionType::Essential, BankTransactionCategory::LeisureSport],
            str_contains($label, 'prelevement de iriade') || str_contains($label, 'iard') => [BankTransactionType::Essential, BankTransactionCategory::BankLoanRepayment],
            str_contains($label, 'seuil de non-perception') && str_contains($label, 'agios') => [BankTransactionType::Essential, BankTransactionCategory::Unknown],
            str_contains($label, 'utilisation du decouvert') => [BankTransactionType::Essential, BankTransactionCategory::Unknown],
            str_contains($label, 'cotisation trimestrielle') => [BankTransactionType::Essential, BankTransactionCategory::BankLoanRepayment],
            str_contains($label, 'avantage tarifaire patrimonial') => [BankTransactionType::Essential, BankTransactionCategory::BankCharges],
            str_contains($label, 'prelevement de lbp assurances') => [BankTransactionType::Essential, BankTransactionCategory::VariousInsurance],
            str_contains($label, 'prelevement de orange') && str_contains($label, 'fibre') => [BankTransactionType::Essential, BankTransactionCategory::SubscriptionInternet],
            str_contains($label, 'prelevement de orange') && str_contains($label, 'mobile') => [BankTransactionType::Essential, BankTransactionCategory::SubscriptionMobileTelephony],
            str_contains($label, 'prelevement de direction general') && str_contains($label, 'finances publ') => [BankTransactionType::Essential, BankTransactionCategory::TaxesAndDuties],
            str_contains($label, 'achat cb crf') || str_contains($label, 'achat cb carrefour') => [BankTransactionType::Essential, BankTransactionCategory::FoodAndGroceriesSupermarket],
            str_contains($label, 'achat cb franprix') => [BankTransactionType::Essential, BankTransactionCategory::FoodAndGroceriesSupermarket],
            str_contains($label, 'achat cb grand frais') => [BankTransactionType::Essential, BankTransactionCategory::FoodAndGroceriesSupermarket],
            str_contains($label, 'achat cb casa solari') => [BankTransactionType::Essential, BankTransactionCategory::FoodAndGroceriesSupermarket],
            str_contains($label, 'achat cb magasin u') => [BankTransactionType::Essential, BankTransactionCategory::FoodAndGroceriesSupermarket],
            str_contains($label, 'achat cb monoprix') => [BankTransactionType::Essential, BankTransactionCategory::FoodAndGroceriesSupermarket],
            str_contains($label, 'achat cb boucheries and') => [BankTransactionType::Essential, BankTransactionCategory::FoodAndGroceriesSupermarket],
            str_contains($label, 'achat cb') && str_contains($label, 'epicuri') => [BankTransactionType::Essential, BankTransactionCategory::AestheticAndCareHair],
            str_contains($label, 'retrait dab') => [BankTransactionType::Essential, BankTransactionCategory::Withdrawal],
            str_contains($label, 'achat cb google gsuite') => [BankTransactionType::Essential, BankTransactionCategory::ProfessionalOnlineService],
            str_contains($label, 'achat cb cloudflare') => [BankTransactionType::Essential, BankTransactionCategory::ProfessionalOnlineService],
            str_contains($label, 'indy') => [BankTransactionType::Essential, BankTransactionCategory::ProfessionalAccounting],

            // Pleasure
            str_contains($label, 'achat cb keolis') => [BankTransactionType::Pleasure, BankTransactionCategory::TransportPublicTransport],
            str_contains($label, 'achat cb sncf') || str_contains($label, 'carte bancaire sncf') => [BankTransactionType::Pleasure, BankTransactionCategory::TransportTrainTicket],
            str_contains($label, 'achat cb service navigo') => [BankTransactionType::Pleasure, BankTransactionCategory::TransportPublicTransport],
            str_contains($label, 'achat cb ratp') => [BankTransactionType::Pleasure, BankTransactionCategory::TransportPublicTransport],
            str_contains($label, 'achat cb cfta rhone') => [BankTransactionType::Pleasure, BankTransactionCategory::TransportTrainTicket],
            str_contains($label, 'achat cb') && str_contains($label, 'bus') => [BankTransactionType::Pleasure, BankTransactionCategory::TransportPublicTransport],
            str_contains($label, 'achat cb mcdonalds') => [BankTransactionType::Pleasure, BankTransactionCategory::FoodAndGroceriesFastFood],
            str_contains($label, 'achat cb burger king') || str_contains($label, 'achat cb burgerking') => [BankTransactionType::Pleasure, BankTransactionCategory::FoodAndGroceriesFastFood],
            str_contains($label, 'achat cb amazon') => [BankTransactionType::Pleasure, BankTransactionCategory::PurchasesAndShoppingOther],
            str_contains($label, 'achat cb botanic') => [BankTransactionType::Pleasure, BankTransactionCategory::HousingOutdoorAndGarden],
            str_contains($label, 'achat cb emmaus') => [BankTransactionType::Pleasure, BankTransactionCategory::Unknown],
            str_contains($label, 'achat cb chikin bang') => [BankTransactionType::Pleasure, BankTransactionCategory::FoodAndGroceriesRestaurant],
            str_contains($label, 'achat cb sushi 6eme') => [BankTransactionType::Pleasure, BankTransactionCategory::FoodAndGroceriesRestaurant],
            str_contains($label, 'achat cb euro d asie') => [BankTransactionType::Pleasure, BankTransactionCategory::FoodAndGroceriesRestaurant],
            str_contains($label, 'achat cb patiss nicolas') => [BankTransactionType::Pleasure, BankTransactionCategory::FoodAndGroceriesOther],
            str_contains($label, 'achat cb henri desmouli') => [BankTransactionType::Pleasure, BankTransactionCategory::FoodAndGroceriesOther],
            str_contains($label, 'achat cb decathlon') => [BankTransactionType::Pleasure, BankTransactionCategory::PurchasesAndShoppingSport],
            str_contains($label, 'achat cb euro disney') => [BankTransactionType::Pleasure, BankTransactionCategory::LeisureOther],

            // Extra
            str_contains($label, 'paypal') => [BankTransactionType::Extra, BankTransactionCategory::VariousPayPal],
            str_contains($label, 'achat cb apple.com') => [BankTransactionType::Extra, BankTransactionCategory::PurchasesAndShoppingHighTech],
            str_contains($label, 'achat cb brico depot') => [BankTransactionType::Extra, BankTransactionCategory::Various],
            str_contains($label, 'achat cb booking.com') => [BankTransactionType::Extra, BankTransactionCategory::LeisureHotel],

            default => null,
        };
    }
}
