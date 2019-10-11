<div class="menu-menu-sidebar-container padding-bottom-50">
    <ul class="menu">
        <li class="{{ (request()->is('motorcycles-iz-americi')) ? 'active' : '' }}">
            <a href="/motorcycles-iz-americi">Мотоциклы из Америки</a>
        </li>
        <li class="{{ (request()->is('avtomobili-iz-ssha')) ? 'active' : '' }}">
            <a href="/avtomobili-iz-ssha">Автомобили из США</a>
        </li>
        <li class="{{ (request()->is('vopros-otvet')) ? 'active' : '' }}">
            <a href="/vopros-otvet">Вопрос-ответ</a>
        </li>
        <li class="{{ (request()->is('interesnye-loty')) ? 'active' : '' }}">
            <a href="/interesnye-loty">Интересные лоты</a>
        </li>
        <li class="{{ (request()->is('calculator')) ? 'active' : '' }}">
            <a href="/calculator">Растаможка авто</a>
        </li>
        <li class="{{ (request()->is('section/statji')) ? 'active' : '' }}">
            <a href="/section/statji">Статьи</a>
        </li>
        <li class="{{ (request()->is('section/poleznoe')) ? 'active' : '' }}">
            <a href="/section/poleznoe">Полезное</a>
        </li>
    </ul>
</div>