<x-admin-layout>
    <div class="rows">
        <div class="rows__top">
            <div class="rows__top-search">
                <x-admin.search :searchCollection="$dropdownSearch" />
            </div>
            <div class="rows__top-btns">
                @isset($filterFields)
                    <button class="btn" data-pointer="filter">Фильтр</button>
                @endisset
                @isset($sortFields)
                    <button class="btn" data-pointer="sort">Сортировка</button>
                @endisset
                <a href="{{ $addRoute }}" class="btn btn_bg">Добавить</a>
            </div>
        </div>
        <div class="rows__bottom">
            @include(
                'admin.rows.bottom',
                compact('count', 'total', 'table', 'templateLinkEdit', 'templateLinkDelete'))
        </div>
    </div>
    @isset($filterFields)
        <x-admin.popup id="filter" title="Фильтр">
            <x-admin.form :collection="$filterFields" type="filter">
                <div class="form__btns">
                    {{--  <button type="button" class="btn form__btn" data-reset-btn>Сбросить</button> --}}
                    <button type="submit" class="btn form__btn">Применить</button>
                </div>
            </x-admin.form>
        </x-admin.popup>
    @endisset

    @isset($sortFields)
        <x-admin.popup id="sort" title="Сортировка">
            <x-admin.form :collection="$sortFields" type="sort">
                <div class="form__btns">
                    {{--  <button type="button" class="btn form__btn" data-reset-btn>Сбросить</button> --}}
                    <button type="submit" class="btn form__btn">Применить</button>
                </div>
            </x-admin.form>
        </x-admin.popup>
    @endisset

</x-admin-layout>
