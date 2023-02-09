<x-app-layout>
    <x-slot:header>Testimonials
        <x-nav-link class="float-right" :href="route('testimonial.create')" :active="request()->routeIs('testimonial.create')">
            {{ __('Add New') }}
        </x-nav-link>
    </x-slot>
    <div class="container mx-auto">   
        <x-table>
            <tr>
                <x-th>Name</x-th>
                <x-th>Testimonial</x-th> 
                <x-th>Position on Homepage</x-th>
                <x-th>Edit</x-th>
            </tr>
            @foreach($testimonials as $testimonial)
            <tr>
                <x-td>{{ $testimonial->name }}</x-td>
                <x-td>{{ $testimonial->testimonial}}</x-td>     
                <x-td>{{ $testimonial->position }}</x-td>      
                <x-td><a href="{{ route('testimonial.edit', $testimonial) }}"><i class="fa-solid fa-pen-to-square"></i></a></x-td>
            </tr>
            @endforeach
        </x-table>
    </div>
</x-app-layout>

