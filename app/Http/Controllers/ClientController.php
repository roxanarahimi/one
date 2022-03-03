<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientAddressResource;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use App\Models\ClientAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    public function index()
    {
        try {
            $data = Client::all()->sortByDesc('id');
            return response(ClientResource::collection($data), 200);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), (integer)$exception->getCode());
        }
    }

    public function latest()
    {
        try {
            $data = Client::all()->sortByDesc('id')->take(3);
            return response(ClientResource::collection($data), 200);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), (integer)$exception->getCode());

        }
    }

    public function show(Client $client)
    {
        try {
            return response(new ClientResource($client), 200);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all('email', 'mobile', 'password'),
            [
                'email' => 'nullable|unique:clients,email',
                'mobile' => 'nullable|unique:clients,mobile',
                'password' => 'required',
            ],
            [
                'email.unique' => 'این ایمیل قبلا ثبت شده است',
                'mobile.unique' => 'این شماره موبایل قبلا ثبت شده است',
                'password.required' => 'لطفا کلمه عبور را وارد کنید',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        try {
            $data = Client::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password'])
            ]);
            $data->update($request->except('name', 'email', 'password'));
            return response(new ClientResource($data), 201);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

    public function update(Request $request,Client $client)
    {
        $validator = Validator::make($request->all('email', 'mobile', 'password', 'new_password'),
            [
                'email' => 'nullable|unique:clients,email,' . $client['id'],
                'mobile' => 'nullable|unique:clients,mobile,' . $client['id'],
                'new_password' => 'nullable|min:3',

            ],
            [
                'email.unique' => 'این ایمیل قبلا ثبت شده است',
                'mobile.unique' => 'این شماره موبایل قبلا ثبت شده است',
                'new_password.min' => 'لطفا حد اقل 3 کاراکتر وارد کنید',

            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        try {
            if ($request['current_password'] != '' && $request['new_password'] != '' && $request['new_password_repeat'] != '') {
                if (Hash::check($request['current_password'], $client['password'])) {
                    if (strlen($request['new_password']) < 3) {
                        return response()->json(['new_password' => ['لطفا حد اقل 3 کاراکتر وارد کنید']], 422);

                    } else if ($request['new_password'] == $request['new_password_repeat']) {

                        if (!Hash::check($request['new_password'], $client['password'])) {
                            $client->update(['password' => Hash::make($request['new_password'])]);
                        }

                    } else {
                        return response()->json(['new_password_repeat' => ['کلمه عبور جدید با تکرار آن برابر نیست']], 422);
                    }

                } else {
                    return response()->json(['current_password' => ['کلمه عبور فعلی درست نیست']], 422);
                }

            }
            $client->update($request->except('password'));
            return response(new ClientResource($client), 200);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

    public function destroy(Request $request)
    {
        $data = Client::findOrFail($request['id']);
        try {
            $data->delete();
            return response('client deleted', 200);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

    public function activeToggle(Client $client)
    {

        try {
            $client->update(['active' => !$client['active']]);
            return response(new ClientResource($client), 200);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

//    public function updateAddress(Request $request, ClientAddress $clientAddress)
//    public function storeAddress(Request $request)
//    {
//        try {
//
//            $address = ClientAddress::create($request->all());
//            return response(new ClientAddressResource($address),201);
//        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
//        }
//    }
}
