<div class="breadcrumbs">
    <ul class="breadcrumbs__list">
        @foreach ($items as $key => $item)
            <li class="breadcrumbs__item">
                @if ($key === count($items) - 1)
                    <span href="#" class="breadcrumbs__link breadcrumbs__link_last">{{ $item['name'] }}</span>
                @else
                    <a href="{{ $item['link'] }}" class="breadcrumbs__link scale">{{ $item['name'] }}</a>
                @endif
            </li>
        @endforeach
    </ul>
</div>
