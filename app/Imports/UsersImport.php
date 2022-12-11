<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new User([
            "name" => $row['nombre'],
            "lastname" => $row['apellido'],
            "email" => $row['correo'],
            "cedula" => $row['matricula'],
            "rol_id" => "1", // User Type User,
            'created_by' => Auth::user()->name,
            'updated_by' => Auth::user()->name,
            "password" => bcrypt('password')
        ]);
    }
}
