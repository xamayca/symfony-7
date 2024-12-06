## 9. Enregistrement des utilisateurs (Formulaire)

Nous allons maintenant configurer le formulaire d'enregistrement avec les champs nécessaires.

Ouvrez le fichier `src/Form/RegistrationFormType.php` qui correspond à votre formulaire.

```php
<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('username')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
```

Dans ce formulaire, nous avons lié les champs aux propriétés de l'entité User, telles que : `email`, `roles`, `password` et `username`.

> 🗒️ **Remarque** :
> - `createdAt` et `roles` sont des propriétés qui seront automatiquement renseignées lors de l'enregistrement de l'utilisateur, sans nécessiter d'entrée dans le formulaire.
> #### ⚠️ Nous gérerons ces données dans le contrôleur `RegistrationController` afin de simplifier le formulaire et de nous concentrer sur les informations essentielles.

---

### Modification des champs du formulaire

> 📌 **Pour en savoir plus sur les champs des formulaires, consultez la documentation officielle de [Symfony (FormType)](https://symfony.com/doc/current/reference/forms/types/form.html).**

Nous allons maintenant ajouter les champs dont nous avons besoin dans notre formulaire :

```php
<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'mapped' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom d\'utilisateur'
                ],
            ])
            ->add('email', EmailType::class, [
                'mapped' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Email'
                ]
            ])
            ->add('password', repeatedType::class, [
                'mapped' => true,
                'type' => PasswordType::class,
                'first_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Confirmez le mot de passe'
                    ]
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'required' => true,
                'label' => 'J\'accepte les termes et conditions',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
```

Notre formulaire est maintenant prêt, nous y avons ajouté les champs suivants :

- **`username`** : Un champ de type `TextType` pour le nom d'utilisateur, avec un placeholder "Nom d'utilisateur".
- **`email`** : Un champ de type `EmailType` pour l'email de l'utilisateur, avec un placeholder "Email".
- **`password`** : Un champ de type `RepeatedType`, avec deux champs `PasswordType` pour permettre à l'utilisateur de saisir et confirmer son mot de passe. Le premier champ a un placeholder "Mot de passe" et le second "Confirmez le mot de passe".
- **`agreeTerms`** : Un champ de type `CheckboxType` pour que l'utilisateur accepte les termes et conditions avant de soumettre le formulaire. Ce champ n'est pas lié à l'entité `User` (d'où `mapped => false`) et est requis.
- **`submit`** : Un bouton de soumission pour l'inscription, avec l'étiquette "S'inscrire".

Ces modifications ajoutent les champs nécessaires pour l'inscription d'un utilisateur, tout en personnalisant les libellés et les placeholders pour offrir une meilleure expérience utilisateur.

> 🗒️ **Remarque** :
>
> - Nous avons utilisé l'option `mapped => true` pour les champs `username`, `email` et `password` car ces champs sont directement liés à l'entité `User`.
> - Cela permet à Symfony de lier les valeurs saisies dans le formulaire aux propriétés correspondantes de l'entité `User` lors de la soumission du formulaire.
> - Le champ `agreeTerms` a été défini avec `mapped => false` car il ne correspond pas à une propriété de l'entité `User`.
> - Il est uniquement utilisé pour vérifier si l'utilisateur accepte les termes et conditions avant de soumettre le formulaire.

---

### Affichage du formulaire

Pour avoir un aperçu de notre formulaire, ouvrez le fichier `src/Controller/RegistrationController.php`

Puis modifier le de cette façon :

```php
<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/registration', name: 'app_registration')]
    public function index(): Response
    {

        $registrationForm = $this->createForm(RegistrationFormType::class);

        return $this->render('registration/index.html.twig', [
            'registrationForm' => $registrationForm,
            'controller_name' => 'RegistrationController',
        ]);
    }
}
```

Ici, nous avons :

- **Créer le formulaire** : Avec `$this->createForm(RegistrationFormType::class)`, nous générons le formulaire lié à l'entité `User`.
- **Passer le formulaire à la vue** : Nous envoyons le formulaire au template Twig via `'registrationForm'` en utilisant `$registrationForm->createView()` pour le rendre dans la vue.

Maintenant, ouvrez le fichier `templates/registration/index.html.twig` et modifiez-le comme suit :
```php
{% extends 'base.html.twig' %}

{% block title %}Hello RegistrationController!{% endblock %}

{% block body %}
    
    {{ form(registrationForm) }}

{% endblock %}
```

Nous utilisons `{{ form(registrationForm) }}` pour rendre automatiquement le formulaire dans le template.

Cette fonction génère le HTML nécessaire pour afficher le formulaire créé dans le contrôleur.

Rendez-vous ensuite à l'URL `http://127.0.0.1:8000/registration` pour voir le formulaire en action.

---