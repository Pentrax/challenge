<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 *
 *  PRODUCTS CONTROLLER
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index(): Response
    {
        /**  */
    }


    public function getFile (){
            /**
             * get Json File
             */
    }

    public function store(){
        /** if exist (llega el File ())( */


    }

    public function sendToClient(){
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DefaultController.php',
        ]);
    }

    public function sendCsvToServer(){


    }


    private function log(){

    }




}
