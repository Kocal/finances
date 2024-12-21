<?php

declare(strict_types=1);

namespace App\Domain\Data\ValueObject;

use Symfony\Component\Translation\TranslatableMessage;

enum BankTransactionCategory: string
{
    case Unknown = 'unknown';

    case Subscription = 'subscription';
    case SubscriptionOther = 'subscription_other';
    case SubscriptionInternet = 'subscription_internet';
    case SubscriptionMobileTelephony = 'subscription_mobile_telephony';
    case SubscriptionFixedTelephony = 'subscription_fixed_telephone';

    case PurchasesAndShopping = 'purchases_and_shopping';
    case PurchasesAndShoppingOther = 'purchases_and_shopping_other';
    case PurchasesAndShoppingSport = 'purchases_and_shopping_sport';
    case PurchasesAndShoppingGift = 'purchases_and_shopping_gift';
    case PurchasesAndShoppingMovie = 'purchases_and_shopping_movie';
    case PurchasesAndShoppingHighTech = 'purchases_and_shopping_high_tech';
    case PurchasesAndShoppingLicenses = 'purchases_and_shopping_licenses';
    case PurchasesAndShoppingBook = 'purchases_and_shopping_book';
    case PurchasesAndShoppingMusic = 'purchases_and_shopping_music';
    case PurchasesAndShoppingClothing = 'purchases_and_shopping_clothing';

    case FoodAndGroceries = 'food_and_groceries';
    case FoodAndGroceriesOther = 'food_and_groceries_other';
    case FoodAndGroceriesCafe = 'food_and_groceries_cafe';
    case FoodAndGroceriesFastFood = 'food_and_groceries_fast_food';
    case FoodAndGroceriesRestaurant = 'food_and_groceries_restaurant';
    case FoodAndGroceriesSupermarket = 'food_and_groceries_supermarket';

    case Transport = 'transport';
    case TransportOther = 'transport_other';
    case TransportVehicleInsurance = 'transport_insurance';
    case TransportPlaneTicket = 'transport_plane_ticket';
    case TransportTrainTicket = 'transport_train_ticket';
    case TransportFuel = 'transport_fuel';
    case TransportVehicleMaintenance = 'transport_vehicle_maintenance';
    case TransportVehicleRental = 'transport_vehicle_rental';
    case TransportToll = 'transport_toll';
    case TransportParking = 'transport_parking';
    case TransportPublicTransport = 'transport_public_transport';

    case Bank = 'bank';
    case BankOther = 'bank_other';
    case BankMonthlyDebitCard = 'bank_monthly_debit_card';
    case BankSavings = 'bank_savings';
    case BankCharges = 'bank_charges';
    case BankMortgage = 'bank_mortgage';
    case BankPaymentIncident = 'bank_payment_incident';
    case BankLoanRepayment = 'bank_loan_repayment';
    case BankBankingService = 'bank_banking_service';

    case Professional = 'professional';
    case ProfessionalOther = 'professional_other';
    case ProfessionalAccounting = 'professional_accounting';
    case ProfessionalTip = 'professional_tip';
    case ProfessionalSocialContribution = 'professional_social_contribution';
    case ProfessionalOfficeSupplies = 'professional_office_supplies';
    case ProfessionalShippingCosts = 'professional_shipping_costs';
    case ProfessionalPrintingCosts = 'professional_printing_costs';
    case ProfessionalRecruitmentCosts = 'professional_recruitment_costs';
    case ProfessionalLegalFees = 'professional_legal_fees';
    case ProfessionalOfficeMaintenance = 'professional_office_maintenance';
    case ProfessionalMarketing = 'professional_marketing';
    case ProfessionalExpenseReport = 'professional_expense_report';
    case ProfessionalPension = 'professional_pension';
    case ProfessionalAdvertising = 'professional_advertising';
    case ProfessionalExecutiveCompensation = 'professional_executive_compensation';
    case ProfessionalSalary = 'professional_salary';
    case ProfessionalOnlineService = 'professional_online_service';
    case ProfessionalOutsourcing = 'professional_outsourcing';
    case ProfessionalApprenticeshipTax = 'professional_apprenticeship_tax';

