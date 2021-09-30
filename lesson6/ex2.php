<?php
//var_dump($_SERVER['REQUEST_URI']);
//var_dump($_POST);
//var_dump($_SERVER['REQUEST_METHOD']);
//var_dump($_REQUEST);
function add($x, $y) {
    return $x + $y;
}
function sub ($x, $y) {
    return $x - $y;
}
function mul($x, $y) {
    return $x * $y;
}
function div($x, $y) {

    if ($y == 0) {
         return "На ноль делить нельзя.";
    } else {
        return ($x / $y);
    }
}

function mathOperation($arg1, $arg2, $operation):string {
    switch ($operation){
        case 'add': return add($arg1, $arg2);
        case 'sub': return sub($arg1, $arg2);
        case 'mul': return mul($arg1, $arg2);
        case 'div': return div($arg1, $arg2);
        default: return "Нет такой операции " . $operation;
    }
}

$arg1 = 0;
$arg2 = 0;
$result = 0;

if(isset($_GET['add'])||isset($_GET['sub'])||isset($_GET['mul'])||isset($_GET['div']) ){
    $arg1 = (float)$_GET['arg1'];
    $arg2 = (float)$_GET['arg2'];
    if(isset($_GET['add'])){ $operation = 'add';}
    if(isset($_GET['sub'])){ $operation = 'sub';}
    if(isset($_GET['mul'])){ $operation = 'mul';}
    if(isset($_GET['div'])){ $operation = 'div';}

    $result = mathOperation($arg1, $arg2, $operation);
    var_dump($result);
}

?>
<form action="" method="get">
    <input type="text" name="arg1" value="<?=$arg1?>">
   и
    <input type="text" name="arg2" value="<?=$arg2?>">

    <input type="submit" value="+" name="add">
    <input type="submit" value="-" name="sub">
    <input type="submit" value="*" name="mul">
    <input type="submit" value="/" name="div">

    <input type="text" name="result" readonly value="<?=$result?>">
</form>
