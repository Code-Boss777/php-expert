//D: Dependency Inversion Principle (Принцип инверсии зависимостей)
//Код должен зависеть от абстракций (интерфейсов), а не от конкретных классов.
<?php
interface SenderInterface { 
    public function send($text); 
    }

class SmsSender implements SenderInterface {
    public function send($text) { echo "Отправлено по SMS: " . $text; }
}

class OrderProcessor {
    private $messenger;

    // В лоток конструктора мы требуем ИНТЕРФЕЙС, а не конкретный SmsSender!
    // Благодаря этому завтра мы сможем подсунуть сюда TelegramSender, и код не сломается.
    public function __construct(SenderInterface $messenger) {
        $this->messenger = $messenger;
    }

    public function process() {
        $this->messenger->send("Заказ успешно оформлен!<br/>");
    }
}

// Запуск
$sms = new SmsSender();
$processor = new OrderProcessor($sms); // Передали зависимость снаружи
$processor->process();