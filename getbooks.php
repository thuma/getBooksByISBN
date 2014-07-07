<?php
if(isset($_POST['isbns'])){

$isbns = $_POST['isbns'];

$isbnsa = explode("\n", $isbns);

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=books.csv");
header("Pragma: no-cache");
header("Expires: 0");

print '"ISBN","Title","Publisher","Date","Language","KB link"';
foreach($isbnsa as &$isbn){
$isbn=trim($isbn);
$book = json_decode(file_get_contents('http://libris.kb.se/xsearch?format=json&query='.$isbn));
print "\n".'"'.$isbn.'"';
if(isset($book->xsearch)){
  print ',"'.$book->xsearch->list[0]->title.'"';
  print ',"'.$book->xsearch->list[0]->publisher.'"';
  print ',"'.$book->xsearch->list[0]->date.'"';
  print ',"'.$book->xsearch->list[0]->language.'"';
  print ',"'.$book->xsearch->list[0]->identifier.'"';
  }
  }
}
else{
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
Add one ISBN number for each line. </br>
Then click get book data.<br />
A csv file will be returned with the available data.
</p>
</body>
</html>
<?php
}
?>
