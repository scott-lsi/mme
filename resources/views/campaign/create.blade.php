<x-app-layout>
    <x-slot:header>Create Campaign</x-slot>
    <div class="container mx-auto"> 
        <form action="{{ route('campaign.store') }}" method="POST">
            @csrf

            <div class="mt-3">
                <label for="name" class="mb-1">Name</label>
                <x-text-input type="text" id="name" name="name" />
            </div>

            <x-primary-button class="mt-4">Create</x-primary-button>
        </form>
    </div>
</x-app-layout>