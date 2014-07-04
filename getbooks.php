<?php

//$_POST['isbns']

$isbns = "3-8127-9054-8
3-8127-9122-6
3-8127-9124-2
91-21-11312-2
91-40-20764-1
91-47-00050-3
91-47-00064-3
91-47-00065-1
91-47-01098-3
91-47-01793-7
91-630-9301-4
91-631-0702-3
91-634-0726-4
91-7622-104-0
91-86006-05-3
91-89130-30-8
91-89130-33-2
978-91-47-00424-9
978-91-44-05097-3
978-91-47-00223-8
978-91-47-00424-9
978-91-47-01742-3
978-91-47-01789-8
978-91-47-06977-4
978-91-47-07102-9
978-91-47-07103-6
978-91-47-07138-6
978-91-47-08172-1
978-91-47-08310-7
978-91-47-08311-4
978-91-633-3407-7
978-91-86006-27-3
978-91-86006-35-8
978-91-86006-37-2
978-99-44-00819-6";

$isbnsa = explode("\n", $isbns);

foreach($isbnsa as &$isbn){
$isbn=trim($isbn);
$book = json_decode(file_get_contents('http://libris.kb.se/xsearch?format=json&query='.$isbn));
print "\n".$isbn.">";
if(isset($book->xsearch)){
  print $book->xsearch->list[0]->title.'>';
  print $book->xsearch->list[0]->publisher.'>';
  print $book->xsearch->list[0]->date.'>';
  print $book->xsearch->list[0]->language.'>';
  print $book->xsearch->list[0]->identifier;
}
}

?>