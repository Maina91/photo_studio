<?php

namespace App\Http\Controllers\Admin;

use Gate;
use App\Role;
use App\Town;
use App\User;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\MassDestroyUserRequest;
use Symfony\Component\HttpFoundation\Response;

class UserProfileController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        // dd($user);
        $towns = Country::all();
        $counties  = Country::all();
        $countries  = Country::all();
        // dd($towns);
        return view('admin.profile.index', compact('user', 'counties', 'countries', 'towns',));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle Profile Photo Upload
        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::delete('public/profile_photos/' . $user->profile_photo);
            }

            // Store new photo
            $filename = time() . '.' . $request->profile_photo->extension();
            $request->profile_photo->storeAs('public/profile_photos', $filename);
            $validatedData['profile_photo'] = $filename;
        }

        $user->update($validatedData);

        flash()->success('Profile updated successfully.');
        return redirect()->back();
        // return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
    }
}


// <?php

// namespace App\Http\Controllers;

// use App\Country;
// use App\County;
// use App\Employee;
// use App\Company;
// use App\Town;
// use Illuminate\Http\Request;
// use Carbon\Carbon;

/**
 * @OA\Schema()
 */
// class UserProfileController extends Controller
// {
/**
 * |This controller is used to create
 * |
 * |
 * |
 */
/**
 * UserProfileController constructor.
 */
//     public function __construct()
//     {
//         $this->middleware('auth');
//     }
// }


//     public function index()
//     {
//         $user = auth()->user();
//         $employee = Employee::join('users', 'employees.pf_no', '=', 'users.ref_no')
//             ->join('roles', 'users.role_id', 'roles.id')
//             ->where('pf_no', $user->ref_no)
//             ->select(['employees.*', 'roles.display_name', 'users.username', 'users.password', 'users.login_days'])
//             ->first();

//         $log_in_days = explode(",", $employee->login_days);

//         $company = Company::first();

//         $countries = Country::orderBy('name')->get(['id', 'name']);
//         $towns = Town::all();
//         $counties = County::all();
//         return view('profile.profile', compact('countries', 'employee', 'towns', 'counties', 'company', 'log_in_days'));
//     }

//     public function profileUpdate(Request $request)
//     {

//         $this->validate($request, [
//             'first_name' => 'required',
//             'surname' => 'required',
//             'postal_address' => 'required',
//             'physical_address' => 'required',
//             'city' => 'required',
//             'county' => 'required',
//             'zip' => 'required',
//             'country' => 'required',
//             'phone' => 'required',
//             'avatar' => 'image|nullable|max:1999'
//         ]);

//         if ($request->hasFile('avatar')) {
//             // Get filename with extension
//             $filename = $request->avatar->getClientOriginalName();
//             // Upload Image
//             $request->avatar->storeAs('public/avatar', $filename);

//             $request->avatar->storeAs('public/avatar', 'profile.jpg');
//         } else {
//             $filename = $request->altlogo;
//         }


//         $user = auth()->user();
//         $update = Employee::where('id', $request->id)->first();

//         $update->first_name = $request->first_name;

//         $update->surname = $request->surname;
//         $update->post_address = $request->postal_address;
//         $update->physical_address = $request->physical_address;
//         $update->town = $request->city;
//         $update->county = $request->county;
//         $update->country = $request->country;
//         $update->zip =  $request->zip;
//         $update->phone_no = $request->phone;
//         $update->updated_at = Carbon::parse(Carbon::now())->format('Y-m-d H:m:s');
//         $update->passport_photo = $filename;

//         if ($update->save()) {
//             flash('Your details have been updated successfully');
//             return redirect('profile/settings');
//         } else {
//             flash('An error occurred while updating your information, please contact administrator');
//             return redirect()->back()->withInput();
//         }
//     }
// }
