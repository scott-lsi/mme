<x-app-layout>
    <x-slot:header>Sales People 
        <x-nav-link class="float-right" :href="route('salesperson.create')" :active="request()->routeIs('salesperson.create')">
            {{ __('Add New') }}
        </x-nav-link>
    </x-slot>
    <div class="container mx-auto">  
        <x-table>
            <tr>
                <x-th>Name</x-th>
                <x-th>Title/Job Title</x-th>
                <x-th>Edit</x-th>
            </tr>
            @foreach($salespeople as $salesperson)
            <tr>
                <x-td>{{ $salesperson->name }}</x-td>  
                <x-td>{{ $salesperson->title }}</x-td>  
                <x-td><a href="{{ route('salesperson.edit', $salesperson) }}"><i class="fa-solid fa-pen-to-square"></i></a></x-td>
            <tr>
            @endforeach
        </x-table>
        
    </div>
    
</x-app-layout>