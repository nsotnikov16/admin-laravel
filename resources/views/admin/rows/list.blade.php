<x-admin-layout>
    <div class="rows">
        <div class="rows__top">
            <div class="rows__top-search">
                <x-admin.search />
            </div>
            <div class="rows__top-btns">
                <button class="btn" data-pointer="asfasfasf">Фильтр</button>
                <button class="btn">Сортировка</button>
                <button class="btn btn_bg">Добавить</button>
            </div>
        </div>
        <div class="rows__bottom">
            <div>
                {{-- <p>Найдено: 30 из 200</p>
                <p>Отображать по: 100, 250, 500</p> --}}
                {{-- <x-admin.dropdown btnText="Поля" :items="[['ID', '']]"/> --}}
            </div>
            <table class="table table_rows">
                <thead class="table__head">
                    <tr class="table__row">
                        <td class="table__cell">ID</td>
                        <td class="table__cell">Название</td>
                        <td class="table__cell">Сортировка</td>
                        <td class="table__cell">Категория</td>
                        <td class="table__cell">Символьный код</td>
                        <td class="table__cell">Дата создания</td>
                        <td class="table__cell">Дата обновления</td>
                        <td class="table__cell table__cell_edit"></td>
                        <td class="table__cell table__cell_trash"></td>
                    </tr>
                </thead>
                <tbody class="table__body">
                    <tr class="table__row">
                        <td class="table__cell">1</td>
                        <td class="table__cell">Новость №1</td>
                        <td class="table__cell">1</td>
                        <td class="table__cell">Важные</td>
                        <td class="table__cell">news_1</td>
                        <td class="table__cell">25.04.2024 16:30</td>
                        <td class="table__cell">15.02.2024 21:15</td>
                        <td class="table__cell table__cell_edit"><x-admin.icons.edit /></td>
                        <td class="table__cell table__cell_trash"><x-admin.icons.trash />
                    </tr>
                    <tr class="table__row">
                        <td class="table__cell">2</td>
                        <td class="table__cell">Новость №2</td>
                        <td class="table__cell">3</td>
                        <td class="table__cell">НеВажные</td>
                        <td class="table__cell">news_2</td>
                        <td class="table__cell">25.04.2024 16:30</td>
                        <td class="table__cell">15.02.2024 21:15</td>
                        <td class="table__cell table__cell_edit"><x-admin.icons.edit /></td>
                        <td class="table__cell table__cell_trash"><x-admin.icons.trash /></td>
                    </tr>
                </tbody>
            </table>
            <div class="pagination"></div>
        </div>
    </div>
    <x-admin.popup addClass="asfasf" id="asfasfasf" title="Фильтр"></x-admin.popup>
</x-admin-layout>
