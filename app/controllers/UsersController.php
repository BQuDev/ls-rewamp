<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /user
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return View::make('users.index')
		    ->with('users',User::all());


	}

	/**
	 * Show the form for creating a new resource.
	 * GET /user/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
        return View::make('users.create')
            ->with('groups',DB::table('groups')->lists('name','id'))
            ->with('companies',DB::table('users_companies')->lists('name','id'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /user
	 *
	 * @return Response
	 */
	public function store()
	{
		//
        try
        {
            // Create the user
            $user = Sentry::createUser(array(
                'email'     => Input::get('username'),
                'password'  => Input::get('password'),
                'first_name'  => Input::get('first_name'),
                'last_name'  => Input::get('last_name'),
                'activated' => true,
            ));

            // Find the group using the group id
            $adminGroup = Sentry::findGroupById(1);

            // Assign the group to the user
            $user->addGroup($adminGroup);

            return View::make('users.create')->with('groups',DB::table('groups')->lists('name','id'))
            ->with('companies',DB::table('users_companies')->lists('name','id'));
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            echo 'Password field is required.';
        }
        catch (Cartalyst\Sentry\Users\UserExistsException $e)
        {
            echo 'User with this login already exists.';
        }
        catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
        {
            echo 'Group was not found.';
        }

	}

    public function add_user_groups(){

        try {
            // Create the group
            $permissionArray =[];
            $group = Sentry::createGroup(array(
                'name' => Input::get('group_name'),
                'permissions' => $permissionArray,
            ));
            Notify::success(Input::get('group_name'). ' added  successfully');
            return Redirect::to('settings/user-management/user-groups')->withErrors('Group already exists');
        } catch (Cartalyst\Sentry\Groups\NameRequiredException $e) {
            echo 'Name field is required';
        } catch (Cartalyst\Sentry\Groups\GroupExistsException $e) {
            //echo 'Group already exists';
            Notify::error('Group '.Input::get('group_name'). ' already exists');
            return Redirect::to('settings/user-management/user-groups');

        }
    }
	/**
	 * Display the specified resource.
	 * GET /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	public function update_permissions()
	{
		//return Input::all();
        //
        // create the validation rules ------------------------
        $rules = array(
            'group_name'               => 'required',                      // just a normal required validation
            'permissions'               => 'required'
        );

        $messages = array(
            'required' => 'The :attribute required.',
            'permissions.required' => 'permissions.required',
        );
        // do the validation ----------------------------------
        // validate against the inputs from our form
        $validator = Validator::make(Input::all(), $rules,$messages);

        // check if the validator failed -----------------------
        if ($validator->fails()) {

            // get the error messages from the validator
            $messages = $validator->messages();

            // redirect our user back to the form with the errors from the validator
            return Redirect::to('settings/user-management/user-groups')
                ->withErrors($validator)->withInput();

        } else {


            // validation successful ---------------------------

            $permissionArray =array();

            // Creating permission array
            foreach(Input::get('permissions') as $permission){
                $permissionArray[$permission]=1;
            }

            $is_group_exists = DB::table('groups')->where('name','=',urldecode(Input::get('group_name')))->get();
            if($is_group_exists){
                $sucsess =  DB::table('groups')
                    ->where('name','=',urldecode(Input::get('group_name')))
                    ->update(array('permissions' => json_encode($permissionArray)));
               if($sucsess == 1){
                   Notify::success('Permissions Successfully Updated');
                   return Redirect::to('settings/user-management/user-groups');
               }
			}else {

                try {
                    // Create the group
                    $group = Sentry::createGroup(array(
                        'name' => Input::get('group_name'),
                        'permissions' => $permissionArray,
                    ));
                } catch (Cartalyst\Sentry\Groups\NameRequiredException $e) {
                    echo 'Name field is required';
                } catch (Cartalyst\Sentry\Groups\GroupExistsException $e) {
                    //echo 'Group already exists';
                    Notify::error('Group already exists');
                    return Redirect::to('settings/user-management/user-groups')
                        ->withErrors('Group already exists');
                }
            }
            // redirect ----------------------------------------
            return Redirect::to('settings/user-management/user-groups');

        }
	}

	public function user_groups(){
        return View::make('users.index_user_group')
            ->with('groups',DB::table('groups')->select('*')->get());
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /user/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	public function edit_group($group_name)
	{
		//
		return View::make('users.edit_user_group')->with('permissions',DB::table('groups')->select('*')->where('name','=',$group_name)->get());
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /user/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
    public function login(){

        if(!Sentry::check()){
            return View::make('users.login');
        }

        return Redirect::intended('students');
    }

    public function authenticate(){

        try
        {
            // Login credentials
            $credentials = array(
                'email'    =>Input::get('email'),
                'password' => Input::get('password')
            );

            // Authenticate the user
            $user = Sentry::authenticate($credentials, false);
            // return View::make('containerTrackingDetails.index');
            return Redirect::intended('students');
            //return Redirect::route('/dashboards');
            // return Redirect::action('DashboardsController@index');
            // return View::make('containers.index');
        }
        catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
        {
            echo 'Login field is required.';
        }
        catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
        {
            echo 'Password field is required.';
        }
        catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
        {
            echo 'Wrong password, try again.';
        }
        catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
        {
            echo 'User was not found.';
        }
        catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
        {
            echo 'User is not activated.';
        }

// The following is only required if the throttling is enabled
        catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
        {
            echo 'User is suspended.';
        }
        catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
        {
            echo 'User is banned.';
        }
    }

    public function logout(){
        Sentry::logout();
        return View::make('users.login');
    }
}