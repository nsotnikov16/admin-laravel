<x-admin-layout>
    <x-admin.form :collection="$collection" method="POST" :action="route('admin.inserts.save')" type="inserts">
        <div class="form__btns">
            <button class="btn form__btn">Сохранить</button>
        </div>
    </x-admin.form>
</x-admin-layout>
