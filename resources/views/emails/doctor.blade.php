<x-mail::message>
# Welcome to MeetDoctor

<h2>Congratulations!....</h2>
now you a doctor in MeetDoctor<br>
use this for sign-in to MeetDoctor <br>
<h3>Username : {{ $email }}</h3>
<h3>Password : {{ $password }}</h3>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
