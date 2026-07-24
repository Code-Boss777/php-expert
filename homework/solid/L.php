//L. Liskov Substitution Principle (Принцип подстановки Барбары Лисков)
//классы наследники должны уметь полностью заменять своих родителей, не ломая при этом логику программы. 
<?php
class Document {
    public function open() {
        echo "документ открыт для чтения";
    }
}

//класс наследник делает то же самое, но чуть лучше. 
//он не ломает родительский метод open(), а просто дополняет его. 
class ReadOnlyDocument extends Document {
    public function open() {
        parent::open();
        echo "Внимание: рекдактирование завершено. ";
    }
}
