<div class="breadcrumbs">
    <ul class="breadcrumbs__list">
        @foreach ($collection as $key => $dto)
            <li class="breadcrumbs__item">
                @if ($key === count($collection) - 1)
                    <span class="breadcrumbs__link breadcrumbs__link_last">{{ $dto->name }}</span>
                @else
                    <a href="{{ $dto->link }}" class="breadcrumbs__link scale">{{ $dto->name }}</a>
                @endif
            </li>
        @endforeach
    </ul>
</div>
