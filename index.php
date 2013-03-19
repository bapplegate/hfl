<?php

require( "config.php" );

session_start();
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

switch ( $action ) {
  case 'newBook':
    newBook();
    break;
  case 'editBook';
    editBook();
	break;
  case 'deleteBook';
  	deleteBook();
	break;
  default:
    listBooks();
}

function listBooks() {
  $results = array();
  $data = Book::getList();
  $results['books'] = $data['results'];
  $results['totalRows'] = $data['totalRows'];

  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "bookNotFound" ) $results['errorMessage'] = "Error: Book not found.";
  }
  if ( isset( $_GET['status'] ) ) {
    if ( $_GET['status'] == "changesSaved" ) $results['statusMessage'] = "Your changes have been saved.";
    if ( $_GET['status'] == "bookDeleted" ) $results['statusMessage'] = "Book deleted.";
  }
  
  require( TEMPLATE_PATH . "/listBooks.php" );
}

function newBook() {
	
  $results = array();

  if ( isset( $_POST['addBook'] ) ) {
    $book = new Book;
    $book->storeFormValues( $_POST );
    $book->insert();
    header( "Location: index.php?status=changesSaved" );
  } elseif ( isset( $_POST['cancel'] ) ) {
    header( "Location: index.php" );
  } else {
    $results['book'] = new Book;
    require( TEMPLATE_PATH . "/listBooks.php" );
  }
  
  $results = stripslashes($result); 

}

function editBook() {
	
  $results = array();
  if ( !$book = Book::getById( (int)$_POST['book_id'] ) ) {
    return;
  }
  
  $book->storeFormValues( $_POST );
  $book->update();
  
  if ($_POST['booger']) {
	if ($_POST['booger'] == 1) {
	  echo '<img src="img/e.png" alt="Excellent" title="Excellent" />';
	} elseif ($_POST['booger'] == 2) {
	  echo '<img src="img/g.png" alt="Good" title="Good" />';
	} elseif ($_POST['booger'] == 3) {
	  echo '<img src="img/f.png" alt="fair" title="Fair" />';
	} else {
	  echo '<img src="img/p.png" alt="Poor" title="Poor" />';
	}
  } elseif ($_POST['type']) {
	if ($_POST['type'] == 1) {
	  echo 'H';
	} elseif ($_POST['type'] == 2) {
	  echo 'S';
	} elseif ($_POST['type'] == 3) {
	  echo 'B';
	} elseif ($_POST['type'] == 4) {
	  echo 'C';
	} else {
	  echo 'ST';
	} 
  } elseif ($_POST['lastRead']) {
	header( "Location: index.php?status=changesSaved" );
  }else {
    echo $stuff[0];
  }

}

function deleteBook() {

  if ( !$page = Book::getById( (int)$_GET['book_id'] ) ) {
    header( "Location: index.php?error=bookNotFound" );
    return;
  }

  $page->delete();
  header( "Location: index.php?status=bookDeleted" );
}

?>
