<?php
namespace Liquid\Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    public function indexAction()
    {
        return $this->render('LiquidBundle:Page:index.html.twig');
    }
}
