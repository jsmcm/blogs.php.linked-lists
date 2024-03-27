<?php

/**
 * requires PHP >= 8.1
 * 
 * This code works only for an empty list when we're inserting 
 * at the beginning of this empty list. If we call insert again
 * it will insert the new node at the beginning but because
 * we're not handling the next pointer well it will set
 * it to null, indicating that there are no more nodes.
 * We'll fix this in 2_insert_at_beginning_empty_or_not.php
 */

class LinkedList
{
    private $head = null;
    private $tail = null;

    /**
     * Insert a new node at the beginning of the list
     */
    public function unshift(mixed $data): Node
    {
        $newNode = new Node($data);

        // We are inserting at the beginning of the list

        // 1. Set the head pointer to the new node
        $this->head = $newNode;

        // 2. Set the previous pointer in the node to null to indicate that its the first item
        $newNode->previous = null;


        // 3. Set the next pointer in the node to null to indicate that its the last item
        $newNode->next = null;


        // 4. Set the tail pointer to the new node
        $this->tail = $newNode;
    

        return $newNode;

    }
}

class Node
{

    public $previous   = null;
    public $next       = null;

    public function __construct(public mixed $data)
    {

    }

}

$linkedList = new LinkedList();

$node = $linkedList->unshift(data: "hello there");

print "\r\nLinked List:\r\n";
print_r($linkedList);

print "\r\n-----------\r\n";
print "\r\nNode: \r\n";
print_r($node);

