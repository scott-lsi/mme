<x-app-layout>
    <div class="container mx-auto"> 
        <x-slot:header>Campaign Index
            <x-nav-link class="float-right" :href="route('campaign.create')" :active="request()->routeIs('campaign.create')">
                {{ __('Add New') }}
            </x-nav-link>
        </x-slot>
        <x-table>
            <tr>
                <x-th>Id</x-th>
                <x-th>Name</x-th>
                <x-th>Edit</x-th>
            </tr>
            @foreach($campaigns as $campaign)
            <tr>
                <x-td>{{ $campaign->id }}</x-td>  
                <x-td><a href="{{ route('campaign.show' , $campaign) }}">{{ $campaign->name }}</a></x-td>  
                <x-td><a href="{{ route('campaign.edit', $campaign) }}"><i class="fa-solid fa-pen-to-square"></i></a></x-td>
            </tr>
            @endforeach
        </x-table>
    </div>
</x-app-layout>