<?php

namespace Teleforge\Queue;


require_once __DIR__.'/LinkedList.php';
require_once __DIR__.'/Node.php';
// use Teleforge\Queue\LinkedList;
// use Teleforge\Queue\Node;
  $list = new LinkedList();
  //$node = new Node(10);
  //append 10, prepend 5, prepend 90, append 63, prepend 0, pop, prepend 69, eject,
  //pop, show
  $list->Append(new Node(10));
  $list->Prepend(new Node(5));
  $list->Prepend(new Node(90));
  $list->Append(new Node(63));
  $list->Prepend(new Node(0));
  $list->Pop();
  $list->Prepend(new Node(69));
  $list->Eject();
  $list->Pop();
