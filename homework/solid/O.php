<?php
//O. Open/closed principe. 
//Принцип открытости закрытости. 
//классы должны быть открыты для расширения, но закрыты для изменени. 

//общий контакт для всех видов оплат 
interaface PaymentMethodInterface {
    public function pay(int $amount);
}
//класс оплаты картой. Написан один раз и заглушен от изменений. 
class CreditCardPayment implements PaymentMethodInterface {
    pubclic function pay(int $amount) {
        echo "оплачено картой" . $amount . "руб.";
    }
}

//Нужен СБП?просто создаем новый класс не трогая старый.
class SbpPayment implements PaymentMethodInterface {
    public function pay(int $amount) {
        echo "оплачено через СБП" . $amount . "руб.";
    }
}