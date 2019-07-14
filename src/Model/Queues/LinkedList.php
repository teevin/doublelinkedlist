<?php

namespace  App\Model\Queues;

use App\Model\Queues\Node;
use App\Model\Queues\LinkedListInterface;
/**
 * class LinkedList
 * Doubly Ended Que has it's toe pinting to the header
 * Should Implement the defined methods
 */
class LinkedList implements LinkedListInterface
{

  // counter number of nodes in list
  private $counter;
  //variable to track the head of list
  private $front;
  //variable to track the back of the list
  private $back;
  //all the nodes that have been created
  private $nodes = [];

  function __construct()
  {
    $this->counter = 0;
    $this->front = null;
    $this->back = null;
  }


  public function Prepend(Node $node)
  {
    if ($this->front === null) {
      $this->back = $this->front = &$node;
    }
    else {
      //set the new node next to the front
      $node->setNext($this->front);
      //set the previous of the current front to the node
      $this->front->setPrevious($node);
      //set the new front
      $this->front = &$node;
    }
    //track items in the list
    array_unshift($this->nodes, $node);
    $this->counter ++;
  }

  public function Append(Node $node)
  {
    //recursive instantiate with prepend
    if ($this->back === null) {
      $this->Prepend($node);
      return;
    }
    //set back next to node
    $this->back->setNext($node);
    //set node previous to current back
    $node->setPrevious($this->back);
    //set new back
    $this->back = &$node;
    // track linked list
    $this->nodes[] = $node;
    $this->counter ++;
  }

  public function Pop()
  {
    if($this->counter > 0){
      $node_remove = $this->front;
      //set front to the next node of the first node
      $this->front = $this->front->getNext();
      //update the front previous to point to the last node
      if($this->front !== null){
        $this->front->setPrevious(null);
      }
      else{
        $this->back = null;
      }
      //update the last node to the first node
      //$this->back->setNext($this->front);
      //decrement counter
      $this->counter --;
      array_shift($this->nodes);
    }
  }

  public function Eject()
  {
    if ($this->counter > 0) {
      $node_remove = $this->back;
      //set back to previous node of the last node
      $this->back = $this->back->getPrevious();
      //update back next to point to the front node
      if($this->back !== null){
        $this->back->setNext(null);
      }
      else{
        $this->front = null;
      }
      //update the front node previous to point the last node
      //$this->front->setPrevious($this->back);
      //decrement counter
      $this->counter --;
      array_pop($this->nodes);
    }
  }

  public function getCounter()
  {
    return  $this->counter;
  }

  public function getNodesData()
  {
    $result = [];
    foreach ($this->nodes as $node) {
      $result[] = $node->getData();
    }
    return $result;
  }

  public function getNodes()
  {
    return $this->nodes;
  }

  public function countConfirm()
  {
    return $this->counter == count($this->nodes);
  }

  public function getFront(){
    return $this->front;
  }

  public function getBack(){
    return $this->back;
  }
}
