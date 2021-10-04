<?php

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


    $operand1 = (int)$_POST['operand1'];
    $operand2 = (int)$_POST['operand2'];
    $operator = $_POST['operator'];


	$rez = mathOperation($operand1, $operand2, $operator );
    switch ($operator){
        case 'add': $symb = '+'; break;
        case 'sub': $symb = '-'; break;
        case 'mul': $symb = '*'; break;
        case 'div': $symb = '/'; break;
    }

	$str="{$operand1} {$symb} {$operand2} = {$rez}";

	$file=fopen("data.txt", 'w');
	fputs($file, $str);
	fclose($file);
	
	
	$response['result'] = mathOperation($operand1, $operand2, $operator );
	echo json_encode($response);