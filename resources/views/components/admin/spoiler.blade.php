<div class="spoiler {{ $addClass ?? '' }}">
    <div class="spoiler__top">
        <input class="spoiler__name" value="{{$title}}" />
        <button class="spoiler__btn"></button>
    </div>
    <div class="spoiler__bottom">
        {{ $slot }}
    </div>
</div>
