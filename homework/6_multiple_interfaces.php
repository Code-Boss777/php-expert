<?php
//создаем 2 независимых интерфейса
interface I {
	public function one();
}
interface J {
	public function two();
}
//класс подписывает через запятую оба контакта
class A implements I, J {
	public function one() {
		echo "method one was complete";
	}
	public function two() {
		echo "method two was complete";
	}
}
//проверка
$obj = new A();
$obj->one();
$obj->two();
