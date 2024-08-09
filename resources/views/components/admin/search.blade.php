@php
    $dropdownItems = [
        ['name' => 'a', 'value' => 1, 'label' => 'По символьному коду'],
        ['name' => 'a', 'value' => 2, 'label' => 'По категории'],
        ['name' => 'a', 'value' => 3, 'label' => 'По названию'],
        ['name' => 'a', 'value' => 4, 'label' => 'дате создания'],
    ];
@endphp
<form class="search">
    <div class="search__icon"><x-admin.icons.search></x-admin.icons.search></div>
    <input type="text" class="search__input" placeholder="Поиск">
    <x-admin.dropdown addClass="search__dropdown" :items="$dropdownItems" btnText="По названию" :isRadio="true" />
</form>
