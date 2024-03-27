<?php

/**
 * requires PHP >= 8.1
 * 
 */

class LinkedList
{
    public $head = null;
    public $tail = null;

    /**
     * Insert a new node at the end of the list
     */
    public function push(mixed $data): Node
    {
        $newNode = new Node($data);


        if ($this->tail) {
            // The list is not empty

            // 1. Set the previous pointer of the new node to tail
            $newNode->previous = $this->tail;

            // 2. Set the next pointer of our tail node to the new node
            $this->tail->next = $newNode;
        }

        // 3. Set the tail pointer to the new node
        $this->tail = $newNode;


        // 4. Set the next pointer of the new node to null
        $newNode->next = null;

        if ($this->head == null) {
            // This is the only item, point head to it:
            $this->head = $newNode;
        }

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

$node = $linkedList->push(data: "Data added first");

print "\r\nLinked List:\r\n";
print_r($linkedList);

print "\r\n-----------\r\n";
print "\r\nNode: \r\n";
print_r($node);

print "\r\n===========\r\n";

$node = $linkedList->push(data: "data added second");

print "\r\nLinked List:\r\n";
print_r($linkedList);

print "\r\n-----------\r\n";
print "\r\nNode: \r\n";
print_r($node);

