<?php

declare(strict_types=1);

namespace App\Domain\Data\ValueObject\BankTransaction;

use Symfony\Component\Translation\TranslatableMessage;

enum Category: string
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
     * @var array<key-of<self>, array{ color: string, icon: string }>
     */
    private const array CONFIGURATION = [
        self::Unknown->name => [
            'color' => 'var(--BankTransactionCategory-Unknown-Color)',
            'icon' => 'mdi:question-mark',
        ],

        self::Subscription->name => [
            'color' => 'var(--BankTransactionCategory-Subscription-Color)',
            'icon' => 'mdi:circle-arrows',
        ],
        self::SubscriptionOther->name => [
            'color' => 'var(--BankTransactionCategory-Subscription-Color)',
            'icon' => 'mdi:refresh',
        ],
        self::SubscriptionInternet->name => [
            'color' => 'var(--BankTransactionCategory-Subscription-Color)',
            'icon' => 'mdi:internet',
        ],
        self::SubscriptionMobileTelephony->name => [
            'color' => 'var(--BankTransactionCategory-Subscription-Color)',
            'icon' => 'mdi:mobile-phone',
        ],
        self::SubscriptionFixedTelephony->name => [
            'color' => 'var(--BankTransactionCategory-Subscription-Color)',
            'icon' => 'mdi:phone-classic',
        ],

        self::PurchasesAndShopping->name => [
            'color' => 'var(--BankTransactionCategory-PurchasesAndShopping-Color)',
            'icon' => 'mdi:shopping-cart',
        ],
        self::PurchasesAndShoppingOther->name => [
            'color' => 'var(--BankTransactionCategory-PurchasesAndShopping-Color)',
            'icon' => 'mdi:shopping',
        ],
        self::PurchasesAndShoppingSport->name => [
            'color' => 'var(--BankTransactionCategory-PurchasesAndShopping-Color)',
            'icon' => 'mdi:soccer',
        ],
        self::PurchasesAndShoppingGift->name => [
            'color' => 'var(--BankTransactionCategory-PurchasesAndShopping-Color)',
            'icon' => 'mdi:gift',
        ],
        self::PurchasesAndShoppingMovie->name => [
            'color' => 'var(--BankTransactionCategory-PurchasesAndShopping-Color)',
            'icon' => 'mdi:movie',
        ],
        self::PurchasesAndShoppingHighTech->name => [
            'color' => 'var(--BankTransactionCategory-PurchasesAndShopping-Color)',
            'icon' => 'mdi:mobile-phone',
        ],
        self::PurchasesAndShoppingLicenses->name => [
            'color' => 'var(--BankTransactionCategory-PurchasesAndShopping-Color)',
            'icon' => 'mdi:qrcode',
        ],
        self::PurchasesAndShoppingBook->name => [
            'color' => 'var(--BankTransactionCategory-PurchasesAndShopping-Color)',
            'icon' => 'mdi:book-open-page-variant',
        ],
        self::PurchasesAndShoppingMusic->name => [
            'color' => 'var(--BankTransactionCategory-PurchasesAndShopping-Color)',
            'icon' => 'mdi:music',
        ],
        self::PurchasesAndShoppingClothing->name => [
            'color' => 'var(--BankTransactionCategory-PurchasesAndShopping-Color)',
            'icon' => 'mdi:tshirt-crew',
        ],

        self::FoodAndGroceries->name => [
            'color' => 'var(--BankTransactionCategory-FoodAndGroceries-Color)',
            'icon' => 'mdi:food-fork-cup',
        ],
        self::FoodAndGroceriesOther->name => [
            'color' => 'var(--BankTransactionCategory-FoodAndGroceries-Color)',
            'icon' => 'mdi:drink',
        ],
        self::FoodAndGroceriesCafe->name => [
            'color' => 'var(--BankTransactionCategory-FoodAndGroceries-Color)',
            'icon' => 'mdi:coffee',
        ],
        self::FoodAndGroceriesFastFood->name => [
            'color' => 'var(--BankTransactionCategory-FoodAndGroceries-Color)',
            'icon' => 'mdi:burger',
        ],
        self::FoodAndGroceriesRestaurant->name => [
            'color' => 'var(--BankTransactionCategory-FoodAndGroceries-Color)',
            'icon' => 'mdi:silverware-fork-knife',
        ],
        self::FoodAndGroceriesSupermarket->name => [
            'color' => 'var(--BankTransactionCategory-FoodAndGroceries-Color)',
            'icon' => 'mdi:shopping-cart',
        ],

        self::Transport->name => [
            'color' => 'var(--BankTransactionCategory-Transport-Color)',
            'icon' => 'mdi:car',
        ],
        self::TransportOther->name => [
            'color' => 'var(--BankTransactionCategory-Transport-Color)',
            'icon' => 'mdi:steering',
        ],
        self::TransportVehicleInsurance->name => [
            'color' => 'var(--BankTransactionCategory-Transport-Color)',
            'icon' => 'mdi:car-insurance',
        ],
        self::TransportPlaneTicket->name => [
            'color' => 'var(--BankTransactionCategory-Transport-Color)',
            'icon' => 'mdi:plane',
        ],
        self::TransportTrainTicket->name => [
            'color' => 'var(--BankTransactionCategory-Transport-Color)',
            'icon' => 'mdi:train',
        ],
        self::TransportFuel->name => [
            'color' => 'var(--BankTransactionCategory-Transport-Color)',
            'icon' => 'mdi:fuel-pump',
        ],
        self::TransportVehicleMaintenance->name => [
            'color' => 'var(--BankTransactionCategory-Transport-Color)',
            'icon' => 'mdi:car-wrench',
        ],
        self::TransportVehicleRental->name => [
            'color' => 'var(--BankTransactionCategory-Transport-Color)',
            'icon' => 'mdi:car-location',
        ],
        self::TransportToll->name => [
            'color' => 'var(--BankTransactionCategory-Transport-Color)',
            'icon' => 'mdi:toll',
        ],
        self::TransportParking->name => [
            'color' => 'var(--BankTransactionCategory-Transport-Color)',
            'icon' => 'mdi:parking',
        ],
        self::TransportPublicTransport->name => [
            'color' => 'var(--BankTransactionCategory-Transport-Color)',
            'icon' => 'mdi:bus',
        ],

        self::Bank->name => [
            'color' => 'var(--BankTransactionCategory-Bank-Color)',
            'icon' => 'mdi:bank',
        ],
        self::BankOther->name => [
            'color' => 'var(--BankTransactionCategory-Bank-Color)',
            'icon' => 'mdi:cash',
        ],
        self::BankMonthlyDebitCard->name => [
            'color' => 'var(--BankTransactionCategory-Bank-Color)',
            'icon' => 'mdi:credit-card',
        ],
        self::BankSavings->name => [
            'color' => 'var(--BankTransactionCategory-Bank-Color)',
            'icon' => 'mdi:piggy-bank',
        ],
        self::BankCharges->name => [
            'color' => 'var(--BankTransactionCategory-Bank-Color)',
            'icon' => 'mdi:calculator-variant-outline',
        ],
        self::BankMortgage->name => [
            'color' => 'var(--BankTransactionCategory-Bank-Color)',
            'icon' => 'mdi:house-off',
        ],
        self::BankPaymentIncident->name => [
            'color' => 'var(--BankTransactionCategory-Bank-Color)',
            'icon' => 'mdi:bank-remove',
        ],
        self::BankLoanRepayment->name => [
            'color' => 'var(--BankTransactionCategory-Bank-Color)',
            'icon' => 'mdi:swap-horizontal',
        ],
        self::BankBankingService->name => [
            'color' => 'var(--BankTransactionCategory-Bank-Color)',
            'icon' => 'mdi:thumb-up',
        ],

        self::Professional->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:briefcase-variant',
        ],
        self::ProfessionalOther->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:briefcase',
        ],
        self::ProfessionalAccounting->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:calculator',
        ],
        self::ProfessionalTip->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:tooltip-edit-outline',
        ],
        self::ProfessionalSocialContribution->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:hand-coin',
        ],
        self::ProfessionalOfficeSupplies->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:desk-lamp',
        ],
        self::ProfessionalShippingCosts->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:postage-stamp',
        ],
        self::ProfessionalPrintingCosts->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:printer',
        ],
        self::ProfessionalRecruitmentCosts->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:people-group',
        ],
        self::ProfessionalLegalFees->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:court-hammer',
        ],
        self::ProfessionalOfficeMaintenance->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:vacuum-cleaner',
        ],
        self::ProfessionalMarketing->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:chart-line',
        ],
        self::ProfessionalExpenseReport->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:file-check-outline',
        ],
        self::ProfessionalPension->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:binoculars',
        ],
        self::ProfessionalAdvertising->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:ads',
        ],
        self::ProfessionalExecutiveCompensation->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:tie',
        ],
        self::ProfessionalSalary->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:account-cash',
        ],
        self::ProfessionalOnlineService->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:at',
        ],
        self::ProfessionalOutsourcing->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:notebook-check',
        ],
        self::ProfessionalApprenticeshipTax->name => [
            'color' => 'var(--BankTransactionCategory-Professional-Color)',
            'icon' => 'mdi:book-education',
        ],

        self::Various->name => [
            'color' => 'var(--BankTransactionCategory-Various-Color)',
            'icon' => 'mdi:folder-question',
        ],
        self::VariousOther->name => [
            'color' => 'var(--BankTransactionCategory-Various-Color)',
            'icon' => 'mdi:folder-question',
        ],
        self::VariousInsurance->name => [
            'color' => 'var(--BankTransactionCategory-Various-Color)',
            'icon' => 'mdi:umbrella',
        ],
        self::VariousDonation->name => [
            'color' => 'var(--BankTransactionCategory-Various-Color)',
            'icon' => 'mdi:charity',
        ],
        self::VariousPressing->name => [
            'color' => 'var(--BankTransactionCategory-Various-Color)',
            'icon' => 'mdi:clothes-hanger',
        ],
        self::VariousPayPal->name => [
            'color' => 'var(--BankTransactionCategory-Various-Color)',
            'icon' => 'ic:baseline-paypal',
        ],

        self::AestheticAndCare->name => [
            'color' => 'var(--BankTransactionCategory-AestheticAndCare-Color)',
            'icon' => 'mdi:face-man-shimmer',
        ],
        self::AestheticAndCareOther->name => [
            'color' => 'var(--BankTransactionCategory-AestheticAndCare-Color)',
            'icon' => 'mdi:shimmer',
        ],
        self::AestheticAndCareCosmetics->name => [
            'color' => 'var(--BankTransactionCategory-AestheticAndCare-Color)',
            'icon' => 'mdi:lipstick',
        ],
        self::AestheticAndCareHair->name => [
            'color' => 'var(--BankTransactionCategory-AestheticAndCare-Color)',
            'icon' => 'mdi:scissors',
        ],
        self::AestheticAndCareEsthetic->name => [
            'color' => 'var(--BankTransactionCategory-AestheticAndCare-Color)',
            'icon' => 'mdi:eye',
        ],
        self::AestheticAndCareSpaAndMassage->name => [
            'color' => 'var(--BankTransactionCategory-AestheticAndCare-Color)',
            'icon' => 'mdi:spa',
        ],

        self::TaxesAndDuties->name => [
            'color' => 'var(--BankTransactionCategory-TaxesAndDuties-Color)',
            'icon' => 'tabler:laurel-wreath-filled',
        ],
        self::TaxesAndDutiesOther->name => [
            'color' => 'var(--BankTransactionCategory-TaxesAndDuties-Color)',
            'icon' => 'mdi:gauge',
        ],
        self::TaxesAndDutiesFines->name => [
            'color' => 'var(--BankTransactionCategory-TaxesAndDuties-Color)',
            'icon' => 'mdi:home',
        ],
        self::TaxesAndDutiesPropertyTax->name => [
            'color' => 'var(--BankTransactionCategory-TaxesAndDuties-Color)',
            'icon' => 'mdi:file-star',
        ],
        self::TaxesAndDutiesIncomeTax->name => [
            'color' => 'var(--BankTransactionCategory-TaxesAndDuties-Color)',
            'icon' => 'mdi:badge',
        ],
        self::TaxesAndDutiesVat->name => [
            'color' => 'var(--BankTransactionCategory-TaxesAndDuties-Color)',
            'icon' => 'mdi:dots-circle',
        ],

        self::Housing->name => [
            'color' => 'var(--BankTransactionCategory-Housing-Color)',
            'icon' => 'mdi:home',
        ],
        self::HousingOther->name => [
            'color' => 'var(--BankTransactionCategory-Housing-Color)',
            'icon' => 'mdi:lightbulb',
        ],
        self::HousingHomeInsurance->name => [
            'color' => 'var(--BankTransactionCategory-Housing-Color)',
            'icon' => 'mdi:shield-home',
        ],
        self::HousingMiscellaneousExpenses->name => [
            'color' => 'var(--BankTransactionCategory-Housing-Color)',
            'icon' => 'mdi:wrench',
        ],
        self::HousingDecoration->name => [
            'color' => 'var(--BankTransactionCategory-Housing-Color)',
            'icon' => 'mdi:image-frame',
        ],
        self::HousingWater->name => [
            'color' => 'var(--BankTransactionCategory-Housing-Color)',
            'icon' => 'mdi:water',
        ],
        self::HousingElectricity->name => [
            'color' => 'var(--BankTransactionCategory-Housing-Color)',
            'icon' => 'mdi:electricity',
        ],
        self::HousingMaintenance->name => [
            'color' => 'var(--BankTransactionCategory-Housing-Color)',
            'icon' => 'mdi:format-paint',
        ],
        self::HousingOutdoorAndGarden->name => [
            'color' => 'var(--BankTransactionCategory-Housing-Color)',
            'icon' => 'mdi:pine-tree',
        ],
        self::HousingGas->name => [
            'color' => 'var(--BankTransactionCategory-Housing-Color)',
            'icon' => 'mdi:gas',
        ],
        self::HousingRent->name => [
            'color' => 'var(--BankTransactionCategory-Housing-Color)',
            'icon' => 'mdi:home',
        ],

        self::Leisure->name => [
            'color' => 'var(--BankTransactionCategory-Leisure-Color)',
            'icon' => 'mdi:rocket-launch',
        ],
        self::LeisureOther->name => [
            'color' => 'var(--BankTransactionCategory-Leisure-Color)',
            'icon' => 'mdi:sparkles',
        ],
        self::LeisureBarAndClub->name => [
            'color' => 'var(--BankTransactionCategory-Leisure-Color)',
            'icon' => 'mdi:local-bar',
        ],
        self::LeisureEntertainment->name => [
            'color' => 'var(--BankTransactionCategory-Leisure-Color)',
            'icon' => 'mdi:gamepad-classic',
        ],
        self::LeisurePetExpenses->name => [
            'color' => 'var(--BankTransactionCategory-Leisure-Color)',
            'icon' => 'mdi:cat',
        ],
        self::LeisureHobby->name => [
            'color' => 'var(--BankTransactionCategory-Leisure-Color)',
            'icon' => 'mdi:cards-spade',
        ],
        self::LeisureHotel->name => [
            'color' => 'var(--BankTransactionCategory-Leisure-Color)',
            'icon' => 'mdi:hotel',
        ],
        self::LeisureRestaurant->name => [
            'color' => 'var(--BankTransactionCategory-Leisure-Color)',
            'icon' => 'mdi:silverware-fork-knife',
        ],
        self::LeisureCulturalOuting->name => [
            'color' => 'var(--BankTransactionCategory-Leisure-Color)',
            'icon' => 'mdi:eiffel-tower',
        ],
        self::LeisureSport->name => [
            'color' => 'var(--BankTransactionCategory-Leisure-Color)',
            'icon' => 'mdi:soccer',
        ],
        self::LeisureSportWinter->name => [
            'color' => 'var(--BankTransactionCategory-Leisure-Color)',
            'icon' => 'mdi:ski',
        ],
        self::LeisureTravel->name => [
            'color' => 'var(--BankTransactionCategory-Leisure-Color)',
            'icon' => 'mdi:bag-suitcase',
        ],
        self::LeisureVacation->name => [
            'color' => 'var(--BankTransactionCategory-Leisure-Color)',
            'icon' => 'mdi:white-balance-sunny',
        ],

        self::Withdrawal->name => [
            'color' => 'var(--BankTransactionCategory-Withdrawal-Color)',
            'icon' => 'mdi:credit-card',
        ],
        self::WithdrawalCheque->name => [
            'color' => 'var(--BankTransactionCategory-Withdrawal-Color)',
            'icon' => 'mdi:sign',
        ],
        self::WithdrawalTransfer->name => [
            'color' => 'var(--BankTransactionCategory-Withdrawal-Color)',
            'icon' => 'mdi:bank-transfer-out',
        ],
        self::WithdrawalInternalTransfer->name => [
            'color' => 'var(--BankTransactionCategory-Withdrawal-Color)',
            'icon' => 'mdi:bank-transfer-in',
        ],

        self::Health->name => [
            'color' => 'var(--BankTransactionCategory-Health-Color)',
            'icon' => 'mdi:hospital',
        ],
        self::HealthOther->name => [
            'color' => 'var(--BankTransactionCategory-Health-Color)',
            'icon' => 'mdi:heart-pulse',
        ],
        self::HealthDentist->name => [
            'color' => 'var(--BankTransactionCategory-Health-Color)',
            'icon' => 'mdi:tooth-outline',
        ],
        self::HealthDoctor->name => [
            'color' => 'var(--BankTransactionCategory-Health-Color)',
            'icon' => 'mdi:stethoscope',
        ],
        self::HealthMutualInsurance->name => [
            'color' => 'var(--BankTransactionCategory-Health-Color)',
            'icon' => 'healthicons:pharmacy',
        ],
        self::HealthOptician->name => [
            'color' => 'var(--BankTransactionCategory-Health-Color)',
            'icon' => 'mdi:glasses',
        ],
        self::HealthPharmacy->name => [
            'color' => 'var(--BankTransactionCategory-Health-Color)',
            'icon' => 'mdi:capsule',
        ],
        self::HealthHospital->name => [
            'color' => 'var(--BankTransactionCategory-Health-Color)',
            'icon' => 'mdi:hospital-building',
        ],
    ];

    /**
     * @return Category[]
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
     * @return Category[]
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

    public function getIcon(): string
    {
        return self::CONFIGURATION[$this->name]['icon'];
    }

    public function getColor(): string
    {
        return self::CONFIGURATION[$this->name]['color'];
    }
}
