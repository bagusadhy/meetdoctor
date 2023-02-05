<x-mail::message>
# New Appointment Created

<h2>Congratulations!</h2> <br>
Your appointment has been created, dont forget to attend on time <br>

<x-mail::table>
| Name             | Doctor         | Consultation            | Date           | Time           | Status           | Total           |
| :---------------:| :-------------:| :----------------------:| :-------------:| :-------------:| :---------------:| :--------------:|
| {{ $user }}      | {{ $doctor }}  | {{ $consultation }}     |{{$date}}       | {{ $time }}    | {{ $status }}    | {{ $total }}    |
</x-mail::table>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
