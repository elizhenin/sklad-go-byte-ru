    <div id="order-form-wrapper">
        <form method="POST">
            <section class="delivery" id="delivery-section">
                <div class="main-content">
                    <div class="field">
                        <input type="radio" id="deliv1" name="deliv_id" checked value="1">
                        <label for="deliv1">
                            Самовывоз
                            <p>Самостоятельно забрать заказ в день оформления  по адресу г. Воронеж 9 Января 68 "3" , третий этаж офис № 302 </p>
                        </label>
                    </div>
                    <div class="field">
                        <input type="radio" id="deliv2" name="deliv_id" value="2">
                        <label for="deliv2">
                            Доставка курьером (бесплатно)
                            <p>Доставка осуществляется в течение дня в удобное для вас время. </p>
                        </label>
                    </div>
                    <div id="map"></div>
                </div>
            </section>
            <section class="rekv">
                <div class="main-content">
                    <div class="field op1">
                        <label for="op1"> Как к Вам обращаться </label>
                        <input type="text" maxlength="250" size="40" value="" name="client_name" id="op1">
                    </div>
                    <div class="field op2">
                        <label for="op2"> E-Mail </label>
                        <input type="text" maxlength="250" size="40" value="" name="client_email" id="op2">
                    </div>
                    <div class="field op3">
                        <label for="op3"> Телефон </label>
                        <input class="tooltip" title="Поле обязательно для заполнения" type="text" maxlength="250" size="0" value="" name="client_phone" id="op3">
                    </div>
                    <div class="field op4">
                        <label for="op4"> Адрес доставки </label>
                        <input class="tooltip" title="Поле обязательно для заполнения" type="text" maxlength="250" size="30" value="" name="client_address" id="op4" placeholder="ул. Ленина д. 1 кв. 15">
                    </div>
                </div>
            </section>
            <!-- rekv -->



            <section class="pay-system">
                <div class="main-content">

                        <table class="basket-table cart-items">
                            <thead>
                            <tr>
                                <td width="30%">Код</td>
                                <td>Название</td>
                                <td width="20%">Цена</td>
                                <td width="30px"></td>
                            </tr>
                            </thead>
                            <tbody id="basket-table-tbody">
                            <tr><td colspan="4" width="100%">(Проверяем наличие...)</td></tr>
                            </tbody>
                        </table>
                    <div class="tot">
                        <table>
                            <tbody>
                                <tr>
                                    <td class="rt">Итого товаров:</td>
                                    <td><span class="total-count"></span></td>
                                </tr>
                                <tr>
                                    <td class="rt">На сумму:</td>
                                    <td><span class="total-sum"></span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="clear: both;"></div>
                    <p>Внимание! если какой-то товар внезапно исчез из списка - значит его приобрели прямо сейчас, чуть раньше вас</p>
                    <script>
                        setInterval (function(){basket_edit();}, 1000);
                    </script>
                </div>
            </section>
            <!-- summary -->
            <?=(empty($message))?'':'<div class="feedback-message">'.$message.'</div>'?>
            <section class="order-comment">
                <div class="main-content">
                    <div class="order-title">
                        <div class="order-title-inner"> <span>Ваши комментарии к заказу</span> </div>
                    </div>
                    <div class="order-info">
                        <div align="center">
                            <textarea rows="7" name="client_comments" style="width:100%;"></textarea>
                        </div>
                    </div>
                </div>
            </section>
            <section class="order-buttons">
                <div class="main-content">
                    <input type="submit" value="Оформить заказ">
                </div>
            </section>
        </form>
    </div>
