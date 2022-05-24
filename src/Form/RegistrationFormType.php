<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void

    {
        $builder
            ->add('login', TextType::class, [
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Имя пользователя не должно быть короче 5 символов!',
                        'max' => 50,
                        'maxMessage' => 'Имя пользователя не должно быть длиннее 50 символов!'
                    ]),
                ],
                'label' => 'Логин пользователя',
            ])
            ->add('password', RepeatedType::class, [
                'required' => true,
                'mapped' => false,
                'type' => PasswordType::class,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Пароль не должен быть пустым!'
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Пароль не должен быть короче 5 символов!',
                        'max' => 50,
                        'maxMessage' => 'Пароль не должен быть длиннее 50 символов!',
                    ])
                ],
                'first_options' => [
                    'label' => 'Пароль',
                ],
                'second_options' => [
                    'label' => 'Повторите пароль',
                ],
                'invalid_message' => 'Пароли не совпадают!',
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'constraints' => [
                    new Email([
                        'message' => 'Введите электронную почту!'
                    ]),
                    new NotBlank([
                        'message' => 'email не должен быть пустым!'
                    ]),
                    new Length([
                        'min' => 5,
                        'minMessage' => 'Длина email не должна быть меньше {{ limit }} символов!',
                        'max' => 30,
                        'maxMessage' => 'Длина email не должна быть боьльше {{ limit }} симовлов!'
                    ])
                ]
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Номер телефона не может быть короче {{ limit }} символов!',
                        'max' => 50,
                        'maxMessage' => 'Номер телефона не может быть длиннее {{ limit }} символов!'
                    ])
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'required' => true,
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Необходимо согласиться с использованием персональных данных!',
                    ]),
                ],
                'label' => 'Я согласен с использованием моих персональных данных',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
