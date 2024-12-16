<x-mail::message>
    Hi, {{$user->first_name}}

    We received a request to access your account
    Your reset code is: {{$token}}

    Thanks,
    {{ config('app.name') }}
</x-mail::message>