@extends('layouts.app')

@section('title', 'User')

@section('content')
    <main class="content">

        @include('components.backsite.header')

        <section class="p-3">

             @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    <ul>
                        @foreach ($errors->all() as $error )
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <header>
                <a href="{{ route('user.index') }}" style="text-decoration-color: #0d1458;">
                    <h3><span><i class="fa-solid fa-chevron-left"></i></span> User</h3>
                </a>
                <p>Manage data for User</p>
            </header>

            <div class="shadow p-3 mb-5 bg-body rounded">
                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <h4 class="mb-4">Update User Data</h4>
                    <hr>
                    <div class="col-8 mx-auto">

                        <div class="form-group row mb-3">
                            <label class="col-sm-2 label-control" for="name">Name <code style="color:red;">*</code></label>
                            <div class="col-sm-10">
                                <input type="text" id="name" name="name" class="form-control" placeholder="example John Doe or Jane" value="{{ old('name', isset($user) ? $user->name : '') }}" autocomplete="off" required>
    
                                @if($errors->has('name'))
                                    <p style="font-style: bold; color: red;">{{ $errors->first('name') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 label-control" for='email'>Email <code style="color:red;">*</code></label>
                            <div class="col-sm-10">
                                <input type="text" id='email' name='email' class="form-control" placeholder="example John Doe or Jane" value="{{ old('email', isset($user) ? $user->email : '') }}" autocomplete="off" required>
    
                                @if($errors->has('email'))
                                    <p style="font-style: bold; color: red;">{{ $errors->first('email') }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label class="col-sm-2 label-control">Role <code style="color:red;">*</code></label>
                            <div class="col-sm-10 mx-auto">
                                <label for="role">
                                    <span class="btn btn-warning btn-sm select-all">{{ 'Select all' }}</span>
                                    <span class="btn btn-warning btn-sm deselect-all">{{ 'Deselect all' }}</span>
                                </label>

                                <select name="role[]"
                                        id="role"
                                        class="form-control select2"
                                        multiple="multiple" required>
                                    @foreach($role as $id => $role)
                                        <option value="{{ $id }}" {{ (in_array($id, old('role', [])) || isset($user) && $user->role->contains($id)) ? 'selected' : '' }}>{{ $role }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('role'))
                                    <p style="font-style: bold; color: red;">{{ $errors->first('role') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-3">
                            <label class="col-sm-2 label-control">Type User <code style="color:red;">*</code></label>
                            <div class="col-sm-10 mx-auto">
                                <select name="type_user_id"
                                        id="type_user_id"
                                        class="form-control select2" required>
                                        <option value="{{ '' }}" disabled selected>Choose</option>
                                    @foreach($type_user as $key => $type_user_item)
                                        <option value="{{ $type_user_item->id }}" {{ $type_user_item->id == $user->detail_user->type_user_id ? 'selected' : '' }}>{{ $type_user_item->name }}</option>
                                    @endforeach
                                </select>

                                @if($errors->has('type_user_id'))
                                    <p style="font-style: bold; color: red;">{{ $errors->first('type_user_id') }}</p>
                                @endif
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Update" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
            
        </section>
    </main>
@endsection

@push('after-script')
    <script>
        $(document).ready(function() {
            $('.select2').select2();

            $('.select-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2')
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change');
            });

            $('.deselect-all').click(function() {
                let $select2 = $(this).parent().siblings('.select2')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change');
            });

        });
    </script>
@endpush

