<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;
use App\Models\RegimeModel;

class RegimeController extends BaseController
{
	protected RegimeModel $regimeModel;

	public function __construct()
	{
		$this->regimeModel = new RegimeModel();
	}

	// GET /backoffice/regimes
	public function regimeList()
	{
		$regimes = $this->regimeModel->findAll();

		return view('Regime/list', [
			'regimes' => $regimes,
		]);
	}
}
