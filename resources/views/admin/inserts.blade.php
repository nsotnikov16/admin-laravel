<x-admin-layout>
    <x-admin.form :collection="$collection" method="POST" :action="route('admin.inserts.save')" />
</x-admin-layout>
