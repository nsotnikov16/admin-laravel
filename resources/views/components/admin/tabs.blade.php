{{-- Табы с перезагрузкой страниц --}}
@if (isset($tabs) && !empty($tabs))
    <div class="tabs">
        @foreach ($tabs as $tab)
            @php
                $isActive = isset($tab['active']) && $tab['active'] === true;
            @endphp
            <div class="tabs__tab @if ($isActive) tabs__tab_active @endif">
                <a href="{{ $tab['link'] }}" class="tabs__tab-link">{{ $tab['name'] }}</a>
            </div>
        @endforeach
    </div>
@endif
