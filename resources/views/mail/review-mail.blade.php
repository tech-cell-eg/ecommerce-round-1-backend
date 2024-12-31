<x-mail::message>
    Hi, {{$data['email']}}

    {{$data['state']}}

    Your review is: {{$data['message']}}

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
