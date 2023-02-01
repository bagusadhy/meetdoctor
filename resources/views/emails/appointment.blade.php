<x-mail::message>
# Introduction

The body of your message.

<x-mail::table>
| Name             | Doctor         | Consultation            | Date           | Time           | Status           | Total           |
| :---------------:| :-------------:| :----------------------:| :-------------:| :-------------:| :---------------:| :--------------:|
| {{ $user }}      | {{ $doctor }}  | {{ $consultation }}     |{{$date}}       | {{ $time }}    | {{ $status }}    | {{ $total }}    |
</x-mail::table>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
