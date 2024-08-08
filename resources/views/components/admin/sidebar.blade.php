<aside class="sidebar">
    <nav class="sidebar__nav">
        <a href="{{ route('admin.pages.index') }}" class="sidebar__link scale">Страницы</a>
        @foreach ($entities as $entity)
            <a href="{{ route('admin.entities.show', ['entity' => $entity['code']]) }}"
                class="sidebar__link scale">{{ $entity['name'] }}</a>
        @endforeach
        <a href="{{ route('admin.entities.create') }}" class="sidebar__link scale">+ Добавить</a>
    </nav>
</aside>
