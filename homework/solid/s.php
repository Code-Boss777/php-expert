<?php
//SOLID - это набор принципов (5), в программировании чтоб код был структурирован не превращался в кашу расширялся и не разваливался

//S-single responsibility principle (принци единой ответственности)
//один класс должен отвечать только за одно действие

//Первый класс: отвечает только за создание заказа
class Order {
    public $productName; 
    public $price;
    public function __construct(string $name, ing $price) {
        $this->productName = $name;
        $this->price = $price; 
    }
}

//второй класс: отвечает только за сохранение в базу
class OrderRepository {
    public function save(Oreder $order): void {
        echo "DB: заказ " . $order->poductName . "done";
    }
}

//третий класс отвечает только за уведомления 

class NotificationService {
public function sendSms(Order $order): void {
echo "sms centre: Person was send SMS" . $order->price . "done";

//создаем заказ
$myOrder = new Order("phone samsung", 45000);
//создаем робота для бд и даем команду сохраниить
$dbWorker = new OrderRepository();
$dbWorker->save($myOrder);// передали обхъект заказа в лоток функции 
//создаем робота уведомителя и передаем СМС
$smsWorker = new NotificationService(); 
$smsWorker->sendSms($myOrder);