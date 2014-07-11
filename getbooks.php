<?php

// Check if data is posted:
if(isset($_POST['isbns'])){

  // Get data to strig variable:
  $isbns = $_POST['isbns'];

  // Split data to array:
  $isbnsa = explode("\n", $isbns);

  // Send header with csv fild header and name, no cache:
  header("Content-type: text/csv");
  header("Content-Disposition: attachment; filename=books.csv");
  header("Pragma: no-cache");
  header("Expires: 0");

  // Print the header for the CSV fie.
  print '"ISBN","Title","Publisher","Date","Language","KB link"';
  
  // Loop every row.
  foreach($isbnsa as &$isbn){
    
    // Remove white cars.
    $isbn= str_replace("[^0-9]","",$isbn);
    
    // Wait to not overload the Libiris server
    usleep(200000);
    
    // Get book data form KB libirs API.
    $book = json_decode(file_get_contents('http://libris.kb.se/xsearch?format=json&query='.$isbn));
    
    // Print the ISBN on new row.
    print "\n".'"'.$isbn.'"';
    
    // Check if book found in libris.
    if(isset($book->xsearch)){
      
      // Print all book data.
      print ',"'.$book->xsearch->list[0]->title.'"';
      print ',"'.$book->xsearch->list[0]->publisher.'"';
      print ',"'.$book->xsearch->list[0]->date.'"';
      print ',"'.$book->xsearch->list[0]->language.'"';
      print ',"'.$book->xsearch->list[0]->identifier.'"';
    }
  }
}
// If no data show simle GUI.
else{
  // Put html and utf-8 header.
  header('Content-Type: text/html; charset=utf-8');
  ?>
<html>
<body>
<form method="POST">
ISBN list:<br />
<textarea name="isbns"></textarea><br />
<input type="submit" value="Get book data">
</form>
<p>
Add one ISBN number for each line. <br />
Then click get book data.<br />
A csv file will be returned with the available data.
</p>
</body>
</html>
<?php
}
?>