    case Various = 'various';
    case VariousOther = 'various_other';
    case VariousInsurance = 'various_insurance';
    case VariousDonation = 'various_donation';
    case VariousPressing = 'various_pressing';
    case VariousPayPal = 'various_paypal';

    case AestheticAndCare = 'aesthetic_and_care';
    case AestheticAndCareOther = 'aesthetic_and_care_other';
    case AestheticAndCareCosmetics = 'aesthetic_and_care_cosmetics';
    case AestheticAndCareHair = 'aesthetic_and_care_hair';
    case AestheticAndCareEsthetic = 'aesthetic_and_care_esthetic';
    case AestheticAndCareSpaAndMassage = 'aesthetic_and_care_spa_and_massage';

    case TaxesAndDuties = 'taxes_and_duties';
    case TaxesAndDutiesOther = 'taxes_and_duties_other';
    case TaxesAndDutiesFines = 'taxes_and_duties_fines';
    case TaxesAndDutiesPropertyTax = 'taxes_and_duties_property_tax';
    case TaxesAndDutiesIncomeTax = 'taxes_and_duties_income_tax';
    case TaxesAndDutiesVat = 'taxes_and_duties_vat';

    case Housing = 'housing';
    case HousingOther = 'housing_other';
    case HousingHomeInsurance = 'housing_home_insurance';
    case HousingMiscellaneousExpenses = 'housing_miscellaneous_expenses';
    case HousingDecoration = 'housing_decoration';
    case HousingWater = 'housing_water';
    case HousingElectricity = 'housing_electricity';
    case HousingMaintenance = 'housing_maintenance';
    case HousingOutdoorAndGarden = 'housing_outdoor_and_garden';
    case HousingGas = 'housing_gas';
    case HousingRent = 'housing_rent';

    case Leisure = 'leisure';
    case LeisureOther = 'leisure_other';
    case LeisureBarAndClub = 'leisure_bar_and_club';
    case LeisureEntertainment = 'leisure_entertainment';
    case LeisurePetExpenses = 'leisure_pet_expenses';
    case LeisureHobby = 'leisure_hobby';
    case LeisureHotel = 'leisure_hotel';
    case LeisureRestaurant = 'leisure_restaurant';
    case LeisureCulturalOuting = 'leisure_cultural_outing';
    case LeisureSport = 'leisure_sport';
    case LeisureSportWinter = 'leisure_sport_winter';
    case LeisureTravel = 'leisure_travel';
    case LeisureVacation = 'leisure_vacation';

    case Withdrawal = 'withdrawal';
    case WithdrawalCheque = 'withdrawal_cheque';
    case WithdrawalTransfer = 'withdrawal_transfer';
    case WithdrawalInternalTransfer = 'withdrawal_internal_transfer';

    case Health = 'health';
    case HealthOther = 'health_other';
    case HealthDentist = 'health_dentist';
    case HealthDoctor = 'health_doctor';
    case HealthMutualInsurance = 'health_mutual_insurance';
    case HealthOptician = 'health_optician';
    case HealthPharmacy = 'health_pharmacy';
    case HealthHospital = 'health_hospital';

    /**
     * @return BankTransactionCategory[]
     */
    public static function getRootCategories(): array
    {
        return [
            self::Subscription,
            self::PurchasesAndShopping,
            self::FoodAndGroceries,
            self::Transport,
            self::Bank,
            self::Professional,
            self::Various,
            self::AestheticAndCare,
            self::TaxesAndDuties,
            self::Housing,
            self::Leisure,
            self::Withdrawal,
            self::Health,
        ];
    }

