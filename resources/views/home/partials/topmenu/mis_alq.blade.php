<a href="!{{ route('mis.alquileres',[], false) }}">{{ __('menu.selfcreate') }} <span class="badge">{{ \App\Alquiler::where('usuario',Auth()->user()->id)->count() }}</span></a>
