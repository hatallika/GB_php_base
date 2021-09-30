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

    // return ($y === 0) ? "На ноль делить нельзя.": round($x / $y, 2);
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

var_dump($_GET);
$arg1 = 0;
$arg2 = 0;
$result = 0;

if(isset($_GET['ok'])){
    $arg1 = (float)$_GET['arg1'];
    $arg2 = (float)$_GET['arg2'];
    $operation = $_GET['operation'];
    $result = mathOperation($arg1, $arg2, $operation);
    var_dump($result);
}

?>
<form action="" method="get">
    <input type="text" name="arg1" value="<?=$arg1?>">
    <select name="operation">
        <option value="add" <?php if ($_GET['operation'] == 'add') echo 'selected';?>>+</option>
        <option value="sub" <?php if ($_GET['operation'] == 'sub') echo 'selected';?>>-</option>
        <option value="mul" <?php if ($_GET['operation'] == 'mul') echo 'selected';?>>*</option>
        <option value="div" <?php if ($_GET['operation'] == 'div') echo 'selected';?>>/</option>
    </select>
    <input type="text" name="arg2" value="<?=$arg2?>">

    <input type="submit" value="=" name="ok">
    <input type="text" name="result" readonly value="<?=$result?>">
</form>
