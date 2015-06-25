<div class="main-content contacts">
    <div class="col span_3_of_7">
        <h2>Режим работы</h2>
        <p>Пн-Вс, без перерыва и выходных, с <span style="font-size: 18px">10:00 до 20:00</span></p>
        <h2>Телефон</h2>
        <a href="tel:+74732001095" style="color: #384D56; font-size: 24px; font-weight: bold; font-family: "Myriad Pro", Arial, serif">8 (473) 200-10-95</a>
        <h2>Email</h2>
        <a href="mailto:bytevrn@gmail.com">bytevrn@gmail.com</a>
        <h2>Адрес</h2>
        <p>г. Воронеж, ул 9 Января 68 "З". Здание Эльдорадо.Третий этаж, офис №302. Вход справа от основного.</p>
        <h2>Реквизиты</h2>
        <p>ИП Трушечкин А.В.</p>
        <p>ИНН 360105012539</p>
        <p>ЕГРИП 315366800017177</p>
        <p>netstreamertwo@gmail.com</p>
        <p>тел.: 8 (473) 200-10-95</p>
    </div>
    <div class="col span_4_of_7">
        <script type="text/javascript">
            ymaps.ready(init);

            function init(){
              var myMap = new ymaps.Map ("map", {
                    center: [51.66772617, 39.17602591],
                    zoom: 16
                });
                myMap.controls.add(
                    new ymaps.control.ZoomControl()
                );
              var myPlacemark = new ymaps.Placemark([51.66791298, 39.17285018], {
                    hintContent: 'Дисконт центр "Byte"',
                    balloonContent: 'Дисконт центр "BYTE"<br><span>9 января 68з, 3 этаж</span>'
                } , {
                  iconImageHref: 'http://gobyte.studio-pulse.ru/images/logo.png',
                  iconImageSize: [130, 39],
                  iconImageOffset: [-10, -50]

              });

                myMap.geoObjects.add(myPlacemark);
            }
        </script>
        <h2>Как нас найти</h2>
        <div id="map"</div>
    </div>
</div>