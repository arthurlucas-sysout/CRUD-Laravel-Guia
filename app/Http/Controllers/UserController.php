<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(Request $request) {
        $query = User::search($request);

        $n = $request->get('limit', 10);

        $list = $query->paginate($n);

        $data = [
            'list' => $list
        ];

        return view('pages.user.index', $data);
    }

    public function create(Request $request) {
        $user = new User();

        return $this->form($user);
    }

    public function insert(Request $request) {

        return $this->store($request);
    }

    public function edit(Request $request, int $id) {
        $user = User::find($id);

        if ($user) {
            return $this->form($user);

        } else {
            return back()->withErrors('Usuário não encontrado!');
        }
    }

    public function update(Request $request) {

        return $this->store($request);
    }

    public function delete(Request $request) {

        $id = $request->id;

        if ($id) {

            $user = User::find($id);

            if ($user) {

                $user->delete();

                return back()->withSuccess('O usuário foi removido com sucesso!');
            }

        } else {

        }

    }

    private function form(User $user) {

        $data = [
            'user' => $user
        ];

        return view('pages.user.form', $data);
    }

    private function save (User $user, Request $request) {
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password)
        $user->password = bcrypt($request->password);

        $user->save();
    }

    private function store (Request $request) {
        $validator = $this->validation($request);

        if ($validator->fails()) {

            $errors = $validator->errors()->all();

            return back()->withInput()->withErrors($errors);
        }

        $user = $request->id ? User::find($request->id) : new User();

        $this->save($user, $request);

        Session::flash('sucess', 'O usuário foi salvo com sucesso!');

        return redirect('/usuarios');
    }

    private function validation(Request $request) {

        $uniqueEmailRule = Rule::unique('users', 'email');

        if ($request->id)
            $uniqueEmailRule ->ignore($request->id);

        $rules = [
            'name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'max:50', $uniqueEmailRule],
            'password' => ['string', 'min:8', 'max:16']
        ];

        $method = $request->method();

        if ($method == 'PUT') {

            array_unshift($rules['password'], 'nullable');

            $rules['id'] = ['required', 'integer', 'exists:users.id'];

        } else {
            array_unshift($rules['password'], 'required');
        }

        $data = $request->all();

        $validator = Validator::make($data, $rules);

        return $validator;
    }
}
