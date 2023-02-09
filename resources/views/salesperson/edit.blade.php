<x-app-layout>
    <x-slot:header>Update Form for Sales Person: {{$salesperson->id}}</x-slot>
    <div class="container mx-auto"> 
        <form action="{{ route('salesperson.update', $salesperson) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="my-3 flex flex-col">
                <label for="name" class="mb-1 text-xl">Name</label>
                <x-text-input type="text" id="name" name="name" value="{{$salesperson->name}}" />
            </div>

            <div class="my-3 flex flex-col">
                <label for="title" class="mb-1 text-xl">Title/Position</label>
                <x-text-input type="text" id="title" name="title" value="{{$salesperson->title}}" />
            </div>

            <div class="my-3 flex flex-col">
                <label for="picture" class="mb-1 text-xl">Picture</label>
                <input type="file" id="picture" name="picture" value="{{$salesperson->picture}}" />
            </div>

            <div class="my-3 flex flex-col">
                <label for="linkedin" class="mb-1 text-xl">Linked In ID</label>
                <x-text-input type="text" id="linkedin" name="linkedin" value="{{$salesperson->linkedin}}" />
            </div>
            <br>

        <div class="flex flex-row justify-between mt-4">

                <x-primary-button>Update</x-primary-button>
            </form>


            <form action="{{ route('salesperson.destroy', $salesperson) }}" method="POST">
                @csrf
                @method('DELETE')

                <x-delete-button>Delete</x-delete-button>
            </form>
        </div>
    </div>
</x-app-layout>