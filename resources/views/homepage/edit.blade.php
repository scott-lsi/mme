<x-app-layout>
    <x-slot:header>Update Form for Homepage: {{$homepage->id}} in Campaign: {{$homepage->campaign->name}} </x-slot>
    <div class="container mx-auto mb-12"> 
        <form action="{{ route('homepage.update', $homepage) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="my-3">
                <input type="checkbox" id="use_white_logo" name="use_white_logo" value="1" @if($homepage->use_white_logo) checked @endif />
                <label for="use_white_logo" class="mb-1 text-xl">Use White Logo?</label> 
            </div>

            <div class="my-3 flex flex-col">
                <label for="header_image" class="mb-1 text-xl">Header Image</label>
                <input type="file" id="header_image" name="header_image" value="{{$homepage->header_image}}" />
            </div>

            <div class="my-3 flex flex-col">
                <label for="header_text" class="mb-1 text-xl">Header Text</label>
                <textarea name="header_text" id="header_text" class="font-mono" cols="100" rows="10">{{$homepage->header_text}}</textarea>
            </div>
            
            <div class="my-3 flex flex-col">
                <label for="button_text" class="mb-1 text-xl">Button Text</label>
                <x-text-input type="text" id="button_text" name="button_text" value="{{$homepage->button_text}}" />
            </div>

            <div class="my-3 flex flex-col">
                <label for="main_content" class="mb-1 text-xl">Main Content</label>
                <textarea name="main_content" id="main_content" class="font-mono" cols="100" rows="10">{{$homepage->main_content}}</textarea>
            </div>

            <div class="my-3 flex flex-col">
                <label for="youtube_video_id" class="mb-1 text-xl">Youtube Video Id</label>
                <x-text-input type="text" id="youtube_video_id" name="youtube_video_id" value="{{$homepage->youtube_video_id}}" />
            </div>
            <br>
            <div class="my-3"> 
                <h2 class="text-xl">Top Section Testimonials</h2>
                @foreach ($top_testimonials as $testimonial)
                    <div class="">
                        <input type="checkbox" id="testimonials-{{$loop->index}}" name="testimonials[]" value="{{$testimonial->id}}" @if(in_array($testimonial->id, $homepage->testimonials->pluck('id')->toArray())) checked @endif />
                        <label for="testimonials-{{$loop->index}}" class="mb-1">{{$testimonial->testimonial}} - {{$testimonial->name}}</label>  
                    </div>
                @endforeach
            <br>
                <h2 class="text-xl">Bottom Section Testimonials</h2>
                @foreach ($bottom_testimonials as $testimonial)
                    <div class="mt-3">
                        <input type="checkbox" id="testimonials-{{$loop->index}}" name="testimonials[]" value="{{$testimonial->id}}" @if(in_array($testimonial->id, $homepage->testimonials->pluck('id')->toArray())) checked @endif />
                        <label for="testimonials-{{$loop->index}}" class="mb-1">{{$testimonial->testimonial}} - {{$testimonial->name}}</label>  
                    </div>
                @endforeach
            </div>

            <div class="my-3 flex flex-col">
                <label for="bottom_content" class="mb-1 text-xl">Bottom Content</label>
                <textarea name="bottom_content" id="bottom_content" class="font-mono" cols="100" rows="10">{{$homepage->bottom_content}}</textarea>
            </div>

            <div class="my-3">  
            <h2 class="text-xl">Sales People</h2>    
                @foreach ($salespeople as $salesperson)
                <input type="radio" id="salesperson-{{$salesperson->id}}" name="salesperson_id" value="{{$salesperson->id}}" @if($homepage->salesperson_id == $salesperson->id) checked @endif />
                <label for="salesperson-{{$salesperson->id}}" class="mb-1 text-xl">{{$salesperson->name}}</label> [<a href="{{ route('salesperson.edit', $salesperson) }}">Edit</a>]
                 @endforeach
            </div>

        <div class="flex flex-row justify-between mt-4">
                <x-primary-button>Update</x-primary-button>
            </form>

            <form action="{{ route('homepage.destroy', $homepage) }}" method="POST">
                @csrf
                @method('DELETE')

                <x-delete-button>Delete</x-delete-button>
            </form>
        </div>
    </div>
</x-app-layout>