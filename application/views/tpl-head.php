<?php
if (empty($welcome)) {
    if(empty($catalog)) {
        ?>
        <!--    Остальные страницы     -->
        <section id="headshot">
            <div class="main-content">
                <h3 class="default">на все товары</h3>

                <h2>мы предоставляем гарантию</h2>
            </div>
        </section>
    <?php
    }else{
        ?>
<!--   Страницы каталога     -->
        <section id="headshot">
            <div class="main-content">
                <p>Уважаемые покупатели. Просим обратить внимание, что наш <strong>сайт обновляется раз в 24
                        часа.</strong>
                    Благодарим за понимание.</p>

                <p>Товара гораздо БОЛЬШЕ! Если вы не нашли то, что искали. Оставьте заявку и мы постараемся его
                    найти!</p>
                <span>[Оставить заявку]</span>
            </div>
        </section>
        <?php
    }
} else {
    ?>
    <!--    Главная    -->
    <section id="header-promo">
        <div id="da-slider" class="da-slider">
            <div class="da-slide slide-4 da-slide-current">
                <div class="slide4-wrapper">
                    <div class="rightText">
                        <h3>Нас уже больше 30000 человек</h3>

                        <p>Нам доверяют, <a href="http://vk.com/topic-43410877_27364881" target="_blank">нас
                                благодарят</a> за возможность купить крутые гаджеты по доступной цене!</p>

                        <h2>СПАСИБО ВАМ!</h2>
                    </div>
                    <a href="http://vk.com/gobyte" target="_blank"><img class="vk-widget plax"
                                                                        src="/images/promo/slide4/vk.png"
                                                                        data-xrange="20" data-yrange="0"
                                                                        style="top: 0px; left: 50.4624277456647px;"></a>
                    <img class="soldier-1 plax" src="/images/promo/slide4/1.png"
                         data-xrange="50" data-yrange="50" style="top: 94.2045454545455px; left: 96.1560693641619px;">
                    <img class="soldier-2 plax" src="/images/promo/slide4/2.png"
                         data-xrange="20" data-yrange="20" style="top: 299.681818181818px; left: 110.462427745665px;">
                    <img class="soldier-3 plax" src="/images/promo/slide4/3.png"
                         data-xrange="80" data-yrange="40" style="top: 359.363636363636px; left: 297.849710982659px;">
                    <img class="soldier-4 plax" src="/images/promo/slide4/4.png"
                         data-xrange="180" data-yrange="100" style="top: 118.409090909091px; left: 430.161849710983px;">
                    <img class="soldier-5 plax" src="/images/promo/slide4/5.png"
                         data-xrange="140" data-yrange="70" style="top: 323.886363636364px; left: 449.236994219653px;">
                </div>
            </div>
            <div class="da-slide slide-2">
                <h3 class="da-discount discount-title">Скидки!!!</h3>
                <img class="da-discount discount-1" src="/images/promo/slide2/1.png"
                     alt=""> <img class="da-discount discount-2"
                                  src="/images/promo/slide2/2.png" alt=""> <img
                    class="da-discount discount-3" src="/images/promo/slide2/3.png"
                    alt=""> <img class="da-discount discount-4"
                                 src="/images/promo/slide2/4.png" alt=""></div>
            <nav class="da-arrows"><span class="da-arrows-prev"></span> <span class="da-arrows-next"></span></nav>
            <nav class="da-dots"><span class="da-dots-current"></span><span></span></nav>
        </div>
    </section>

<?php
}
?>
