<?php

namespace AppBundle\Controller\Dashboard;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/dashboard")
 * @Security("is_granted('ROLE_USER')") 
 */
class DashboardController extends Controller
{
  /**
   * @Route("/", name="dashboard_home")
   */
  public function indexAction(Request $request)
  {
    return $this->render('dashboard/layout.html.twig');
  }
}