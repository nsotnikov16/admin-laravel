@isset($body)
    @if (!empty($body))
        <table class="table {{ $addClass ?? '' }}">
            @isset($head)
                @if (!empty($head))
                    <thead class="table__head">
                        <tr class="table__row">
                            @foreach ($head as $cell)
                                <td class="table__cell">{{ $cell }}</td>
                            @endforeach
                            <td class="table__cell table__cell_edit"></td>
                            <td class="table__cell table__cell_trash"></td>
                        </tr>
                    </thead>
                @endif
            @endisset
            <tbody class="table__body">
                @foreach ($body as $row)
                    <tr class="table__row">
                        @foreach ($row as $cell)
                            <td class="table__cell">{{ $cell }}</td>
                        @endforeach
                        <td class="table__cell table__cell_edit"><x-admin.icons.edit /></td>
                        <td class="table__cell table__cell_trash"><x-admin.icons.trash />
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endisset
{{-- Для JS --}}
<template id="template-cell-edit">
    <td class="table__cell table__cell_edit"><x-admin.icons.edit /></td>
</template>
<template id="template-cell-trash">
    <td class="table__cell table__cell_trash"><x-admin.icons.trash />
</template>
<template id="template-table">
    <table class="table {{ $addClass ?? '' }}">
        <thead class="table__head"></thead>
        <tbody class="table__tbody"></tbody>
    </table>
</template>
