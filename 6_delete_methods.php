<?php

/**
 * requires PHP >= 8.1
 * 
 */

class LinkedList
{
    public $head = null;
    public $tail = null;

    

    ///////////////////////////////////////////////////////////////////
    //
    // INSERTION
    //
    ///////////////////////////////////////////////////////////////////

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


    ///////////////////////////////////////////////////////////////////
    //
    // DELETIONS
    //
    ///////////////////////////////////////////////////////////////////

    public function shift(): Node
    {
        
        if ($this->head === null) {
            throw new Exception("Can't delete from empty list!");
        }

        $returnNode = $this->head;

        // 1. Set head to the node pointed to by head's next pointer
        $this->head = $this->head->next;

        // 2. Set the previous pointer new head to null.
        $this->head->previous = null;

        return $returnNode;

    }


    public function pop(): Node
    {
        if ($this->tail == null) {
            throw new Exception("Can't delete from empty list!");
        }

        $returnNode = $this->tail;

        // 1. Set tail to the node pointed to by tail's previous pointer
        $this->tail = $this->tail->previous;

        // 2. Set the next pointer new tail to null.
        $this->tail->next = null;

        return $returnNode;
        
    }



    public function delete($value): Node|null
    {
        if ($this->tail == null) {
            throw new Exception("Can't delete from empty list!");
        }

        // 1. Create a Node variable called CurrentNode and set it to head
        $currentNode = $this->head;
        while ($currentNode != null) {
           
            // 3. If CurrentNode->data does match our search string then
            if ($currentNode->data == $value) {    
             
                // 4. Set next pointer of node pointed to by CurrentNode's 
                //    previous pointer to CurrentNode's next pointer.
                $currentNode->previous->next = $currentNode->next;

                // 5. Set previous pointer of the node pointed to by 
                //    CurrentNode's next pointer to CurrrentNode's previous pointer.
                $currentNode->next->previous = $currentNode->previous;

                return $currentNode;
            }

            $currentNode = $currentNode->next;
        }

        return null;
        
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

$linkedList->push("one");
$linkedList->push("two");
$linkedList->push("three");
$linkedList->push("four");
$linkedList->push("five");


// Delete from the front of the list
$linkedList->shift();

// Delete from the end of the list
$linkedList->pop();

// Delete where the value is three
$linkedList->delete("three");

// show the list, should be two, four
$currentNode = $linkedList->head;
while ($currentNode != null) {
    print $currentNode->data."\r\n";
    $currentNode = $currentNode->next;
}



