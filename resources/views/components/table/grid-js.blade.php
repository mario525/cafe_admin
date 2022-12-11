<div class="w-full px-4">
    <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-slate-100 border-0">
        <div class="rounded-t bg-white mb-0 px-6 py-6">
            <div class="text-center flex justify-between">
                <h6 class="text-slate-700 text-xl font-bold">
                    @if (!$icon == '')
                        <div
                            class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-full bg-blue-700">
                            <i class="{{ $icon }}"></i>
                        </div>
                    @endif

                    {{ __($title) }}
                </h6>
                @if ($create)
                    {{-- START button add item --}}
                    <div class="flex justify-end">
                        @if ($masivo)
                            <x-button-link title="Agregar clientes con .csv" color="green-500" id="button"
                                name="button" href="{{ route('subida.csv') }}">
                            </x-button-link>
                        @endif
                        <x-button-link title="{{ __('Agregar ') }} {{ __($title) }}" color="green-500"
                            id="button" name="button" href="{{ route($url . '.create') }}">
                        </x-button-link>

                    </div>
                    {{-- END button add item --}}
                @endif
            </div>
        </div>

        {{-- START GridJs --}}
        <div id="{{ $id }}" class="m-0"></div>
        {{-- END GridJs --}}
    </div>
</div>

@push('js')
    <script>
        // Variable con los registros
        var json_data;

        // Cargamos
        initialLoad()

        // Función que carga todo
        function initialLoad() {
            getDataSource();
        }

        // Cambia el status a inactivo del registro selecionado
        function disableRecord(id) {
            var url = "{{ route($url . '.destroy', [$parameter => 'value']) }}";
            url = url.replace('value', id);
            $.ajax({
                url: url,
                type: "delete",
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(data) {
                    Swal.fire(
                        "{{ __('Deshabilitado') }}",
                        "{{ __('El registro ha sido deshabilitado.') }}",
                        'Exito'
                    ).then((result) => {
                        location.reload();
                    })
                },
                error: function() {
                    toastr.error(data);
                }
            });
        }

        /* Confirmamos si desea desactivar el registro  */
        function myConfirm(id) {
            Swal.fire({
                title: "{{ __('Quieres deshabilitar el registro?') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('Si') }}",
                cancelButtonText: "{{ __('No') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    disableRecord(id)
                }
            })
        }

        // Muestra los datos del campo selecionado
        function showData(id) {
            var url = "{{ route($url . '.edit', [$parameter => 'value']) }}";
            url = url.replace('value', id);
            var action = "{{ route($url . '.update', 'id') }}"
            action = action.replace('id', id);
            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {
                    // Muestra los datos y desabilita las funciones
                    $("#name_edit").prop('disabled', false);
                    $("#lastnamep_edit").prop('disabled', false);
                    $("#lastnamem_edit").prop('disabled', false);
                    $("#status").prop('disabled', false);
                    document.getElementById("ocultarenshow").style.display = "block";
                    // Mostrara los datos del controller al model
                    $("#id_agent_edit").val(data.id)
                    $("#name_edit").val(data.name)
                    $("#lastnamep_edit").val(data.lastname_p)
                    $("#lastnamem_edit").val(data.lastname_m)
                    $('#banners_edit').attr('action', action);
                    document.getElementById('status').value = data.status;
                    modalHandler(true, 'editmodel', id);
                },
                error: function() {
                    toastr.warning('{{ __('Something went wrong!') }}');
                }
            });
        }

        // Muestra los datos del campo selecionado
        function onlyshowdata(id) {
            var url = "{{ route($url . '.show', [$parameter => 'value']) }}";
            url = url.replace('value', id);
            $.ajax({
                url: url,
                type: "GET",
                success: function(data) {
                    // Oculta los datos y desabilita las funciones
                    $("#name_edit").prop('disabled', true);
                    $("#email_edit").prop('disabled', true);
                    $("#lastnamem_edit").prop('disabled', true);
                    $("#status").prop('disabled', true);
                    document.getElementById("ocultarenshow").style.display = "none";
                    // Mostrara los datos del controller al model
                    $("#name_edit").val(data.name)
                    $("#email_edit").val(data.email)
                    $("#lastnamem_edit").val(data.lastname_m)
                    document.getElementById('status').value = data.status;
                    modalHandler(true, 'editmodel', id);
                },
                error: function() {
                    toastr.warning("{{ __('Looks like something went wrong!') }}");
                }
            });
        }

        // Traduce el status de ingles a español
        function traductorjson_status(archivojson, palabrabuscar, palabratraducir) {
            for (var i = 0; i < archivojson.length; ++i) {
                if (archivojson[i].status === palabrabuscar) {
                    archivojson[i].status = palabratraducir;
                }
            }
        }

        // Se obtienen los Json de registros que es la fuente de datos del gridjs
        function getDataSource() {
            $.ajax({
                url: "{{ route($url . '.index') }}",
                type: "GET",
                dataType: "json",
                async: false,
                data: {
                    "_token": $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(data) {

                    // traductorjson_status(data.banners, "INACTIVE", "INACTIVO")
                    // traductorjson_status(data.banners, "ACTIVE", "ACTIVO")

                    // con la siguiente línea me deshago de tener que llamar al tipo de objeto devuelto
                    // por ejemplo: json_data = data.banners;
                    // y permite la reutilización del gridjs
                    // SOLO ESTAR CONCIENTES DE LO QUE RETORNA EL CONTROLLER POR QUE ESTERMOS TOMANDO LO PRIMERO
                    json_data = data[Object.keys(data)[0]];

                },
                error: function() {
                    toastr.warning("{{ __('Looks like something went wrong!') }}");
                }
            });
        }
        $("div#{{ $id }}").Grid({
            columns: [
                {{ $columns }},

                @if ($show || $edit || $delete)
                    {
                        id: 'accion',
                        name: "{{ __('') }}",
                        sort: false,
                        formatter: (cell, row) => {
                            var show = edit = deletethis = null

                            @if ($show)
                                var urlShow = "{{ route($url . '.show', [$parameter => 'value']) }}";
                                urlShow = urlShow.replace('value', row.cells[0].data);

                                var show = h('a', {
                                    href: urlShow,
                                    className: 'fas fa-eye p-4  mr-1 text-white p-3 text-center inline-flex items-center justify-center w-11  shadow-lg rounded-full bg-yellow-400',
                                }, '');
                            @endif

                            @if ($edit)
                                var urlEdit = "{{ route($url . '.edit', [$parameter => 'value']) }}";
                                urlEdit = urlEdit.replace('value', row.cells[0].data);

                                var edit = h('a', {
                                    href: urlEdit,
                                    className: 'fas fa-edit p-4  mr-1 text-white p-3 text-center inline-flex items-center justify-center w-11  shadow-lg rounded-full bg-blue-500',
                                }, '');
                            @endif

                            @if ($delete)
                                if (row.cells[1].data == 'ACTIVO') {
                                    var deletethis = h('button', {
                                        className: 'fas fa-trash p-4  mr-1  text-white p-3 text-center inline-flex items-center justify-center w-11  shadow-lg rounded-full bg-red-500',
                                        onClick: () => myConfirm(row.cells[0].data),
                                    }, '');
                                } else if (row.cells[2].data == 'INACTIVO') {
                                    var deletethis = h('button', {
                                        className: 'fas fa-trash p-5  text-white p-3 text-center inline-flex items-center justify-center w-11  shadow-lg rounded-full bg-gray-400 ',
                                        disabled: true
                                    }, '');
                                }
                            @endif

                            return [show, edit, deletethis];
                        }
                    },
                @endif
            ],
            search: true,
            pagination: true,
            sort: true,
            data: json_data,
            language: {
                search: {
                    placeholder: "{{ __('🔍 Buscar...') }}"
                },
                sort: {
                    sortAsc: "{{ __('Ordenar la columna en orden ascendente') }}",
                    sortDesc: "{{ __('Ordenar columna en orden descendente') }}"
                },
                pagination: {
                    previous: "{{ __('Previo') }}",
                    next: "{{ __('Siguiente') }}",
                    navigate: function(e, r) {
                        return "{{ __('Pagina ') }}" + e + "{{ __(' de ') }}" + r
                    },
                    page: function(e) {
                        return "{{ __('Pagina ') }}" + e
                    },
                    showing: "{{ __('Mostrando ') }}",
                    of: "{{ __('de un total de') }}",
                    to: "-",
                    results: "{{ __('registros') }}"
                },
                loading: "{{ __('Cargando...') }}",
                noRecordsFound: "{{ __('No se han encontrado resultados') }}",
                error: "{{ __('Ocurrió un error al obtener los datos') }}"
            },
            style: {
                th: {
                    'background-color': 'rgba(0, 0, 0, 0.1)',
                    color: 'rgba(100,116,139,var(--tw-text-opacity))',
                    '--tw-border-opacity': '1',
                    'border-color': 'rgba(241,245,249,var(--tw-border-opacity))',
                    '--tw-bg-opacity': '1',
                    'background-color': 'rgba(248,250,252,var(--tw-bg-opacity))',
                    'font-size': '.75rem',
                    'line-height': '1rem',
                    'font-weight': '600',
                    'text-transform': 'uppercase',
                },
                td: {
                    'padding': '1px 4px',
                    'border': '0px',
                    'font-size': '.75rem',
                    'line-height': '1rem',
                },
            },
            className: {
                table: 'w-full'
            }

        });
        /* Controlador del modal  */
        function modalHandler(val, nameModal) {
            /*
            val = Determina si se abrira o cerrar el modal.
            nameModal = Nombre del modal a interactuar.
            */
            let modal = document.getElementById(nameModal);

            if (val) {
                //Abrir el modal
                fadeIn(modal);
            } else {
                //Ocultar el modal
                fadeOut(modal);
            }
        }

        function fadeOut(el) {
            el.style.opacity = 1;
            (function fade() {
                if ((el.style.opacity -= 0.1) < 0) {
                    el.style.display = "none";
                } else {
                    requestAnimationFrame(fade);
                }
            })();
        }

        function fadeIn(el, display) {
            el.style.opacity = 0;
            el.style.display = display || "flex";
            (function fade() {
                let val = parseFloat(el.style.opacity);
                if (!((val += 0.2) > 1)) {
                    el.style.opacity = val;
                    requestAnimationFrame(fade);
                }
            })();
        }
    </script>
@endpush

<style>
    td.gridjs-td:last-child {
        text-align: center;
    }
</style>
