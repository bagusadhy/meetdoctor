<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title') | Meet Doctor Administration</title>
    
        @stack('before-style')
            @include('includes.backsite.style')
        @stack('after-style')
        
    <body>

       @include('sweetalert::alert')

        @include('components.backsite.menu')
        @yield('content')
        {{-- @include('components.backsite.header') --}}
        @include('components.backsite.footer')

        @stack('before-script')
            @include('includes.backsite.script')
        @stack('after-script')

    </body>
</html>