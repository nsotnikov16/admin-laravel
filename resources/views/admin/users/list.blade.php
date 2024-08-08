<x-admin-layout>
    @php
        $tabs = [['name' => 'Список', 'link' => '/list', 'active' => true], ['name' => 'Группы', 'link' => '/groups']];
    @endphp
    <x-admin.tabs :tabs="$tabs" />
</x-admin-layout>
