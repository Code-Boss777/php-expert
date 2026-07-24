//I: Interface Segregation Principle (Принцип разделения интерфейса)
//Много маленьких, специализированных интерфейсов гораздо лучше, чем один огромный «толстый» интерфейс.
<?php

interface Codeable {
    public function code ();
}
interface Cleanable {
    public function cleanFloor();
}
//бэк подписывает контракт только на кодинг!
class Developer implements Codeable {
    public function code() {
        echo "Пишу PHP код.";
    }
}
