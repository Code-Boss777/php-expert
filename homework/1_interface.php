<?php
//интерфейс
interface I {
	public function foo();
}
//класс А подписывает интерфейс.
class A implements I {
	public function foo() {
		echo "class A implements interface I";
	}
}
//проверка
$obj = new A();
$obj->foo();

?>