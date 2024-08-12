<div class="rows__bottom-top">
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
    <x-admin.table :table="$table" addClass="table_rows" :templateLinkEdit="$templateLinkEdit" :templateLinkDelete="$templateLinkDelete" />
</div>
<div class="pagination"></div>
