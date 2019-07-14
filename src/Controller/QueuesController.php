<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Model\Queues\LinkedList;
use App\Model\Queues\Node;
/**
 * Queues controller.
 * @Route("/api", name="api_")
 */
class QueuesController extends FOSRestController
{
  private $list;
  private $session;
  public function __construct(SessionInterface $session)
  {
    $this->session = $session;
    $this->list = $this->getSessionLinkedList();
  }
  /**
   * Add Node to begging to queue.
   * @Rest\Post("/dequeue/prepend")
   *
   * @return Response
   */
  public function actionPrepend(Request $request)
  {
    $data = $request->query->get('input');
    if(isset($data)){
      $this->list->Prepend(new Node($data));
      $this->setSessionLinkedList($this->list);
    }
    return "nodes in list " . $this->list->getCounter();
  }
  /**
   * Add Node to the end of queue.
   * @Rest\Post("/dequeue/append")
   *
   * @return Response
   */
  public function actionAppend(Request $request)
  {
    $data = $request->query->get('input');
    if(isset($data)){
      $this->list->Append(new Node($data));
      $this->setSessionLinkedList($this->list);
    }
    return "nodes in list " . $this->list->getCounter();
  }
  /**
   * Add Node to begging to queue.
   * @Rest\Delete("/dequeue/pop")
   *
   * @return Response
   */
  public function actionPop()
  {
    $this->list->Pop();
    $this->setSessionLinkedList($this->list);
    return "nodes in list " . $this->list->getCounter();
  }
  /**
   * Add Node to begging to queue.
   * @Rest\Delete("/dequeue/eject")
   *
   * @return Response
   */
  public function actionEject()
  {
    $this->list->Eject();
    $this->setSessionLinkedList($this->list);
    return "nodes in list " . $this->list->getCounter();
  }
  /**
   * Add Node to begging to queue.
   * @Rest\Get("/dequeue/show")
   *
   * @return Response
   */
  public function actionShow(Request $request)
  {
    $data = $this->list->getNodesData();
    $order = $request->query->get('order');
    switch ($order) {
      case 'asc':
        sort($data);
        break;

      case 'desc':
        rsort($data);
        break;
    }
    return $data;
  }
  /**
    * Get LinkedList from session
    * Esle create a new List
    */
  public function getSessionLinkedList(){
    if($this->session->get('linkedlist',false)){
      $list = $this->session->get('linkedlist');
    }
    else{
      $list = new LinkedList();
    }
    return $list;
  }
  /**
   *Save Current LinkedList to SEssion
   *
   */
  public function setSessionLinkedList($value)
  {
    $this->session->set('linkedlist',$value);
    return $this->session->get('linkedlist');
  }
}
