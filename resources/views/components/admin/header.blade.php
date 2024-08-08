<header class="header">
    <div class="header__container">
        <a href="{{route('admin.main')}}" class="header__logo scale">Admin Logo</a>
        <nav class="header__nav">
            <a href="{{route('admin.seo.index')}}" class="header__link scale">SEO</a>
            <a href="{{route('admin.inserts.index')}}" class="header__link scale">Вставки</a>
            <a href="#" class="header__link scale">Пользователи</a>
            <a href="#" class="header__link header__link_settings scale"><x-admin.icons.settings></x-admin.icons.settings></a>
            <a href="#" class="header__link header__link_user scale"><x-admin.icons.user></x-admin.icons.user></a>
        </nav>
    </div>
</header>
