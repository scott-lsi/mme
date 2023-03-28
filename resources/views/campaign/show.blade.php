<x-guest-layout>
    <x-slot:title>{{ $homepage->campaign->name }}</x-slot>

    <div x-data="{ 'formModal': false }" @keydown.escape="formModal = false">
        <div class="flex content-between flex-wrap" id="header" style="background-image: url({{ asset('storage/headerimage/' . $homepage->header_image) }});">
            <div class="container mx-auto px-4">
                @if($homepage->use_white_logo)
                    <img src="{{ asset('images/logo-white.png') }}" alt="white logo" class="max-h-[10vh] mb-10">
                @else
                    <img src="{{ asset('images/logo-colour.png') }}" alt="colour logo" class="max-h-[10vh] mb-10">
                @endif

                <div class="flex flex-row mb-2">
                    <div class="columns-2xl mx-auto md:mx-0 md:col-lg">
                        {!! $homepage->header_text !!}

                        <x-homepage-button type="button" @click="formModal = true">{{ $homepage->button_text }}</x-homepage-button>
                    </div>
                </div>
            </div>

            <div class="bg-pink-500 w-full p-4 text-lg text-center">
                <p class="font-extrabold italic">{{ $testimonials['top']->testimonial }} - <span class="font-normal not-italic">{{ $testimonials['top']->name }}</span></p>
            </div>
        </div>

        <div class="container mx-auto px-4 pt-16">
            <div class="flex flex-row mx-auto md:mx-0 md:columns-lg mb-2">
                {!! $homepage->main_content !!}
            </div>

            <div class="py-12 mx-auto">
                <iframe class="w-full aspect-video" src="https://www.youtube.com/embed/{{ $homepage->youtube_video_id }}" allowfullscreen></iframe>
            </div>
        </div>

        <div class="bg-pink-500 text-white w-full p-4 text-lg text-center">
            <p class="font-extrabold italic">{{ $testimonials['bottom']->testimonial }} - <span class="font-normal not-italic">{{ $testimonials['bottom']->name }}</span></p>
        </div>

        <div class="container mx-auto px-4 pt-16">
            <div class="flex flex-row mx-auto md:mx-0 md:columns-lg mb-2">
                <div class="columns-2xl mx-auto md:mx-0 md:col-lg">
                    <img src="{{ asset ('storage/salesperson/' . $homepage->salesperson->picture) }}" alt="{{ $homepage->salesperson->name }}" class="rounded-full">
                </div>

                <div class="columns-2xl mx-auto md:mx-0 md:col-lg">
                    {!! $homepage->bottom_content !!}

                    <x-homepage-button type="button" @click="formModal = true">{{ $homepage->button_text }}</x-homepage-button>
                </div>
            </div>
        </div>


    {{-- Form Modal --}}
        <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="formModal">
            <div class="max-w-3xl px-6 py-4 mx-auto text-left bg-white rounded shadow-lg" @click.away="formModal = false" 
                x-transition:enter="motion-safe:ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100">

                <div class="flex items-center justify-between">
                    <h5 class="mr-3 text-black max-w-none">Email Submission Form</h5>
                </div>

                <div>
                    <p>Please send us an enquiry and we'll get back to you asap</p>

                    <form action="{{ route('campaign.form', $homepage) }}" method="POST">
                        @csrf

                        <div class="flex flex-row">
                            <div class="my-3 mr-3 flex flex-col">
                                <label for="name" class="mb-1 text-xl">Name (Required)</label>
                                <x-text-input type="text" id="name" name="name" />
                            </div>

                            <div class="my-3 flex flex-col">
                                <label for="company" class="mb-1 text-xl">Company (Required)</label>
                                <x-text-input type="text" id="company" name="company" />
                            </div>
                        </div>

                        <div class="my-3 flex flex-col">
                            <label for="email" class="mb-1 text-xl">Email (Required)</label>
                            <x-text-input type="email" id="email" name="email" />
                        </div>

                        <div class="my-3 flex flex-col">
                            <label for="phone" class="mb-1 text-xl">Phone Number</label>
                            <x-text-input type="tel" id="phone" name="phone" />
                        </div>

                        <div class="flex flex-row justify-end">
                            <x-primary-button class="g-recaptcha mr-4" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-callback='onSubmit' data-action='submit'> Send</x-primary-button>
                            <x-delete-button type="button" class="z-50 cursor-pointer" @click="formModal = false">Close</x-delete-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Thankyou Modal --}}
    <div x-data="{ 'thankyouModal': {{ request('status') == 'thanks' }} }" @keydown.escape="thankyouModal = false">
        <div class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50" x-show="thankyouModal">
            <div class="max-w-5xl px-6 py-4 mx-auto text-left bg-white rounded shadow-lg" @click.away="thankyouModal = false" 
                x-transition:enter="motion-safe:ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100">

                <h2 class="text-3xl">Thank You!</h2>              

                <div class="flex flex-row justify-between">
                    <div class="flex flex-col justify-between mr-16">
                        <div class="text-xl">
                            You have now made the first step towards saving yourself time, money, and resources when it comes to promotional merchandise!<br>
                            Your very own sales advisor will be in touch shortly with more information.
                        </div>

                        <div class="flex flex-row justify-beginning">
                            <a href="https://www.facebook.com/LSiPromotional/">
                                <i class="fa-brands fa-square-facebook h-12"></i>
                            </a>

                            <a href="https://twitter.com/promo_merch" class="mx-2">
                                <i class="fa-brands fa-square-twitter h-12"></i>
                            </a>

                            <a href="https://www.linkedin.com/in/{{ $homepage->salesperson->linkedin_id }}">
                                <i class="fa-brands fa-linkedin h-12"></i>
                            </a>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <img src="{{ asset ('storage/salesperson/' . $homepage->salesperson->picture) }}" alt="{{ $homepage->salesperson->name }}" class="rounded-full">
                        <p class="font-bold mx-auto">{{ $homepage->salesperson->name }}</p>
                        <p class="italic mx-auto">{{ $homepage->salesperson->title }}</p>
                    </div>
                </div>

                <div class="flex flex-row">
                    <div class="bg-pink text-white p-4 rounded-lg mr-2">
                        &ldquo;5 star service. We had a really tight turnaround time but this was no trouble for LSI. Highly recommend this company for any promotional materials, we will definitely use again in the future.&rdquo; - Laura 
                    </div>

                    <div class="bg-pink text-white p-4 rounded-lg mx-2">
                        &ldquo;Simple quotation, order and payment process, with a thorough artwork/branding approval process for clarity. Good quality items, exactly how I wanted them. Will use again. Well done LSi.&rdquo; - John 
                    </div>

                    <div class="bg-pink text-white p-4 rounded-lg ml-2">
                        &ldquo;Service was fantastic Emma dealt with the order and nothing was too much trouble. Communications were great and everything went smoothly. Highly recommend the LSi team&rdquo; - Michael  
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>