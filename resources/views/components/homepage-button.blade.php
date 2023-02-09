<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center p-2 bg-blue-600 border border-transparent rounded-md text-xl text-white hover:bg-blue-900 focus:bg-blue-900 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-900 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
