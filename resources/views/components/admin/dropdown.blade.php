@php
    // см. DropdownCollectionDto
    use Illuminate\Support\Str;
@endphp
@if ($collection->isNotEmpty())
    <div class="dropdown {{ $addClass ?? '' }}">
        <div class="dropdown__choice btn" data-dropdown-show data-start-text="{{ $collection->buttonText }}">
            {{ $collection->buttonText }}
        </div>
        <div class="dropdown__container">
            <ul class="dropdown__list">
                @foreach ($collection as $item)
                    @php
                        $fieldId = Str::random(9);
                    @endphp
                    <li class="dropdown__item">
                        <div class="checkbox">
                            <input id="{{ $fieldId }}" type="{{ $collection->isRadio ? 'radio' : 'checkbox' }}"
                                class="checkbox__input" name="{{ $item->name }}" value="{{ $item->value }}"
                                @checked($item->checked ?? false)>
                            <label for="{{ $fieldId }}" class="checkbox__label">{{ $item->label }}</span></label>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
