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

$firstNode = $linkedList->unshift("one");

$threeNode = $linkedList->push(data: "three",);

$twoNode = $linkedList->insertAfter(data: "two", givenNode: $firstNode);


$currentNode = $linkedList->head;
while ($currentNode != null) {
    print $currentNode->data."\r\n";
    $currentNode = $currentNode->next;
}
print "done";