<x-admin-layout>
    <x-admin.form :collection="$collection" :method="$method ?? 'GET'" :action="$action">
        <div class="form__btns">
            <button class="btn form__btn">{{ $btnText }}</button>
        </div>
    </x-admin.form>
</x-admin-layout>
