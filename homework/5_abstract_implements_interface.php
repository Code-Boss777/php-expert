<?php
//чистый интерфейс 
interface I {
	public function swim();
}
//абстрактный класс берет контакт I, но код метода не пишет
abstract class A implements I {
}
//обычный класс наследник, обязан прописать код метода, который получил от отца
class B extends A {
	public function swim() {
		echo "class b implement method swim from abstract father";
	}
}

//проверка
$obj = new B();
$obj->swim();
