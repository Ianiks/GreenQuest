<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'id_number'    => $row['id_number'], // column name in Excel
            'firstname'    => $row['firstname'],
            'lastname'     => $row['lastname'],
            'email'        => $row['email'],
            'password'     => $row['lastname'],
            'instructor_id'=> auth()->guard('instructor')->id(),
            'is_active'    => 1,
        ]);
    }
}
