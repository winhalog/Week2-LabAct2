
<?php

// Class Book
class Book {
    public $title;
    protected $author;
    private $price;

    // Constructor to initialize the book's title, author, and price
    public function __construct($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

    // Method to get details of the book
    public function getDetails() {
        return "Title: {$this->title}, Author: {$this->author}, Price: $" . number_format($this->price, 2);
    }

    // Method to set or update the price of the book
    public function setPrice($price) {
        $this->price = $price;
    }

    // Magic method to handle calls to non-existent methods
    public function __call($name, $arguments) {
        // Example of handling updateStock method
        if ($name == 'updateStock') {
            echo "Stock updated for '{$this->title}' with arguments: {$arguments[0]}<br>";
        } else {
            echo "Method '$name' does not exist.<br>";
        }
    }
}

// Class Library
class Library {
    public $name;
    private $books = [];

    // Constructor to initialize the library with a name
    public function __construct($name) {
        $this->name = $name;
    }

    // Method to add a book to the library
    public function addBook(Book $book) {
        $this->books[$book->title] = $book;
    }

    // Method to remove a book from the library by title
    public function removeBook($title) {
        if (isset($this->books[$title])) {
            unset($this->books[$title]);
            echo "Book '$title' removed from the library.<br>";
        } else {
            echo "Book '$title' not found in the library.<br>";
        }
    }

    // Method to list all books in the library
    public function listBooks($afterRemoval = false) {
        if ($afterRemoval) {
            echo "Books in the library after removal:<br>";
        } else {
            echo "Books in the library:<br>";
        }
        foreach ($this->books as $book) {
            echo $book->getDetails() . "<br>";
        }
    }

    // Destructor to clear the library
    public function __destruct() {
        echo "The library '{$this->name}' is now closed.<br>";
    }
}

// Implementation

// Create instances of Book
$book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", 10.99);
$book2 = new Book("1984", "George Orwell", 8.99);

// Create an instance of Library
$library = new Library("City Library");

// Add books to the library
$library->addBook($book1);
$library->addBook($book2);

// Update the price of a book
$book1->setPrice(12.99);

// Call a non-existent method to trigger __call
$book1->updateStock(50);

// List all books in the library
$library->listBooks();

// Remove a book from the library
$library->removeBook("1984");

// List all books after removal
$library->listBooks(true);

// Destroy the library object
unset($library);
?>