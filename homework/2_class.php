<?php
//базовый класс родитель
class A {
	public function hello () {
		echo "Method hello from parent class A";
	}
}
//класс наследник, автоматически наследует метод hello();
class B extends A {
}
//проверка
$obj =new B();
$obj->hello();
