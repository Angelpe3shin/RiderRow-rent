<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

use App\Models\User;
use App\Models\Address;
use App\Models\Country;
use App\Http\Resources\UserResource;

class UsersController extends Controller {
    /**
     * Create a new user with address and country.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request) {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:6',
            'street' => 'required|string|max:255',
            'house_number' => 'required|string|max:10',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
            'country_name' => 'required|string|max:255',
            'country_code' => 'required|string|max:3',
        ];
        $messages = [
            'email.unique' => 'Этот адрес электронной почты уже зарегистрирован.',
            'phone.unique' => 'Этот номер телефона уже зарегистрирован.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('/createUser')
                ->withErrors($validator)
                ->withInput();
        }

        // Создаем или находим страну
        $country = Country::firstOrCreate(
            ['name' => $request->input('country_name')],
            ['country_code' => $request->input('country_code')]
        );

        // Создаем или находим адрес
        $address = Address::firstOrCreate([
            'country_id' => $country->id,
            'street' => $request->input('street'),
            'house_number' => $request->input('house_number'),
            'zip_code' => $request->input('zip_code'),
            'city' => $request->input('city'),
        ]);

        // Создаем пользователя
        $user = User::create([
            'address_id' => $address->id,
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),
        ]);

        try {
            // ваш существующий код
            return response()->json(['user' => new UserResource($user)], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showCreateUserForm() {
        return view('create-user');
    }
}
