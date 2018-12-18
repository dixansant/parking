{{-- Se llama desde el login correcto / logout para actualizar los partials del home --}}





<div class="partials">

    @include('home.partials.topmenu', ['idnav'=>'navbar'])
    @include('home.partials.usermenu')
    @include('home.startpage');
    @include('home.partials.primary')

    <script class="partial">
        // Al iniciar, borra todas las escenas
        //clearScenes('home');

    </script>
</div>