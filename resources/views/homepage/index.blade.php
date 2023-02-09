<x-app-layout>
    <div class="container mx-auto"> 
        <x-slot:header>Homepages
            <x-nav-link class="float-right" :href="route('homepage.create')" :active="request()->routeIs('homepage.create')">
                {{ __('Add New') }}
            </x-nav-link>
        </x-slot>
        <x-table class="display:grid">
            <tr>
                <x-th class="border-2">Homepage ID</x-th>
                <x-th>Header Text</x-th>
                <x-th>Campaign ID</x-th>
                <x-th>Edit</x-th>
            </tr>
            @foreach($homepages as $homepage)
            <tr>
                <x-td> {{$homepage->id}} </x-td>
                <x-td class="justify-center"> {{Str::limit(strip_tags($homepage->header_text),50)}} </x-td>
                <x-td> {{$homepage->campaign_id}} </x-td>
                <x-td> <a href="{{ route('homepage.edit', $homepage) }}"><i class="fa-solid fa-pen-to-square"></i></a> </x-td>
            </tr>
            @endforeach
        </x-table>
    </div>
</x-app-layout>