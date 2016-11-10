<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
    <link rel="stylesheet" type="text/css" href="contract.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.js"></script>
    <script src="contract.js"></script>
</head>
<body>
<?php
    $customerName = 'Joro';
    $ipAddress = '10.10.9.1';
    $fee = 20;
    $paymentDate = '29.12.2015';
    $accessEnd = '01.01.2016';
    $contractId = 1;
    for($i=0; $i<2; $i++){
        echo '<div class="mainBody">
            <header>Договор за Интернет достъп от '.$paymentDate.' до '.$accessEnd.'</header>
            <div class="customerInfo">
                <div>Номер: '.$contractId.'</div>
                <div>Потребител: '.$customerName.'</div>
                <div>Заплатена сума: '.$fee.' лв.</div>
                <div>Начална дата: '.$paymentDate.'</div>
                <div>Крайна дата: '.$accessEnd . '</div>
            </div>
            <div class="networkInfo">
                <div id="left">
                    <div>IP: 10.10.10.10</div>
                    <div>Mask: 255.255.255.0</div>
                    <span class="networkLabel">Мрежови настройки</span>
                </div>
                <div id="right">
                    <div>Default GateWay: 255.255.255.255</div>
                    <div>Prefered DNS: 10.10.10.1</div>
                    <div>Alternate DNS: 255.255.255.255</div>
                </div>

            </div>
            <div class="contactTelephone">Телефон за връзка при аварии: 0894382582</div>
            <article><strong>Условия</strong>
            <p>Настоящият протокол удостоверява, че клиентът е заявил доставка на Интернет до посочената дата - '.$paymentDate.'.
            На следващия ден след '.$paymentDate.' неговият Интернет достъп ще бъде спрян автоматично,
            освен ако клиентът не заплати нов период за доставка на Интернет.
            Ако до два месеца след датата на спиране на достъпа до Интернет клиентът не поднови абонамента си,
            доставчикът е в правото си да демонтира оборудването (кабели, рутъри и др.), което е предоставил на клиента при сключването на договора.
            Ако клиентът не позволи демонтажа на оборудването, той дължи обещетение на доставчика в размер на 350 лв., които ще му бъдат предявени по съдебен път.
            Потребителят е длъжен да си осигури за своя сметка LAN протектор или друго средство за защита на компютъра си от токов удар по мрежата.
            </p>
            <p>
                Доставчикът не носи отговорност за:
                <ul>
                    <li>прекъсване на достъпа до Интернет по време на периода на настоящия договор настъпило поради аварии от всякакво естество.</li>
                    <li>щети по имуществото на клиента причинени от токови или гръмотевични удари и други извънредни обстоятелства настъпили по мрежата.</li>
                    <li>вирусни и други атаки по компютрите на клиента или за повреда на софтуера инсталиран на тях.</li>
                </ul>
            </p>
            <p>
                Със своя подпис клиентът декларира, че приема гореспоменатите условия и е съгласен с тях.
            </p>
            </article>
            <div class="signature">Клиент: ______________</div>
        </div>';
    }?>
</body>
</html>
