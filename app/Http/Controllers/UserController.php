<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\UserType;
use App\Models\User;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Company;
use App\Models\CompanyToUser_rel;


class UserController extends Controller
{
	// public function __construct()
	// {
 //        $this->middleware(['auth', 'isAdmin']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
 //    }

	public function index()
	{
		$users = User::all();
		return view('users.index')->withUsers($users);
	}

	public function createUser()
	{
    //Get all roles and pass it to the view
        $roles = Role::get();
        $companies = Company::where('master_id', null)->get();
        return view('users.create', ['roles'=>$roles], ['companies'=>$companies]);
    }

    public function store(Request $request) {
    //Validate name, email and password fields
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|confirmed'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->language = $request->language;
        $user->save();
        $role = $request->role; //Retrieving the roles field
        $user->assignRole($role); //Assigning role to user

        $companies = $request['companies'];
        if(isset($companies))
        {
            foreach($companies as $company)
            {
                $companyToUser = new CompanyToUser_rel();

                $companyToUser->user_id = $user->id;
                $companyToUser->company_id = $company;
                $companyToUser->save();
            }
        }


        //Redirect to the users.index view and display message
        return redirect()->route('users.index');
    }

	public function editUser($id)
	{
		$user = User::find($id);
		$roles = Role::get();

		$userCompanies = CompanyToUser_rel::where('user_id', $id)->get();
		$companies=[];
		$comp_id=[];
		foreach($userCompanies as $company)
        {
            $comp = Company::find($company->company_id);
            array_push($companies, $comp);
            array_push($comp_id, $comp->id);
        }

        $allCompanies = Company::where('master_id', null)->get();

		return view('users.edit')->withUser($user)->withRoles($roles)->withCompanies($companies)->withAllCompanies($allCompanies)->withComp_id($comp_id);
	}

	public function updateUser(Request $request, $id)
	{

        $user = User::findOrFail($id);

        $role = $request->input('role'); //Retreive all roles
        $user->roles()->detach();
        $user->assignRole($role);

        $userCompanies = CompanyToUser_rel::where('user_id', $id);
        foreach ($userCompanies as $userCompany)
            $userCompany->delete();

        $companies = $request->input('companies');
        foreach ($companies as $company)
        {
            $user_company_rel = new CompanyToUser_rel();
            $user_company_rel->user_id = $id;
            $user_company_rel->company_id = $company;
            $user_company_rel->save();
        }


        return redirect()->route('users.index');
	}

    public function profile()
    {
        return view('users.profile');
    }

    public function changeCompany($id,$name)
    {
        \Session::put('primary_company',Company::find($id));

        return redirect()->back();
    }

    public function updateProfile(Request $request, $id)
    {

        $user = User::find($id);
        $this->validate($request, [
            'email'=>'required|email'
        ]);

        $user->email = $request->input('email');
        \Session::put('user_email',$request->input('email'));
        $user->language = $request->input('language');
        \Session::put('user_language',$request->input('language'));
        $user->primary_company = $request->input('primary_company');

        $user->save();

        return redirect()->route('profile');
    }

    public function selectPrimary(Request $request, $id)
    {
        $user_id = \Session::get('user_id');

        $user = User::find($user_id);
        $user->primary_company = $id;
        $user->save();
        $primaryCompany = Company::find($id);
        $request->session()->put('primary_company', $primaryCompany);

        return redirect()->route('dashboard');
    }
}
