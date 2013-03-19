<?php session_start(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Hamrick Family Library</title>
<link rel="stylesheet" type="text/css" href="../style.css" />
<link rel="stylesheet" type="text/css" href="../demo_page.css" />
<link rel="stylesheet" type="text/css" href="../demo_table.css" />
<script type="text/javascript" language="javascript" src="../js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#booklist').dataTable();
  } );
</script>
<?php require_once('config.php'); ?>
</head>
<body>

<div id="page-wrap">


<h1>Hamrick Family Library</h1>


  <div id="form">
    <table id="newbook-form">
      <thead>
        <tr>
          <td colspan="6"><h2>Add a Book</h2></td>
        </tr>
        <tr>
          <th align="left">Title</th>
          <th align="left">Author</th>
          <th align="left">Collection</th>
          <th align="left">Condition</th>
          <th align="left">Binding</th>
          <th align="left"></th>
        </tr>
      </thead>
      <tbody>
        <form name="addbook" id="addbook" method="post" action="index.php?action=newBook">
          <tr>
            <td><input type="text" name="title" id="title" /></td>
            <td><input type="text" name="author" id="author" /></td>
            <td><input type="text" name="collection" id="collection" /></td>
            <td>
              <select name="booger" id="booger">
                <option value="1">Excellent</option>
                <option value="2">Good</option>
                <option value="3">Fair</option>
                <option value="4">Poor</option>
              </select>
            </td>
            <td>
              <select name="type" id="type">
                <option value="1">Hard Cover</option>
                <option value="2">Soft Cover</option>
                <option value="3">Board</option>
                <option value="4">Cloth</option>
                <option value="5">Soft w/ Tape</option>
              </select>
            </td>
            <td><input type="submit" name="addBook" value="Add Book" /></td>
          </tr>
        </form>
      </tbody>
    </table>
    
    
    <table id="booklist">
      <thead>
        <tr>
          <th align="left">Title</th>
          <th align="left">Author</th>
          <th align="left">Collection</th>
          <th align="center">Condition</th>
          <th align="center">Binding</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ( $results['books'] as $book ) { ?>
        <tr>
          <td><?php echo $book->title ?></td>
          <td><?php echo $book->author ?></td>
          <td><?php echo $book->collection ?></td>
          <td align="center">
		    <?php
              if ($book->booger == 1) {
				$condition = '<img src="img/e.png" alt="Excellent" title="Excellent" />';  
			  } elseif ($book->booger == 2) {
				$condition = '<img src="img/g.png" alt="Good" title="Good" />';  
			  } else if ($book->booger == 3) {
				$condition = '<img src="img/f.png" alt="fair" title="Fair" />';  
			  } else {
				$condition = '<img src="img/p.png" alt="Poor" title="Poor" />';  
			  }
			  echo $condition;
			?>
          </td>
          <td align="center">
		    <?php
              if ($book->type == 1) {
				$type = 'H';  
			  } elseif ($book->type == 2) {
				$type = 'S';  
			  } elseif ($book->type == 3) {
				$type = 'B';  
			  } elseif ($book->type == 4) {
				$type = 'C';  
			  } else {
				$type = 'ST';  
			  }
			  echo $type;
			?>
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>

<div id="footer">
	Copyright &copy; 2013 The Hamrick Family. All Rights Reserved. Development by <a href="http://thomashamrick.com">Thomas Hamrick</a>. Design by <a href="http://brandonapplegate.com">Brandon Applegate.</a>
</div>

</body>
</html>
