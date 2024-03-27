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
     * Insert a new node after given node
     */
    public function insertAfter(mixed $data, Node $givenNode): Node
    {
        $newNode = new Node($data);


        // 1. Set newNode's next pointer to givenNode's next pointer
        $newNode->next = $givenNode->next;

        // if we've inserted it at the end of the list
        // set tail to newNode
        if ($newNode->next == null) {
            $this->tail = $newNode;
        }

        // 2. Set newNode's previous pointer to givenNode
        $newNode->previous = $givenNode;

        // 3. Set nextNode's previous pointer to newNode
        // Check if givenNode's next is set.
        // if its null we're at the end of the list
        if ($givenNode->next) {
            $givenNode->next->previous = $newNode;
            // the above line may seem a little weird.
            // We could rewrite it like this to be clearer:
            // $nextNode = $givenNode->next;
            // $nextNode->previous = $newNode;

        }
        // 3. Set givenNode's next pointer to newNode
        $givenNode->next = $newNode;


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

// just a cheat to add our first node into the linked list here
// for our tests..

$firstNode = new Node("one");
$linkedList->head = $firstNode;
$linkedList->tail = $firstNode;


$threeNode = $linkedList->insertAfter(data: "three", givenNode: $firstNode);

$twoNode = $linkedList->insertAfter(data: "two", givenNode: $firstNode);

$fourNode = $linkedList->insertAfter(data: "four", givenNode: $threeNode);


$currentNode = $linkedList->head;
while ($currentNode != null) {
    print $currentNode->data."\r\n";
    $currentNode = $currentNode->next;
}
print "done";