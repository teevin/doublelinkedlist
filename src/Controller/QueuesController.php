<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Movie controller.
 * @Route("/api", name="api_")
 */
class QueuesController extends FOSRestController
{
  /**
   * Add Node to begging to queue.
   * @Rest\Get("/dequeue/prepend")
   *
   * @return Response
   */
  public function Prepend()
  {

    return 'Prepend';
  }
  /**
   * Create Movie.
   * @Rest\Post("/dequeue/append")
   *
   * @return Response
   */
  public function Append(Request $request)
  {
    return 'Append';
  }
  /**
   * Add Node to begging to queue.
   * @Rest\Delete("/dequeue/pop")
   *
   * @return Response
   */
  public function Pop()
  {
    return 'Pop';
  }
  /**
   * Add Node to begging to queue.
   * @Rest\Delete("/dequeue/eject")
   *
   * @return Response
   */
  public function Eject()
  {
    return 'Eject';
  }
}
