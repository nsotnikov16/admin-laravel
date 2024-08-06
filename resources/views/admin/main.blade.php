<x-admin-layout :title="$title">
    <div class="rows">
        <div class="rows__top">
            <div class="rows__top-search">
                <x-admin.search></x-admin.search>
            </div>
            <div class="rows__top-btns">
                <button class="btn">Фильтр</button>
                <button class="btn">Сортировка</button>
                <button class="btn btn_bg">Добавить</button>
            </div>
        </div>
        <div class="rows__bottom">
            <x-admin.form></x-admin.form>
        </div>
    </div>
</x-admin-layout>
