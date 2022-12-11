<div class="relative w-full mb-3 px-3">
    <label class="block uppercase text-slate-600 text-xs font-bold mb-2" htmlFor="{{ $name }}">
        {{ __("$title") }}
    </label>
<select id="{{$id}}" name="{{$name}}"
    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light focus:bg-white select2"
    required style="width: 100%;">
    <option selected value="">Seleccione una opcion...</option>
</select>
</div>

@push('js')
<script>
    $(document).ready(function() {

        $.ajax({
            url: "{{ $select }}",
            type: "GET",
            dataType: "json",
            data: {
                "_token": $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(data) {
                      console.log(data)

                data.forEach(element =>
                $('#{{$name}}').append('<option value="' + element.id + '">' + element
                        .nombre +
                        '</option>')
                );


                $("#{{$name}}").val("{{$value}}").change();
            },
            error: function(data) {
                jsoninspector = data.inspector;
            }
        });


    });
</script>
@endpush
