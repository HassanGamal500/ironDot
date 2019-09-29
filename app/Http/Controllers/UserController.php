<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    // For Api

    public function login(Request $request)
    {

        $validator = validator()->make($request->all(),[

            'email' => 'required|email',
            'password' => 'required',

        ]);

        if ($validator->fails()) {

            $response = [

                'status' => 0,
                'message' => 'validator error',
                'data' => $validator->errors()

            ];

            return response()->json($response);

        }

        $user = User::Where('email', $request->email)->first();

        if ($user) {

            if (Hash::check($request->password, $user->password)) {

                $response = [

                    'status' => 1,
                    'message' => 'your account is correct',
                    'data' => [
                        'api_token' => $user->api_token,
                        'User' => $user
                    ]

                ];

                return response()->json($response);

            } else {

                $response = [

                    'status' => 0,
                    'message' => 'your password is not correct, Try Again',

                ];

                return response()->json($response);

            }

        } else {

            $response = [

                'status' => 0,
                'message' => 'your account is not correct',

            ];

            return response()->json($response);

        }

    }

    public function register(Request $request){

        $validator = validator()->make($request->all(),[

            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed'

        ]);

        if ($validator->fails()) {

            $response = [

                'status' => 0,
                'message' => 'validator error',
                'data' => $validator->errors()

            ];

            return response()->json($response);

        }

        $request->merge(['password' => bcrypt($request->password)]);

        $user = User::create($request->all());

        $user->api_token = Str::random(60);

        $user->save();

        $response = [

            'status' => 1,
            'message' => 'success',
            'data' => [
                'api_token' => $user->api_token,
                'User' => $user
            ]

        ];

        return response()->json($response);

    }

    //------------------------------------------
    // For Update User Or Admin

    public function edit($id){
        $model = User::findOrFail($id);
        return view('edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'email'
        ]);

        $user = User::findOrFail($id);

        if ($request->password) {
            $request->merge(['password' => bcrypt($request->password)]);
            $update = $user->update($request->all());
        } else {
            $update = $user->update(['name' => $request->name, 'email' => $request->email]);
        }

        return redirect(route('edit', $id));
    }

}
