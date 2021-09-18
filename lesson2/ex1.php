<?php
/* Задача 1:
 Объявить две целочисленные переменные $a и $b и задать им произвольные начальные значения.
Затем написать скрипт, который работает по следующему принципу:
если $a и $b положительные, вывести а и б положительные;
если $а и $b отрицательные, вывести а и б отрицательные;
если $а и $b разных знаков, вывести а и б разных знаков;
 */

//Способ 1
$a = 0;
$b = -3;

if ($a * $b > 0) {
    if ($a > 0) {
        echo "а и б положительные";
    } else {
        echo "а и б отрицательные";
    }
} else if ($a * $b !== 0) {
    echo "а и б разных знаков";
} else if (($a < 0) || ($b < 0)) {
    echo "а и б разных знаков";
} else {
    echo "а и б положительные";
}

// Способ 2: сразу учесть все случаи для каждого из 3 состояний. И переменные заданы через функцию
f3(0,2);
function f3($a, $b) {

    if (($a*$b < 0) || ($a*$b == 0 && ($a < 0 || $b < 0 ))){
        echo "а и б разных знаков";
    } else if (
        (($a > 0 ) && ($b > 0)) ||
        (($a * $b == 0) && ($a > 0 || $b > 0 ))
    ){
        echo "а и б положительные";
    } else {
        echo "а и б отрицательные";
    }
}
echo "<br>";

// Задача 1: Разбор преподавателя
$a = rand(-10, 10);
$a = rand(-10, 10);

echo "a = {$a} b = {$b} <br>";

if($a >= 0 && $b >= 0) {
    echo "a и б положительные";
} elseif ($a < 0 && $b < 0) {
    echo "a и б отрицательные";
} else {
    echo "a и б разных знаков";
}



/*Задача2:
2. Присвоить переменной $а значение в промежутке [0..15].
С помощью оператора switch организовать вывод чисел от $a до 15.
При желании сделайте это задание через рекурсию.
*/

$a = rand(0,15);
echo "Число: " . $a . "<br>";
switch ($a) {
    case 0: echo 0 . " ";
    case 1: echo 1 . " ";
    case 2: echo 2 . " ";
    case 3: echo 3 . " ";
    case 4: echo 4 . " ";
    case 5: echo 5 . " ";
    case 6: echo 6 . " ";
    case 7: echo 7 . " ";
    case 8: echo 8 . " ";
    case 9: echo 9 . " ";
    case 10: echo 10 . " ";
    case 11: echo 11 . " ";
    case 12: echo 12 . " ";
    case 13: echo 13 . " ";
    case 14: echo 14 . " ";
    case 15: echo 15 . "<br>";
}


//Задача 2: 2 Способ Рекурсия
$a = rand(0,15);
echo "Число: " . $a . "<br>";
n_to_15($a,15);

function n_to_15($n, $i)
{
    if ($n <= 15) {
        $n++;
        n_to_15($n,$i - 1);
        echo ($i) . " ";
    }
}

//Разбор
$a = rand(0,15);

function echo_val($a) {
    echo "$a";
    $a++;
    if ($a != 15) echo_val($a);
}
echo_val($a);

function echo_val2($a) {
    echo "$a";
    if ($a != 15) echo_val(++$a);
}

/* Задача 3. Реализовать основные 4 арифметические операции в виде функций с двумя параметрами.
Обязательно использовать оператор return. В делении проверьте деление на 0, и верните текст ошибки.
*/

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
    if ($y !== 0) {
        return round($x / $y, 2);
    } else {
        return "На ноль делить нельзя.";
    }
}

echo add(2,5);
echo div(2, 0);

/*Задача 4
Реализовать функцию с тремя параметрами: function mathOperation($arg1, $arg2, $operation),
где $arg1, $arg2 – значения аргументов, $operation – строка с названием операции.
В зависимости от переданного значения операции выполнить одну из арифметических операций
(использовать функции из пункта 3) и вернуть полученное значение (использовать switch).
*/
function mathOperation($arg1, $arg2, $operation) {
    switch ($operation){
        case 'add': return add($arg1, $arg2);
        case 'sub': return sub($arg1, $arg2);
        case 'mul': return mul($arg1, $arg2);
        case 'div': return div($arg1, $arg2);
        default: return "Нет такой операции " . $operation;
    }
}

echo mathOperation(2, 5, 'su');

function mathOperation_2($arg1, $arg2, $operation)
{
   return $operation($arg1, $arg2);
}

echo mathOperation_2(7,3, 'div') . "<br>";

/*Задание 6:
*С помощью рекурсии организовать функцию возведения числа в степень.
 * Формат: function power($val, $pow), где $val – заданное число, $pow – степень.
*/

function power($val, $pow){
    if ($pow == 0) {
        return 1;
    }
    if ($pow < 0) { // отрицательная степень
        return power(1/$val, -$pow);
    }
    return $val * power($val, $pow - 1);
}
echo power(2,-1) . "<br>";

/*7. *Написать функцию, которая вычисляет текущее время и возвращает его в формате с правильными склонениями,
например: 22 часа 15 минут, 21 час 43 минуты
*/
function current_time(){
  $hours = date("H");
  if (($hours == 0) || ($hours >= 5 && $hours <= 20 )) {
      $h_text = " часов";
  } else if ($hours % 10 == 1) {
      $h_text = " час";
  } else if ($hours % 10 >=2 && $hours % 10 <= 4){
      $h_text = " часа";
  } else {
      $h_text = " часов";
  }

  $minuts = date("i");
    if (($minuts == 0) || ($minuts >= 5 && $minuts <= 20 )) {
        $m_text = " минут";
    } else if ($minuts % 10 == 1) {
        $m_text = " минута";
    } else if ($minuts % 10 >=2 && $minuts % 10 <= 4){
        $m_text = " минуты";
    } else {
        $m_text = " минут";
    }
    return $hours . $h_text . " " . $minuts . $m_text;
}
echo current_time();

//Разбор

//Проверка значений
for ($i = 0; $i <= 23; $i++) {
echo $i . " " . getWord($i, "часов", "час", "часа") . "<br>";
}

function getWord($number, $word1="минут", $word2, $word3) {
    if ($number >= 10 && $number <= 19) return $word1;
        switch ($number % 10){
            case 1: return $word2;
            case 2:
            case 3:
            case 4: return $word3;
            default : return $word1;
        }
}