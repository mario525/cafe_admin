@php
    $route = Route::current()->getName();
@endphp
{{-- Estilo de Nav/Colapse para que se ajuste sin necesidad de cambiar el App --}}
<style>
    .collapse-title,
    .collapse>input[type="checkbox"] {
        width: 100%;
        padding: 0rem;
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
        min-height: 0rem;
        transition: background-color 0.2s ease-in-out;
    }


    .collapse-arrow .collapse-title:after {

        top: 0.8rem;
        left: 12rem;

    }
</style>
{{-- Estilo de Nav/Colapse para que se ajuste sin necesidad de cambiar el App --}}
<nav
    class=" bg-white md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
    <div
        class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
        <button
            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
            type="button" onclick="toggleNavbar('example-collapse-sidebar')">
            <i class="fas fa-bars"></i>
        </button>
        <a href="{{ route('dashboard') }}" class="m-auto" aria-label="Dashboard">
            @if (isset($setting->logo))
                <img src="{{ asset('upload/site_setting/' . $setting->logo) }}" alt="" style="height: 70px;">
            @else
                <img src="{{ asset('img/no_image.jpg') }}" style="height: 70px;">
            @endif
        </a>
        {{-- START header en moviles --}}
        <ul class="md:hidden items-center flex flex-wrap list-none">
            <li class="inline-block relative">
                <a class="text-gray-600 block" href="#" onclick="openDropdown(event,'user-responsive-dropdown')">
                    <div class="items-center flex">
                        <span
                            class="w-12 h-12 text-sm text-slate-700 bg-slate-400 inline-flex items-center justify-center rounded-full">
                            <img alt="profile picture" class="w-full rounded-full align-middle border-none shadow-lg"
                                src="{{ Auth::user()->profile_photo_url ?? asset('img/user.png') }}" />
                        </span>
                    </div>
                </a>
                <div class="hidden bg-white text-base text-center z-50 float-left py-2 list-none text-left rounded shadow-lg min-w-48"
                    id="user-responsive-dropdown">
                    <a href="{{ route('profile.show') }}"
                        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:text-gray-600"><i
                            class="fas fa-user"></i> {{ __('Profile') }}</a>
                    <a href="#"
                        class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:text-gray-600"><i
                            class="fas fa-tools"></i> {{ __('Settings') }}</a>
                    <div class="h-0 my-2 border border-solid border-slate-100"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type=" submit" @click.prevent="$root.submit();"
                            class="text-sm py-2 px-4 font-normal block w-full whitespace-nowrap bg-transparent hover:text-red-500">
                            <i class="fas fa-sign-out-alt"></i>{{ __('Sign Out') }}
                        </button>
                    </form>
                </div>
            </li>
        </ul>
        {{-- END header en moviles --}}
        {{-- START Navigation --}}
        <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-1 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden"
            id="example-collapse-sidebar">
            {{-- START Navigation header --}}
            <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-slate-200">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <a class="md:block text-left md:pb-2 text-slate-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
                            href="{{ route('dashboard') }}">
                            @if (isset($setting->logo))
                                <img class="h-10" src="{{ asset('storage/upload/site_setting/' . $setting->logo) }}">
                            @else
                                <img class="h-10" src="{{ asset('img/no_image.jpg') }}">
                            @endif
                        </a>
                    </div>
                    <div class="w-6/12 flex justify-end">
                        <button type="button"
                            class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                            onclick="toggleNavbar('example-collapse-sidebar')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
            {{-- END Navigation header --}}
            {{-- Divider --}}
            <hr class="my-4 md:min-w-full " />
            {{-- START Dashboard --}}
            <ul class="md:flex-col md:min-w-full flex flex-col list-none text-gray-700">
                <li class="items-center">
                    <x-sidebar.list-item title='Dashboard' icon='fas fa-tv' :route='$route' href='dashboard'>
                    </x-sidebar.list-item>
                </li>
            </ul>
            {{-- END Dashboard --}}
            {{-- Divider --}}<div class="hrs">
                <hr class="my-4 md:min-w-full " />
            </div>
            {{-- Heading --}}
               {{-- START Pedidos Pendientes --}}
               <ul>
                <x-sidebar.list-item title='Pedidos Activos' icon='fas fa-running' :route='$route' href='activos' :count="$active_count">
                </x-sidebar.list-item>
            </ul>
            {{-- END Pedidos Pendientes --}}
               {{-- START Historial Pedidos --}}
               <ul>
                <x-sidebar.list-item title='Historial de Pedidos' icon='fas fa-university' :route='$route' href='pedidos.detalles'>
                </x-sidebar.list-item>
            </ul>
            {{-- END Historial Pedidos --}}
             {{-- START Usuarios Detalles --}}
             <ul>
                <x-sidebar.list-item title='Clientes' icon='fas fa-users' :route='$route' href='usuarios.detalles'>
                </x-sidebar.list-item>
            </ul>
            {{-- END Usuarios Detalles --}}
            {{-- START Settings --}}
            <ul>
                <x-sidebar.list-item title='Productos' icon='fas fa-utensils' :route='$route' href='products'>
                </x-sidebar.list-item>
            </ul>
            {{-- END Settings --}}

             {{-- START Settings --}}
             <ul>
                <x-sidebar.list-item title='Insumos' icon='fas fa-cookie-bite' :route='$route' href='insumos.detalles'>
                </x-sidebar.list-item>
            </ul>
            {{-- END Settings --}}
            {{-- START Categorias --}}
           {{--   <ul>
                <x-sidebar.list-item title='Categorias' icon='fas fa-tools' :route='$route' href='categorias.detalles'>
                </x-sidebar.list-item>
            </ul>--}}
            {{-- END Categorias --}}
            {{-- START Settings --}}
            <ul>
                <x-sidebar.list-item title='Configuracion' icon='fas fa-tools' :route='$route' href='configs.index'>
                </x-sidebar.list-item>
            </ul>
            {{-- END Settings --}}


            {{-- END consultas --}}
        </div>
        {{-- END Navigation --}}
    </div>
</nav>
