<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;

class AdminController extends AbstractController
{
    /**
     * @Security("is_granted('ROLE_ADMIN') or is_granted('ROLE_SUPER_ADMIN')")
     * @Route("/admin", name="admin")
     */
    public function index(AuthenticationUtils $authenticationUtils)
    {
        $lastUsername = $authenticationUtils->getLastUsername();
        $userRole = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email'=>$lastUsername]);
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'user'=>$userRole
        ]);
    }
}
