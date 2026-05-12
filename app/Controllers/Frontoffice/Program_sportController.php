<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;
use App\Models\ProgramSportModel;

class Program_sportController extends BaseController
{
	protected ProgramSportModel $programSportModel;

	public function __construct()
	{
		$this->programSportModel = new ProgramSportModel();
	}

	// GET /frontoffice/programmes/(:num)/sports
	public function getSportsByProgramId(int $programId)
	{
		$sports = $this->programSportModel->getSportsByProgramId($programId);

		return $this->response->setJSON($sports);
	}
}
