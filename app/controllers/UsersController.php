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