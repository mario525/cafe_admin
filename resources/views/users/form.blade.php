{{-- START form inputs --}}
<div class="flex flex-wrap mt-6">
    <div class="w-full px-4">
        {{-- START input name --}}
        <x-input.text id='nombre' name='nombre' title='Nombres' :value='$create ? null : $item->name' :required=true :create='$create'
            :show='$show' :edit='$edit'>
        </x-input.text>
        {{-- END input name --}}
        {{-- START input price --}}
        <x-input.text id='apellidos' name='apellidos' title='Apellidos' :value='$create ? null : $item->lastname' :required=true :create='$create'
            :show='$show' :edit='$edit'>
        </x-input.text>
        {{-- END input title --}}
        {{-- START input telefono --}}
        <x-input.text id='telefono' name='telefono' title='Telefono' :value='$create ? null : $item->phone' :required=true :create='$create'
            :show='$show' :edit='$edit'>
        </x-input.text>
        {{-- END input telefono --}}
        {{-- START input telefono --}}
        <x-input.text id='matricula' name='matricula' title='Matricula' :value='$create ? null : $item->cedula' :required=true
            :create='$create' :show='$show' :edit='$edit'>
        </x-input.text>
        {{-- END input telefono --}}
        {{-- START input telefono --}}
        <x-input.text id='correo' name='correo' title='Correo' :value='$create ? null : $item->email' :required=true :create='$create'
            :show='$show' :edit='$edit'>
        </x-input.text>
        {{-- END input telefono --}}


    </div>
    {{-- start rol --}}
    <x-input.select id="rol" name="rol" title="Rol" select="{{ route('roles.getdata') }}"
        :value='$create ? null : $item->rol_id' :create='$create' :show='$show' :edit='$edit'>
    </x-input.select>
    {{-- END rol --}}
    <div class="w-full lg:w-12/12 px-4 mb-4">
        {{-- START input thumbnail --}}
        <x-input.image id='thumbnail' name='thumbnail' title='Thumbnail' :value='$create ? null : $item->profile_photo_path' :required=true
            :create='$create' :show='$show' :edit='$edit'>
        </x-input.image>
        {{-- END input thumbnail --}}
    </div>



    <div class="w-full px-4">
        {{-- START input validity --}}
        <x-input.checkbox id='estatus' name='estatus' title='Activo' :value='$create ? true : $item->estatus' :required=true
            :create='$create' :show='$show' :edit='$edit'>
        </x-input.checkbox>
        {{-- END input validity --}}
    </div>
</div>
{{-- END form inputs --}}

{{-- START show updated and created info --}}
@if ($show)
    <div class="flex flex-wrap mt-6">
        <div class="w-full md:w-1/2 px-4">
            {{-- START input created by --}}
            <div class="relative w-full mb-3">
                <x-input.text title='Created by' :value='$create ? null : $item->created_by' :readonly=true :create='$create' :show='$show'
                    :edit='$edit'>
                </x-input.text>
            </div>
            {{-- END input created by --}}

            {{-- START input updated by --}}
            <div class="relative w-full mb-3">
                <x-input.text title='Updated by' :value='$create ? null : $item->updated_by' :readonly=true :create='$create' :show='$show'
                    :edit='$edit'>
                </x-input.text>
            </div>
            {{-- END input updated by --}}
        </div>

        <div class="w-full md:w-1/2 px-4">
            {{-- START input created at --}}
            <div class="relative w-full mb-3">
                <x-input.text title='Created at' :value='$create ? null : $item->created_at' :readonly=true :create='$create' :show='$show'
                    :edit='$edit'>
                </x-input.text>
            </div>
            {{-- END input created at --}}

            {{-- START input updated at --}}
            <div class="relative w-full mb-3">
                <x-input.text title='Updated at' :value='$create ? null : $item->updated_at' :readonly=true :create='$create' :show='$show'
                    :edit='$edit'>
                </x-input.text>
            </div>
            {{-- END input updated at --}}
        </div>
    </div>
@endif
{{-- END show updated and created info --}}

{{-- START buttons return, submit, edit --}}
<div class="flex flex-wrap mt-6">
    <div class="w-full md:w-1/2 px-4">
        {{-- START button return --}}
        <x-button-link title="{{ __('Regresar') }}" color="blue-500" id="button_return" name="button_return"
            href="/usuarios-detalles">
        </x-button-link>
        {{-- END button return --}}
    </div>

    @if (!$show)
        <div class="w-full md:w-1/2 px-4">
            {{-- START button submit --}}
            <x-button-submit title="{{ __('Guardar') }}" color="green" id="button_submit" name="button_submit">
            </x-button-submit>
            {{-- END button submit --}}
        </div>
    @else
        <div class="w-full md:w-1/2 px-4">
            {{-- START button edit --}}
            <x-button-link title="{{ __('Edit') }}" color="pink-500" id="button_edit" name="button_edit"
                href="{{ route('product.edit', $item) }}">
            </x-button-link>
            {{-- END button edit --}}
        </div>
    @endif
</div>
{{-- END buttons return, submit, edit --}}
