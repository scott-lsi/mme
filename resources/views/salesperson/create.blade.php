<x-app-layout>
    <x-slot:header>Create New Salesperson</x-slot>
    <div class="container mx-auto"> 

    @if($errors->count())
        <div class="rounded bg-red-300 text-red-900 p-4 m-8">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif
       
    <form action="{{ route('salesperson.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="my-3 flex flex-col">
            <label for="name" class="mb-1">Name</label>
            <x-text-input type="text" id="name" name="name" />
        </div>

        <div class="my-3 flex flex-col">
            <label for="title" class="mb-1">Job Title</label>
            <x-text-input type="text" id="title" name="title" />
        </div>

        <div class="my-3 flex flex-col">
            <label for="picture" class="mb-1 text-xl">Picture</label>
            <input type="file" id="picture" name="picture" />
        </div>

        <div class="my-3 flex flex-col">
            <label for="linkedin" class="mb-1">LinkedIn Tag</label>
            <x-text-input type="text" id="linkedin" name="linkedin" />
        </div>

        <x-primary-button>Create</x-primary-button>
    </form>
</x-app-layout>