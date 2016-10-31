<?php

class obj implements ArrayAccess {
    private $container = array();


/*
    public function __construct() {
        $this->container = array(
            "one"   => "Petr",
            "two"   => "Ivan",
            "three" => "Sergey",
        );
    }
*/


    public function __construct($url)
    {
    //  $content=file_get_contents($url);

    //  preg_match( '/<gif>(.*?)<\\/gif>/is' , $content , $gif );



  //  $file = $DOCUMENT_ROOT. "test.html";
$doc = new DOMDocument();
@$doc->loadHTMLFile($url);

// example 1:
//$elements = $doc->getElementsByTagName('*');
// example 2:
//$elements = $doc->getElementsByTagName('html');
// example 3:
//$elements = $doc->getElementsByTagName('body');
// example 4:
//$elements = $doc->getElementsByTagName('table');
// example 5:
$elements = $doc->getElementsByTagName('img');


/*
if (!is_null($elements)) {
  foreach ($elements as $element) {
    echo "<br/>". $element->nodeName. ": ";

    $nodes = $element->childNodes;
    foreach ($nodes as $node) {
      echo $node->nodeValue. "\n";
    }
  }
}
*/


foreach ($elements as $element) {
       echo $element->getAttribute('src').' | '.$element->nodeValue."\n";
       $this->container[$element->nodeValue]=$element->getAttribute('src');

}

/*
      $this->container = array(

      );
*/



    //  $this->foo = $foo;
    }




    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }


    /* MAGIC FUNC */

    public function __set($offset,$value)
    {
      if (is_null($offset)){
        offsetSet($offset,$value);
      } else{
      echo "Установка '$offset' в '$value'\n";
      echo"</br>";
      $this->container[$offset] = $value;
    }
      # code...
    }

    public function __get($offset)
       {
           echo "Получение '$offset'\n";
           echo"</br>";
           if (isset($this->container[$offset])) {
               return $this->container[$offset];
           }
           else {
             # code...

           $trace = debug_backtrace();
           trigger_error(
               'Неопределенное свойство в __get(): ' . $offset .
               ' в файле ' . $trace[0]['file'] .
               ' на строке ' . $trace[0]['line'],
               E_USER_NOTICE);
           return null;
         }
       }




}

$obj = new obj('http://giphy.com/');


echo "Доступ к переменной класса как к элементу массива:";
echo "</br>";
//var_dump(obj["one"]);
echo $obj['one'];
echo "</br>";

echo "тестируем магические функции";
$obj->a=1;
echo $obj->a;
echo "</br>";

echo $obj->gif;

//echo $obj->one;
echo "</br>";


echo $obj->/static/img/homepage_banners/election-banner.gif ;


/*
echo "дополнительные тесты";
$obj->div='gif1';
$obj->div='gif2';
//$obj->div=array('div' =>'gif1' ,'div'='gif2' );
echo $obj->div;
*/


/*
var_dump(isset($obj["two"]));
var_dump($obj["two"]);
unset($obj["two"]);
var_dump(isset($obj["two"]));
$obj["two"] = "A value";
var_dump($obj["two"]);
$obj[] = 'Append 1';
$obj[] = 'Append 2';
$obj[] = 'Append 3';
print_r($obj);
*/


?>
