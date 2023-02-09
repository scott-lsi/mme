<x-app-layout>
    <x-slot:header>Update Form for Testimonial: {{$testimonial->id}}</x-slot>
    <div class="container mx-auto"> 
        <form action="{{ route('testimonial.update', $testimonial) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="my-3 flex flex-col">
                <label for="testimonial" class="mb-1 text-xl">Testimonial</label>
                <x-text-input type="text" id="testimonial" name="testimonial" value="{{$testimonial->testimonial}}" />
            </div>

            <div class="my-3 flex flex-col">
                <label for="name" class="mb-1 text-xl">Name</label>
                <x-text-input type="text" id="name" name="name" value="{{$testimonial->name}}" />
            </div>

            <div class="my-3 flex flex-col">
                <label for="position" class="mb-1 text-xl">Position</label>
                <select name="position">
                    <option value="" >Please pick a position</option>
                    <option value="top">Top</option>
                    <option value="bottom">Bottom</option>
                </select>
            </div>
            <br>

        <div class="flex flex-row justify-between mt-4">
                <x-primary-button>Update</x-primary-button>
            </form>


            <form action="{{ route('testimonial.destroy', $testimonial) }}" method="POST">
                @csrf
                @method('DELETE')

                <x-delete-button>Delete</x-delete-button>
            </form>
        </div>
    </div>
</x-app-layout>