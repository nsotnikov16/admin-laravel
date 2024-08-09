@php
    use Illuminate\Support\Str;
@endphp
<div class="dropdown {{ $addClass ?? '' }}">
    <div class="dropdown__choice btn" data-dropdown-show data-start-text="{{ $btnText }}">{{ $btnText }}</div>
    <div class="dropdown__container">
        <ul class="dropdown__list">
            @foreach ($items as $item)
                @isset($item['name'], $item['value'], $item['label'])
                    @php
                        $fieldId = Str::random(9);
                    @endphp
                    <li class="dropdown__item">
                        <div class="checkbox">
                            <input id="{{ $fieldId }}" type="{{ $isRadio ? 'radio' : 'checkbox' }}"
                                class="checkbox__input" name="{{ $item['name'] }}" value="{{ $item['value'] }}"
                                @checked($item['checked'] ?? false)>
                            <label for="{{ $fieldId }}" class="checkbox__label">{{ $item['label'] }}</span></label>
                        </div>
                    </li>
                @endisset
            @endforeach
        </ul>
    </div>
</div>
