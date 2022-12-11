<?php

namespace App;

use App\Models\Inspector;


class ListHelper
{

    static function getInspectores()
    {
        return Inspector::orderby('nombre_completo')->pluck('nombre_completo', 'id');
    }
}
