<?php
//Верхний абстрактный класс
abstract class A {
	abstract public function run();
}
//нижний абстрактный класс
abstract class B extends A {
	abstract public function jump();
}
//Обычный класс закрывает обязательства всей цепочки
class C extends B {
	public function run() {
		echo "Run Done";
	}
	public function jump() {
		echo "Jump done";
	}
}
//проверка
$obj = new C;
$obj->run();
$obj->jump();