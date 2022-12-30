@extends('layouts.app')

@section('title', 'User Type')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <h3>User Type</h3>
                <p>Manage data for User Type</p>
            </header>

           @foreach ($user_type as $ut)
               <p>{{ $ut['name'] }}</p>
           @endforeach
        </section>
    </main>
@endsection

