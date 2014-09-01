<?php

class HomeController extends BaseController {
	/**
	 * Display the home page
	 *
	 * @return home page view
	 */
	public function getIndex() {
		return View::make('home', ['pageTitle' => 'Home']);
	}

	/**
	 * Display the dashboard page
	 *
	 * @return dashboard page view (first page when logged in)
	 */
	public function getDashboardPage() {
		return View::make('account.dashboard', ['pageTitle' => 'Dashboard']);
	}

	/**
	 * Display the system admin system records page
	 *
	 * @return system records page view
	 */
	public function getSystemRecordsPage() {
		return View::make('admin.system-records', ['pageTitle' => 'System Records']);
	}

}
