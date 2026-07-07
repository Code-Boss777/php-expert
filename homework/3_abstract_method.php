<?php
//Абстрактный класс-родитель
abstract class A {
	abstract public function bar();
}
//обычный класс обязан написать код абстрактного класса
class B extends A {
	public function bar() {
		echo "class done abstract method bar";
	}
}
//проверка
$obj = new B();
$obj->bar();
?>