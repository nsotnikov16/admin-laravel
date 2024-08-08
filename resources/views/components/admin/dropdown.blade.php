<div class="dropdown {{ $addClass ?? '' }}">
    <div class="dropdown__choice btn" data-dropdown-show data-start-text="{{ $btnText }}">{{ $btnText }}</div>
    <div class="dropdown__container">
        <ul class="dropdown__list">
            @foreach ($items as $item)
                @isset($item['name'], $item['value'], $item['label'])
                    <li class="dropdown__item">
                        <div class="checkbox">
                            <input type="checkbox" class="checkbox__input" name="{{ $item['name'] }}"
                                value="{{ $item['value'] }}" @checked($item['checked'] ?? false)>
                            <label class="checkbox__label">{{ $item['label'] }}</span></label>
                        </div>
                    </li>
                @endisset
            @endforeach
        </ul>
    </div>
</div>
