<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;
use App\Models\SportModel;

class SportController extends BaseController
{
	protected SportModel $sportModel;

	public function __construct()
	{
		$this->sportModel = new SportModel();
	}

	// GET /backoffice/sports
	public function sportList()
	{
		$sports = $this->sportModel->findAll();

		return view('Sport/list', [
			'sports' => $sports,
		]);
	}
}
