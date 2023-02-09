<x-app-layout>
    <x-slot:header>Create Homepage</x-slot>
    <div class="container mx-auto"> 

    @if($errors->count())
        <div class="rounded bg-red-300 text-red-900 p-4 m-8">
            @foreach($errors->all() as $error)
                {{ $error }}<br>
            @endforeach
        </div>
    @endif

        <form action="{{ route('homepage.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="my-3 flex flex-col">
            <label for="campaign_id" class="mb-1 text-xl">Campaign</label>
            <select name="campaign_id">
                <option value="" >Please Pick One</option>
                @foreach ($campaigns as $campaign)
                    <option value="{{$campaign->id}}" >{{$campaign->name}}</option>
                @endforeach
            </select>
            </div>

            <div class="my-3">
                <input type="checkbox" id="use_white_logo" name="use_white_logo" value="1"/>
                <label for="use_white_logo" class="mb-1 text-xl">Use White Logo?</label> 
            </div>

            <div class="my-3 flex flex-col">
                <label for="header_image" class="mb-1 text-xl">Header Image</label>
                <input type="file" id="header_image" name="header_image" />
            </div>


            <div class="my-3 flex flex-col">
                <label for="header_text" class="mb-1 text-xl">Header Text</label>
                <textarea name="header_text" id="header_text" class="font-mono" cols="100" rows="10"></textarea>
            </div>

            <div class="my-3 flex flex-col">
                <label for="button_text" class="mb-1 text-xl">Button Text</label>
                <x-text-input type="text" id="button_text" name="button_text" value="" />
            </div>

            <div class="my-3 flex flex-col">
                <label for="main_content" class="mb-1 text-xl">Main Content</label>
                <textarea name="main_content" id="main_content" class="font-mono" cols="100" rows="10"></textarea>
            </div>

            <div class="my-3 flex flex-col">
                <label for="youtube_video_id" class="mb-1 text-xl">Youtube Video Id</label>
                <x-text-input type="text" id="youtube_video_id" name="youtube_video_id" value="" />
            </div>
            <br>
            <div class="my-3"> 
                <h2 class="text-xl">Top Section Testimonials</h2>
                @foreach ($top_testimonials as $testimonial)
                    <div class="">
                        <input type="checkbox" id="testimonials-{{$loop->index}}" name="testimonials[]" value="{{$testimonial->id}}"/>
                        <label for="testimonials-{{$loop->index}}" class="mb-1">{{$testimonial->testimonial}} - {{$testimonial->name}}</label>  
                    </div>
                @endforeach
            <br>
                <h2 class="text-xl">Bottom Section Testimonials</h2>
                @foreach ($bottom_testimonials as $testimonial)
                    <div class="mt-3">
                        <input type="checkbox" id="testimonials-{{$loop->index}}" name="testimonials[]" value="{{$testimonial->id}}"/>
                        <label for="testimonials-{{$loop->index}}" class="mb-1">{{$testimonial->testimonial}} - {{$testimonial->name}}</label>  
                    </div>
                @endforeach
            </div>

            <div class="my-3 flex flex-col">
                <label for="bottom_content" class="mb-1 text-xl">Bottom Content</label>
                <textarea name="bottom_content" id="bottom_content" class="font-mono" cols="100" rows="10"></textarea>
            </div>

            <div class="my-3">  
            <h2 class="text-xl">Sales People</h2>  
              
                @foreach ($salespeople as $salesperson)
                <input type="radio" id="salesperson-{{$salesperson->id}}" name="salesperson_id" value="{{$salesperson->id}}"/>
                <label for="salesperson-{{$salesperson->id}}" class="mb-1 text-xl">{{$salesperson->name}}</label> [<a href="{{ route('salesperson.edit', $salesperson) }}">Edit</a>]
                 @endforeach
            </div>
            <x-primary-button>Update</x-primary-button>
        </form>

    </div>
</x-app-layout>