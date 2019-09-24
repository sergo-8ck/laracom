<footer class="design_2">
    <div class="container">
        <div class="row">
            <div
                class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padding-left-none md-padding-left-none sm-padding-left-15 xs-padding-left-15">
                <h4>Подписаться</h4>
                <p>Хочешь получать самые горячие предложения? подпишись на рассылку!</p>
{{--                <form method="post" class="form_contact">--}}
{{--                    <input type="text" value="" name="MERGE0" placeholder="Email Address">--}}
{{--                    <input type="submit" value="Подписаться" class="md-button">--}}
{{--                    <input type="hidden" name="u" value="">--}}
{{--                    <input type="hidden" name="id" value="">--}}
{{--                </form>--}}
            </div>
            <div
                class="col-lg-4 col-md-4 col-sm-6 col-xs-12 padding-right-none md-padding-right-none sm-padding-right-15 xs-padding-right-15">
                <h4>Контакты</h4>
                <div class="footer-contact">
                    <ul>
                        <li><i class="fa fa-map-marker"></i> <strong>Адрес:</strong>{{ config('shop.address') }}
                        </li>
                        <li><i class="fa fa-phone"></i> <strong>Телефон:</strong>{{ config('shop.phone') }}</li>
                        <li><i class="fa fa-envelope-o"></i> <strong>Email:</strong><a
                                href="mailto:[[++email]]">{{ config('shop.email') }}</a></li>
                    </ul>

                    <i class="fa fa-location-arrow back_icon"></i>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <h4>Лучшие Цены На Автомобили</h4>
                <div class="latest-tweet">
                    <div>
                        <p>Купив автомобиль в США, вы сможете сэкономить от 30 до 50% его стоимости
                            по сравнению с ценой в России.</p>
                    </div>
                    <div>
                        <p>Более 100 клиентов уже получили автомобили из США, воспользовавшись
                            нашими услугами.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="clearfix"></div>
<section class="copyright-wrap padding-bottom-10">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <p><a style="line-height: 10px; font-family: Verdana, Arial, sans-serif; font-size: 10px; color: white;" title="Copyright регистрация и защита авторских прав" href="{{ config('app.url') }}">Atlantic Group LLC ©</a> <span style="line-height: 10px; color: #ffffff; font-family: Verdana, Arial, sans-serif; font-size: 10px;">&nbsp;КОПИРАЙТ, 2017-{{ date('Y'  ) }}</span></p>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                <ul class="social margin-bottom-25 md-margin-bottom-25 sm-margin-bottom-20 xs-margin-bottom-20 xs-padding-top-10 clearfix">

                    <li><a class="sc-3" href="{{ config('shop.youtube') }}"></a></li>
                    <li><a class="sc-4" href="{{ config('shop.vk') }}"></a></li>
                    <li><a class="sc-8" href="{{ config('shop.skype') }}"></a></li>
                    <li><a class="sc-7" href="/"></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>