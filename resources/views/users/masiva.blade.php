@extends('layouts.app')
{{-- Nombre en el title --}}
@section('title')
    {{ __('Usuarios') }}
@endsection
{{-- Nombre en el header --}}
@section('header')
    {{ __('Usuarios') }}
@endsection
{{-- Contenido --}}
@section('content')
    <style>
        ::file-selector-button {
            display: none;
        }

        input[type='file'] {
            color: transparent;
            width: inherit;
            height: inherit;
            position: absolute;

        }
    </style>
    <form class="form" id="employee_form" action="{{ route('usuarios.masivos') }}" method="POST"
        enctype="multipart/form-data">

        @csrf
        <div class="w-full px-4">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-slate-100 border-0">
                <div class="rounded-t bg-white mb-0 px-6 py-6">
                    <div class="text-center flex justify-between">

                        <h6 class="text-slate-700 text-xl font-bold">


                            Registro de Clientes CSV
                        </h6>

                        <div class="flex justify-end">
                            <button id="button" name="button" disabled
                                class="bg-gray-400 text-white active:bg-gray-500 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150"
                                type="submit">
                                {{ __('Subir') }}
                            </button>
                        </div>

                    </div>
                </div>


                <div class="flex items-center justify-center w-full">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click aqui
                                    para subir archivo</span> o arrastra y suelta</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">.CSV</p>
                        </div>
                        <input id="dropzone-file" type="file" accept=".csv" onchange="myFunction()" name="zip_info" />
                        <p id="zipvalue" class="text-sm text-gray-700 dark:text-gray-800"></p>
                    </label>
                </div>

            </div>
        </div>
    </form>
@endsection

@push('js')
    <script>
         document.getElementById("zipvalue").textContent = $('#dropzone-file').val().split('\\').pop().split('/')
                        .pop();
        function myFunction() {
            var file = document.querySelector("#dropzone-file");


            if ($('#dropzone-file').val()) {
                if (/\.(csv)$/i.test(file.files[0].name) === false) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El archivo no esta en formato CSV!',
                    })
                    $('#button').attr('disabled', true)
                } else {
                    $('#button').attr('disabled', false)
                    $('#button').attr('class',
                        'bg-green-500 text-white active:bg-green-800 hover:bg-green-600 hover:shadow-xl font-bold uppercase text-xs px-4 py-2 rounded shadow outline-none focus:outline-none mr-1 ease-linear transition-all duration-150'
                    )
                    document.getElementById("zipvalue").textContent = $('#dropzone-file').val().split('\\').pop().split('/')
                        .pop();
                }
            }

        }

        function myFunction2() {

            var file = document.querySelector("#dropzone-file");


            if ($('#dropzone-file').val()) {
                if (/\.(csv)$/i.test(file.files[0].name) === false) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'El archivo no esta en formato CSV!',
                    })
                    $('#button').attr('disabled', true)
                } else {
                    $('#button').attr('disabled', false)
                    $('#button').attr('class',
                        'bg-blue-400 text-white active:bg-blue-500 font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 w-full'
                    )
                    document.getElementById("filetypeinfo").textContent = $('#dropzone-file').val().split('\\').pop().split(
                        '/').pop();
                }

            }

        }
    </script>
@endpush
