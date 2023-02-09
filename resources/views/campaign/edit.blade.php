<x-app-layout>
    <x-slot:header>Edit Campaign '{{$campaign->name}}'</x-slot>
    <div class="container mx-auto"> 
        <form action="{{ route('campaign.update', $campaign) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mt-3">
                <label for="name" class="mb-1">Name</label>
                <x-text-input type="text" id="name" name="name" value="{{$campaign->name}}" />
            </div>

        <div class="flex flex-row justify-between mt-4">

                <x-primary-button>Update</x-primary-button>
            </form>

            <form action="{{ route('campaign.destroy', $campaign) }}" method="POST">
                @csrf
                @method('DELETE')

                <x-delete-button>Delete</x-delete-button>
            </form>
        </div>
    </div>
</x-app-layout>