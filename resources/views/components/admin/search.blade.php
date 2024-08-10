<form class="search" data-search>
    <div class="search__icon"><x-admin.icons.search></x-admin.icons.search></div>
    <input type="text" class="search__input" placeholder="Поиск" name="search" value="{{ request('search') }}">
    <x-admin.dropdown addClass="search__dropdown" :collection="$searchCollection" />
</form>
