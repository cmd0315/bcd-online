<?php

class HomeController extends BaseController {

	public function getIndex()
	{
		return View::make('home', ['pageTitle' => 'Home']);
	}

	public function getDashboard() {
		return View::make('account.dashboard', ['pageTitle' => 'Dashboard']);
	}

}
