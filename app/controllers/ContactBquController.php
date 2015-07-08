<?php

class ContactBquController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /user
	 *
	 * @return Response
	 */
	public function index()
	{

        return View::make('static.contact_bqu')->with('comments',ContactBqu::where('created_by','=',Sentry::getUser()->id)->orWhere('created_to', '=', Sentry::getUser()->id)->get());

    }

	/**
	 * Show the form for creating a new resource.
	 * GET /user/create
	 *
	 * @return Response
	 */
	public function create()
	{

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
        $comment = Input::get('comment');

        $contactBqu = new ContactBqu();
        $contactBqu->message = $comment;
        $contactBqu->created_by = Sentry::getUser()->id;
        $contactBqu->created_to = 1;
        $contactBqu->save();
        return View::make('static.contact_bqu')->with('comments',ContactBqu::where('created_by','=',Sentry::getUser()->id)->orWhere('created_to', '=', Sentry::getUser()->id)->get());
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


}