    /**
     * @return BankTransactionCategory[]
     */
    public function getSubCategories(): array
    {
        return match ($this) {
            self::Subscription => [
                self::SubscriptionOther,
                self::SubscriptionInternet,
                self::SubscriptionMobileTelephony,
                self::SubscriptionFixedTelephony,
            ],
            self::PurchasesAndShopping => [
                self::PurchasesAndShoppingOther,
                self::PurchasesAndShoppingSport,
                self::PurchasesAndShoppingGift,
                self::PurchasesAndShoppingMovie,
                self::PurchasesAndShoppingHighTech,
                self::PurchasesAndShoppingLicenses,
                self::PurchasesAndShoppingBook,
                self::PurchasesAndShoppingMusic,
                self::PurchasesAndShoppingClothing,
            ],
            self::FoodAndGroceries => [
                self::FoodAndGroceriesOther,
                self::FoodAndGroceriesCafe,
                self::FoodAndGroceriesFastFood,
                self::FoodAndGroceriesRestaurant,
                self::FoodAndGroceriesSupermarket,
            ],
            self::Transport => [
                self::TransportOther,
                self::TransportVehicleInsurance,
                self::TransportPlaneTicket,
                self::TransportTrainTicket,
                self::TransportFuel,
                self::TransportVehicleMaintenance,
                self::TransportVehicleRental,
                self::TransportToll,
                self::TransportParking,
                self::TransportPublicTransport,
            ],
            self::Bank => [
                self::BankOther,
                self::BankMonthlyDebitCard,
                self::BankSavings,
                self::BankCharges,
                self::BankMortgage,
                self::BankPaymentIncident,
                self::BankLoanRepayment,
                self::BankBankingService,
            ],
            self::Professional => [
                self::ProfessionalOther,
                self::ProfessionalAccounting,
                self::ProfessionalTip,
                self::ProfessionalSocialContribution,
                self::ProfessionalOfficeSupplies,
                self::ProfessionalShippingCosts,
                self::ProfessionalPrintingCosts,
                self::ProfessionalRecruitmentCosts,
                self::ProfessionalLegalFees,
                self::ProfessionalOfficeMaintenance,
                self::ProfessionalMarketing,
                self::ProfessionalExpenseReport,
                self::ProfessionalPension,
                self::ProfessionalAdvertising,
                self::ProfessionalExecutiveCompensation,
                self::ProfessionalSalary,
                self::ProfessionalOnlineService,
                self::ProfessionalOutsourcing,
                self::ProfessionalApprenticeshipTax,
            ],
            self::Various => [
                self::VariousOther,
                self::VariousInsurance,
                self::VariousDonation,
                self::VariousPressing,
                self::VariousPayPal,
            ],
            self::AestheticAndCare => [
                self::AestheticAndCareOther,
                self::AestheticAndCareCosmetics,
                self::AestheticAndCareHair,
                self::AestheticAndCareEsthetic,
                self::AestheticAndCareSpaAndMassage,
            ],
            self::TaxesAndDuties => [
                self::TaxesAndDutiesOther,
                self::TaxesAndDutiesFines,
                self::TaxesAndDutiesPropertyTax,
                self::TaxesAndDutiesIncomeTax,
                self::TaxesAndDutiesVat,
            ],
            self::Housing => [
                self::HousingOther,
                self::HousingHomeInsurance,
                self::HousingMiscellaneousExpenses,
                self::HousingDecoration,
                self::HousingWater,
                self::HousingElectricity,
                self::HousingMaintenance,
                self::HousingOutdoorAndGarden,
                self::HousingGas,
                self::HousingRent,
            ],
            self::Leisure => [
                self::LeisureOther,
                self::LeisureBarAndClub,
                self::LeisureEntertainment,
                self::LeisurePetExpenses,
                self::LeisureHobby,
                self::LeisureHotel,
                self::LeisureRestaurant,
                self::LeisureCulturalOuting,
                self::LeisureSport,
                self::LeisureSportWinter,
                self::LeisureTravel,
                self::LeisureVacation,
            ],
            self::Withdrawal => [
                self::WithdrawalCheque,
                self::WithdrawalTransfer,
                self::WithdrawalInternalTransfer,
            ],
            self::Health => [
                self::HealthOther,
                self::HealthDentist,
                self::HealthDoctor,
                self::HealthMutualInsurance,
                self::HealthOptician,
                self::HealthPharmacy,
                self::HealthHospital,
            ],
            default => [],
        };
    }

    public function toTranslation(): TranslatableMessage
    {
        return new TranslatableMessage('app.enum.bank_transaction_category.' . $this->value);
    }
}
