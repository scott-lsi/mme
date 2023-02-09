<x-mail::message>

# An Enquiry from Merch Made Easy

Name: {{ $request->name }}

Company: {{ $request->company }}

Email: [{{ $request->email }}](mailto:{{ $request->email }})

Phone: {{ $request->phone_number }}

</x-mail::message>
