<x-admin-layout :title="$title">
    <div class="rows">
        <div class="rows__top">
            <div class="rows__top-search">
                <x-admin.search/>
            </div>
            <div class="rows__top-btns">
                <button class="btn">Фильтр</button>
                <button class="btn">Сортировка</button>
                <button class="btn btn_bg">Добавить</button>
            </div>
        </div>
        <div class="rows__bottom">
            <div class="row">
                <x-admin.form/>
            </div>
        </div>
    </div>
    <x-admin.popup addClass="asfasf" id="asfasfasf" title="Фильтр" view="components.admin.form"/>
    @php
    $tabs = [
        ['name' => 'Список', 'link' => '/list', 'active' => true],
        ['name' => 'Группы', 'link' => '/groups', ],
    ];
    @endphp
    <x-admin.tabs :tabs="$tabs"/>
</x-admin-layout>
