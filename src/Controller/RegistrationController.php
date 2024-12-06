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
