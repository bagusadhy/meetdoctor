@extends('layouts.app')

@section('title', 'Consultation')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">
            <header>
                <a href="{{ route('consultation.index') }}" style="text-decoration-color: #0d1458;">
                    <h3><span><i class="fa-solid fa-chevron-left"></i></span> Consultation</h3>
                </a>
                <p>Manage data for Consultation</p>
            </header>

             {{-- error --}}
            @if ($errors->any())
                <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="shadow p-3 mb-5 bg-body rounded">
                <form action="{{ route('consultation.update', $consultation->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h4 class="mb-4">Update Consultation Data</h4>
                    <div class="mb-3">
                        <label for="name" class="form-label">Specialist Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $consultation->name }}">
                        @if($errors->has('name'))
                            <p style="font-style: bold; color: red;">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
            
        </section>
    </main>
@endsection

