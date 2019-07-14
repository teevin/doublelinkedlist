<?php

namespace App\Model\Queues;;

/**
 * functions the LinkedList should Implement
 */
interface LinkedListInterface
{
  //Insert at the front
  public function Prepend(Node $node);
  //Remove the first element
  public function Pop();
  //Insert at the back
  public function Append(Node $node);
  //Remove the last element
  public function Eject();

}
