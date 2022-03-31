<?php
namespace App\Controller;

 /**
  * name src/Controller/FirstController.php
  */
  
  use Symfony\Component\HttpFoundation\Response;
  use Symfony\Component\Routing\Annotation\Route;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

  class FirstController extends AbstractController {

      /**
       * @Route("/hello")
       */
      public function sayHello(): Response {
          //return new Response(
          //    '<html><body>Hello Jean-Luc</body></html>'
          //);
          return $this->render(
              'hello/hello.html.twig', // Nom du template à charger (vue)
              [
                  'name' => 'Jean-Luc' // Modèle dans le MVC
              ]
          );
      }
  }