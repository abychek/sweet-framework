<?php

namespace SweetFramework\Controllers;

use Doctrine\ORM\EntityManager;
use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MainController
{

    /** @var Container $container */
    private $container;
    /** @var EntityManager $em */
    private $em;

    function __construct($container)
    {
        $this->container = $container;
        $this->em = $this->container['doctrine.em'];
    }

    public function renderAction(Request $request)
    {
        return new Response($this->container['template_engine']->render('main.html', array()));
    }

    public function loginAction(Request $request)
    {
        return new Response($this->container['template_engine']->render('profile.html', array()));
    }

    public function registerAction(Request $request)
    {
        $userRepository = $this->em->getRepository('SweetFramework\Entity\User');

        if ($userRepository->findBy(array('email' => $request->request->get('email')))) {
            return new Response($this->container['template_engine']->render('error.html', array('error' => "User with this email already exists!")));

        } else {
            /** @var \SweetFramework\Entity\User $user */
            $user = new \SweetFramework\Entity\User();

            $user->setFirstName($request->request->get('firstname'));
            $user->setLastName($request->request->get('lastname'));
            $user->setEmail($request->request->get('email'));
            $user->setPassword($request->request->get('password'));
            $user->setHash(substr(md5(rand(1000, 9999999)), 0, 6));

            $this->em->persist($user);
            $this->em->flush();

            $users = $userRepository->findAll();
            return new Response($this->container['template_engine']->render('profile.html', array('users' => $users)));
        }
    }

    public function logoutAction(Request $request)
    {

        return new Response($this->container['template_engine']->render('main.html', array()));
    }

    public function forgotAction(Request $request)
    {
        return new Response($this->container['template_engine']->render('forgot.html', array()));
    }
}