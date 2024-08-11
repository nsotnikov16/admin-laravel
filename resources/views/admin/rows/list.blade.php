<x-admin-layout>
    <div class="rows">
        <div class="rows__top">
            <div class="rows__top-search">
                <x-admin.search :searchCollection="$dropdownSearch" />
            </div>
            <div class="rows__top-btns">
                <button class="btn" data-pointer="filter">Фильтр</button>
                <button class="btn">Сортировка</button>
                <a href="{{ $addRoute }}" class="btn btn_bg">Добавить</a>
            </div>
        </div>
        <div class="rows__bottom">
            <div>
                <p data-result-rows>
                    @if ($count > 0)
                        Найдено: {{ $count }} из {{ $total }}
                    @else
                        Ничего не найдено
                    @endif
                </p>
                {{--  @isset($count, $total)
                    @if ($count > 0)
                        <p>Найдено: {{ $count }} из {{ $total }}</p>
                    @else
                        <p>Ничего не найдено</p>
                    @endif
                @endisset --}}

                {{-- <p>Отображать по: 100, 250, 500</p> --}}
                {{-- <x-admin.dropdown btnText="Поля" :items="[['ID', '']]"/> --}}
            </div>
            <div class="rows__table">
                <x-admin.table :head="$table['head']" :body="$table['body']" addClass="table_rows" />
            </div>
            <div class="pagination"></div>
        </div>
    </div>
    <x-admin.popup id="filter" title="Фильтр" :filter="$filterColumns">

    </x-admin.popup>
    <x-admin.popup id="sort" title="Сортировка">

    </x-admin.popup>
</x-admin-layout>
