<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class UserImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new User([

            //

            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'password' => Hash::make($row['password']),
            'role'     => $row['role'],
            'dob' => $row['dob'],
            'address' => $row['address'],
            'phone_number' => $row['phone_number'],
            'gender' => $row['gender'],


        ]);
    }
    public function rules(): array
    {
        return [
            'first_name' => 'min:3',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'phone_number' => 'unique:users,phone_number|min:7|max:15',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,others',
            'address' => 'required|string|max:255',
            'role' => 'in:admin,user',
        ];
    }
}
