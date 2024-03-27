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
     * Insert a new node at the beginning of the list
     */
    public function unshift(mixed $data): Node
    {
        $newNode = new Node($data);

        // check if this list has items already?
        if ($this->head != null) {

            // its not an empty list

            // 1. Set the previous pointer of the node currently at head to our new node
            $this->head->previous = $newNode;

            // 2. Set the next pointer of our new node to head
            $newNode->next = $this->head;
        }

        // 3. Set the head pointer to the new node
        $this->head = $newNode;

        // 4. Set the previous pointer in the new node to null to indicate that its the first item.
        $newNode->previous = null;

        if ($this->tail == null) {
            // This is the only item, point tail to it:
            $this->tail = $newNode;
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

$node = $linkedList->unshift(data: "hello there");

print "\r\nLinked List:\r\n";
print_r($linkedList);

print "\r\n-----------\r\n";
print "\r\nNode: \r\n";
print_r($node);


$node = $linkedList->unshift(data: "hi again");

print "\r\nLinked List:\r\n";
print_r($linkedList);

print "\r\n-----------\r\n";
print "\r\nNode: \r\n";
print_r($node);

