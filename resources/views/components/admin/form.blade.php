@php
    use Illuminate\Support\Str;
@endphp
<form method="{{ $method ?? 'GET' }}" action="{{ $action ?? '' }}" class="form" data-form="{{ $type ?? '' }}">
    @csrf
    @foreach ($collection as $dto)
        @php
            $fieldId = Str::random(9);
        @endphp

        <div class="form__row {{ $dto->line ? 'form__row_line' : '' }}">
            @switch($dto->type)
                @case('text')
                    <label for="{{ $fieldId }}" class="form__label">{{ $dto->label }}</label>
                    @if ($dto->readOnly)
                        <span>{{ $dto->value }}</span>
                    @else
                        <input id="{{ $fieldId }}" type="text" name="{{ $dto->name }}"
                            placeholder="{{ $dto->placeholder }}" value="{{ $dto->value }}" class="form__field">
                    @endif
                @break

                @case('textarea')
                    <label for="{{ $fieldId }}" class="form__label">{{ $dto->label }}</label>
                    <textarea id="{{ $fieldId }}" name="{{ $dto->name }}" placeholder="{{ $dto->placeholder }}"
                        class="form__field" rows="{{ $dto->textareaRows }}">{{ $dto->value }}</textarea>
                @break

                @case('checkbox')
                    <div class="checkbox">
                        <input id="{{ $fieldId }}" type="checkbox" name="{{ $dto->name }}" class="checkbox__input"
                            @checked($dto->checked) value="{{ $dto->value }}">
                        <label for="{{ $fieldId }}" class="checkbox__label">{{ $dto->label }}</label>
                    </div>
                @break

                @case('dropdown')
                    @if ($dto->collection->isNotEmpty())
                        <label for="{{ $fieldId }}" class="form__label">{{ $dto->label }}</label>
                        <x-admin.dropdown addClass="search__dropdown" :collection="$dto->collection" />
                    @endif
                @break

                @default
            @endswitch
        </div>
    @endforeach

    {{ $slot }}

    {{--  <div class="form__row">
        <label for="#" class="form__label">Название</label>
        <input type="text" name="name" placeholder="Название" class="form__field">
    </div>
    <div class="form__row">
        <label for="#" class="form__label">Символьный код</label>
        <input type="text" name="code" placeholder="Символьный код" class="form__field">
    </div>
    <div class="form__row form__row_line">
        <label for="#" class="form__label">Категория</label>
        <div class="dropdown">
            <div class="dropdown__choice btn" data-dropdown-show data-start-text="Категория">Категория</div>
            <div class="dropdown__container">
                <ul class="dropdown__list">
                    <li class="dropdown__item">
                        <div class="checkbox">
                            <input type="checkbox" class="checkbox__input" name="a" value="1"
                                @checked(false)>
                            <label class="checkbox__label">Блог</span></label>
                        </div>
                    </li>
                    <li class="dropdown__item">
                        <div class="checkbox">
                            <input type="checkbox" class="checkbox__input" name="a" value="2"
                                @checked(false)>
                            <label class="checkbox__label">Спорт</span></label>
                        </div>
                    </li>
                    <li class="dropdown__item">
                        <div class="checkbox">
                            <input type="checkbox" class="checkbox__input" name="a" value="3"
                                @checked(false)>
                            <label class="checkbox__label">Медицина</span></label>
                        </div>
                    </li>
                    <li class="dropdown__item">
                        <div class="checkbox">
                            <input type="checkbox" class="checkbox__input" name="a" value="4"
                                @checked(false)>
                            <label class="checkbox__label">Технологии</label>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="form__row">
        <div class="checkbox">
            <input type="checkbox" class="checkbox__input">
            <label for="" class="checkbox__label">Активность</label>
        </div>
    </div>
    <div class="form__row">
        <label for="#" class="form__label">Описание</label>
        <textarea name="" id="" cols="30" rows="10" class="form__field">

        </textarea>
    </div>
    <div class="form__btns">
        <button class="btn form__btn">Изменить</button>
    </div> --}}
</form>
