<x-app-layout>
    <x-slot:header>Create New Testimonial</x-slot>
    <div class="container mx-auto"> 
       
    <form action="{{ route('salesperson.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="my-3 flex flex-col">
            <label for="testimonial" class="mb-1">Testimonial</label>
            <x-text-input type="text" id="testimonial" name="testimonial" />
        </div>

        <div class="my-3 flex flex-col">
            <label for="name" class="mb-1">Name</label>
            <x-text-input type="text" id="tinametle" name="name" />
        </div>

        <div class="my-3 flex flex-col">
            <label for="position" class="mb-1 text-xl">Position</label>
            <select name="position">
                <option value="" >Please pick a position</option>
                <option value="top">Top</option>
                <option value="bottom">Bottom</option>
            </select>
        </div>

        <x-primary-button>Create</x-primary-button>
    </form>
</x-app-layout>