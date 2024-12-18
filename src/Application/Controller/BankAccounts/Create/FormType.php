<?php

declare(strict_types=1);

namespace App\Application\Controller\BankAccounts\Create;

use App\Domain\Data\Model\Bank;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @extends AbstractType<FormModel>
 */
final class FormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('bank', EntityType::class, [
                'class' => Bank::class,
                'choice_label' => static fn (Bank $bank): string => $bank->getId()->toString(),
                'choice_value' => static fn (?Bank $bank): string => $bank?->getId()->toString() ?? '',
            ])
            ->add('label', TextType::class, [
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormModel::class,
        ]);
    }
}
