<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientAddressResource;
use App\Models\ClientAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClientAddressController extends Controller
{

    public function index()
    {
        $data = ClientAddressResource::collection(ClientAddress::all()->sortByDesc('id'));
        try {
            return response($data, 200);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), (integer)$exception->getCode());

        }

    }

    public function show(ClientAddress $clientAddress)
    {
        try {
            return response(new ClientAddressResource($clientAddress), 200);
        } catch (\Exception $exception) {
            return response($exception->getMessage(), (integer)$exception->getCode());
        }
    }

    public function store(Request $request)
    {

//        return $request;
//
        $validator = Validator::make($request->all(),
            [
                'title' => 'required',
                'state' => 'required',
                'city' => 'required',
                'postal_code' => 'required',
                'address' => 'required',
            ],
            [
                'title.required' => 'لطفا عنوان را وارد کنید',
                'state.required' => 'لطفا استان را وارد کنید',
                'city.required' => 'لطفا شهر را وارد کنید',
                'postal_code.required' => 'لطفا کد پستی را وارد کنید',
                'address.required' => 'لطفا آدرس را وارد کنید',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        try {
            $data = ClientAddress::create($request->all());
            return response(new ClientAddressResource($data), 201);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

    public function update(Request $request, ClientAddress $clientAddress)
    {

        $validator = Validator::make($request->all(),
            [
                'title' => 'required',//$clientAddress['id'];
                'state' => 'required',
                'city' => 'required',
                'postal_code' => 'required',
                'address' => 'required',
            ],
            [
                'title.required' => 'لطفا عنوان را وارد کنید',
                'state.required' => 'لطفا استان را وارد کنید',
                'city.required' => 'لطفا شهر را وارد کنید',
                'postal_code.required' => 'لطفا کد پستی را وارد کنید',
                'address.required' => 'لطفا آدرس را وارد کنید',
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        try {
            $clientAddress->update($request->all());
            return response(new ClientAddressResource($clientAddress), 200);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

    public function destroy(Request $request)
    {
        $data = ClientAddress::findOrFail($request['id']);
        try {
            $data->delete();
            return response('client deleted', 200);
        } catch (\Exception $exception) {
//            return response($exception->getMessage(), (integer)$exception->getCode());
            return response([$exception->getMessage(), (integer)$exception->getCode()], 500);
        }
    }

}
