<?php

namespace AppBundle\Controller\Admin;

use AppBundle\Entity\User;
use AppBundle\Form\UserFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/admin")
 * @Security("is_granted('ROLE_ADMIN')") 
 */
class UserAdminController extends Controller
{
  /**
   * @Route("/users", name="admin_users_list")
   */
  public function indexAction()
  {
    $users = $this->getDoctrine()
      ->getRepository('AppBundle:User')
      ->findAll();

    return $this->render('admin/user/list.html.twig', array(
      'users' => $users
    ));
  }

  /**
   * @Route("/user/new", name="admin_user_new")
   */
  public function newAction(Request $request)
  {
    $form = $this->createForm(UserFormType::class);

    // only handles data on POST
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $user = $form->getData();

        if ($user->getPlainPassword() == Null) {
          $this->addFlash('error', 'New users cannot leave password in blank!');
        } else {
          $em = $this->getDoctrine()->getManager();
          $em->persist($user);
          $em->flush();

          $newUser = $user->getName()." (".$user->getEmail().")";

          $this->addFlash('success', "User $newUser created!");

          return $this->redirectToRoute('admin_users_list');
        }
    }

    return $this->render('admin/user/new.html.twig', [
        'userForm' => $form->createView(),
        'passwordLabel' => 'Set password'
    ]);
  }

  /**
   * @Route("/user/{id}/edit", name="admin_user_edit")
   */
  public function editAction(Request $request, User $user)
  {
    $form = $this->createForm(UserFormType::class, $user);

    // only handles data on POST
    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $user = $form->getData();

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $this->addFlash('success', 'User updated!');

        return $this->redirectToRoute('admin_users_list');
    }

    return $this->render('admin/user/edit.html.twig', [
        'userForm' => $form->createView(),
        'passwordLabel' => 'Update password (leave blank to keep previous)'
    ]);
  }
}