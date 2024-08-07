<div class="popup {{ $addClass ?? '' }}" id="{{ $id ?? '' }}">
    <div class="popup__container">
        <div class="popup__content">
            @isset($title)
                <h3 class="popup__title">{{ $title }}</h3>
            @endisset
            {{ $slot }}
        </div>
        <div class="popup__close">&#x2715;</div>
    </div>
</div>
