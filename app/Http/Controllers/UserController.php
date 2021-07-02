<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\user;
use App\Models\verification;
use App\Models\bank;
use App\Models\gender;
use App\Models\city;
use App\Models\state;
use App\Models\country;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $users = DB::table('users as u')
                    ->join('genders as g','u.gender','=','g.id')
                    ->select('u.*','g.name as gendername')
                    ->orderBy('u.kyc_verify', 'asc')->get();


        

        return view('users.index')
               ->with('users', $users);
    }

    public function assignIndex(Request $request)
    {
        $this->userRepository->pushCriteria(new RequestCriteria($request));
        $users = $this->userRepository->all();

        return view('users.assign.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $roles = DB::table('roles')->orderBy('id', 'asc')->get();

        return view('users.create')
             ->with('roles',$roles);             
    }

    public function Assigncreate()
    {
        return view('users.assign.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = user::findorfail($id);
        $state = state::where('id',$user->state)->get();
        $city = city::where('id',$user->city)->get();
        $country = country::where('id',$user->country)->get();
        $gender = gender::get();
        $national_id = verification::where('user_id',$user->id)->where('type',1)->first();
        $driver_license = verification::where('user_id',$user->id)->where('type',3)->first();
        $passport = verification::where('user_id',$user->id)->where('type',2)->first();
        $bank = bank::where('id',$user->bank_id)->get();


       if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.edit')
        ->with('state',$state)
        ->with('city',$city)
        ->with('country',$country)
        ->with('gender',$gender)
        ->with('national_id',$national_id)
        ->with('driver_license',$driver_license)
        ->with('bank',$bank)
        ->with('passport',$passport)
        ->with('user', $user);
    }

    public function updateRole($id, UpdateUserRequest $request)
    {
        
    }



    public function assign()
    {
       
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        $user = user::findorfail($id);
        
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $date = date("Y-m-d H:i:s");
        
        $user->kyc_verify = 1;
        $user->updated_at = $date;
        $user->save();

        

        Flash::success('Users KYC verified successfully.');
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = user::findorfail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $status = 0;
        if($user->status == 1)
        {
            $status = 0;
        }
        else
        {
            $status = 1;
        }

        $user->status = $status;
        $user->save();

        Flash::success('User has been blocked or unblocked successfully.');

        return redirect(route('users.index'));
    }
}
