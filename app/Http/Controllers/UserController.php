<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show(String $id)
    {
        return User::findOrFail($id);
    }
    public function index()
    {
        $users = User::where("users.id","!=","1")
            ->join('departments', 'users.department_id', '=', 'departments.id')
            ->join('users_status', 'users.status_id', '=', 'users_status.id')
            ->select('users.*',
                'departments.name as departments',
                'users_status.name as status')
            ->get(); // neu du lieu it thi dung nhu nay
        // con du lieu nhieu thi dung ->paginate() : co phan trang vaf khong dung ant designt vue nuwa ma
        // thiet ke component tren server side vowis pinia

        return response()->json($users);
        //   return User::get();
    }

    public function create()
    {
        // $users_status = DB::table("users_status")->get();
        $users_status = DB::table("users_status")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();
        $departments = DB::table("departments")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();
        return response()->json([
            "users_status" => $users_status,
            "departments" => $departments,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'status_id' => 'required',
            'username' => 'required|unique:users,username',
            'name' => 'required|max:255',
            'email' => 'required|email',
            'department_id' => 'required',
            'password' => 'required|confirmed',
        ],
            [
                //bao loi khi khong nhap
                'status_id.required' => 'Nhap tinh trang',
                'username.required' => 'nhap username',
                'username.unique' => 'Trung username',

                'name.required' => 'nhap name',
                'name.max' => 'ki tu toi da la 255',

                'email.required' => 'nhap email',
                'email.email' => 'mail k hop le',

                'department_id.required' => 'nhap department_id',
                'password.required' => 'nhap pass',
                'password.confirmed' => 'mat khau va xac nhan mat khau k khop',
            ]);
        //eloquent ORM insert dung khi tai su dung duoc(tuong tac den lop model)->co the tu dong them ngay gio
        // User::create([
        //     'status_id' => $request["status_id"],
        //     'username' => $request["username"],
        //     'name' => $request["name"],
        //     'email' => $request["email"],
        //     'department_id' => $request["department_id"],
        //     'password' => $request["password"],
        // ]);
        //k nen lam dung
        $user = $request->except(["password", "password_confirmation"]); //khi tra ve thi loai bo password
        $user["password"] = Hash::make($request["password"]); //ma hoa password
        User::create($user); //tao
        //Query builder insert tuong tac den database luon, du dung cho chu the k can tao model->k them dc ngay gio tu dong
        // DB::table('users')->insert([
        //     'email' => 'kayla@example.com',
        //     'votes' => 0
        // ]);
    }

    public function edit($id)
    {
        $users = User::find($id);

        $users_status = DB::table("users_status")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();
        $departments = DB::table("departments")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();
        return response()->json([
            "users" => $users,
            "users_status" => $users_status,
            "departments" => $departments,
        ]);

    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status_id' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'name' => 'required|max:255',
            'email' => 'required|email',
            'department_id' => 'required',
        ],
            [
                //bao loi khi khong nhap
                'status_id.required' => 'Nhap tinh trang',
                'username.required' => 'nhap username',
                'username.unique' => 'Trung username',

                'name.required' => 'nhap name',
                'name.max' => 'ki tu toi da la 255',

                'email.required' => 'nhap email',
                'email.email' => 'mail k hop le',

                'department_id.required' => 'nhap department_id',

            ]);

        User::find($id)->update([
            'status_id' => $request["status_id"],
            'username' => $request["username"],
            'name' => $request["name"],
            'email' => $request["email"],
            'department_id' => $request["department_id"],
        ]);

        if ($request["change_password"] == true) {
            $validated = $request->validate([
                'password' => 'required|confirmed',
            ],
                [
                    //bao loi khi khong nhap
                    'password.required' => 'nhap pass',
                    'password.confirmed' => 'mat khau va xac nhan mat khau k khop',

                ]);

            User::find($id)->update([
                'password' => Hash::make($request["password"]),
                "change_password_at" => NOW(),

            ]);
        }
    }
//   username: Phải được cung cấp và phải
//  là duy nhất trong bảng users,
//   ngoại trừ người dùng với $id hiện tại (unique:users,username,'.$id).
    public function destroy($id)
    {
        User::find($id)->delete();
    }

}