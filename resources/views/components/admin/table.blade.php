@isset($table)
    @if (isset($table['body']) && !empty($table['body']))
        <table class="table {{ $addClass ?? '' }}">
            @isset($table['head'])
                @if (!empty($table['head']))
                    <thead class="table__head">
                        <tr class="table__row">
                            @foreach ($table['head'] as $cell)
                                <td class="table__cell">{{ $cell }}</td>
                            @endforeach
                            <td class="table__cell table__cell_edit"></td>
                            <td class="table__cell table__cell_trash"></td>
                        </tr>
                    </thead>
                @endif
            @endisset
            <tbody class="table__body">
                @foreach ($table['body'] as $row)
                    <tr class="table__row">
                        @foreach ($row as $key => $cell)
                            @continue($key === 'editLink' || $key === 'deleteLink')
                            <td class="table__cell">{{ $cell }}</td>
                        @endforeach
                        <td class="table__cell table__cell_edit">
                            <a href="{{ $row['editLink'] }}"><x-admin.icons.edit /></a>
                        </td>
                        <td class="table__cell table__cell_trash" data-template="{{ $templateLinkDelete }}"
                            data-id="{{ $row['id'] }}"><x-admin.icons.trash /></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endisset
{{-- Для JS --}}
{{-- <template id="template-cell-edit">
    <td class="table__cell table__cell_edit"><a href="{{ $templateLinkEdit }}"><x-admin.icons.edit /></a></td>
</template>
<template id="template-cell-trash">
    <td class="table__cell table__cell_trash" data-template="{{ $templateLinkDelete }}" data-id="#id#">
        <x-admin.icons.trash />
</template>
<template id="template-table">
    <table class="table {{ $addClass ?? '' }}">
        <thead class="table__head"></thead>
        <tbody class="table__tbody"></tbody>
    </table>
</template>
 --}}
