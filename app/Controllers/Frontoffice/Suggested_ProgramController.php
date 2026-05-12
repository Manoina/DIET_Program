<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;
use App\Models\RegimeModel;
use App\Models\SportModel;

class Suggested_ProgramController extends BaseController
{
	protected RegimeModel $regimeModel;
	protected SportModel $sportModel;

	public function __construct()
	{
		$this->regimeModel = new RegimeModel();
		$this->sportModel = new SportModel();
	}

	// GET/POST /frontoffice/suggestions/regimes
	public function getAllRegimeBy_varPoids_jour()
	{
		$payload = $this->readSuggestionPayload();
		if (isset($payload['error'])) {
			return $this->response->setStatusCode(400)->setJSON($payload);
		}

		$requiredVar = $payload['required_var'];
		$regimes = $this->regimeModel->findAll();
		$suggestions = [];

		foreach ($regimes as $regime) {
			$var = (float) $regime['var_poids_jour'];
			if (!$this->matchesRequiredVar($var, $requiredVar)) {
				continue;
			}

			$suggestions[] = [
				'regime' => $regime,
				'required_var' => $requiredVar,
				'duree_estimee_jour' => $this->estimateDays($payload['poids'], $var),
			];
		}

		return $this->response->setJSON([
			'required_var' => $requiredVar,
			'regimes' => $suggestions,
		]);
	}

	// GET/POST /frontoffice/suggestions/sports
	public function getAllSportBy_varPoids_jour()
	{
		$payload = $this->readSuggestionPayload();
		if (isset($payload['error'])) {
			return $this->response->setStatusCode(400)->setJSON($payload);
		}

		$requiredVar = $payload['required_var'];
		$regimes = $this->regimeModel->findAll();
		$sports = $this->sportModel->findAll();
		$suggestions = [];

		foreach ($regimes as $regime) {
			$regimeVar = (float) $regime['var_poids_jour'];

			foreach ($sports as $sport) {
				$sportVar = (float) $sport['var_poids_jour'];
				$totalVar = $regimeVar + $sportVar;

				if (!$this->matchesRequiredVar($totalVar, $requiredVar)) {
					continue;
				}

				$suggestions[] = [
					'regime' => $regime,
					'sport' => $sport,
					'total_var' => $totalVar,
					'required_var' => $requiredVar,
					'duree_estimee_jour' => $this->estimateDays($payload['poids'], $totalVar),
				];
			}
		}

		return $this->response->setJSON([
			'required_var' => $requiredVar,
			'programmes' => $suggestions,
		]);
	}

	private function readSuggestionPayload(): array
	{
		$objectif = (string) $this->request->getPostGet('objectif');
		$poids = (float) $this->request->getPostGet('poids');
		$dureeSemaine = (int) $this->request->getPostGet('duree_semaine');

		if ($poids <= 0 || $dureeSemaine <= 0) {
			return [
				'error' => 'Parametres invalides.',
			];
		}

		$requiredVar = $this->computeRequiredVar($objectif, $poids, $dureeSemaine);

		return [
			'objectif' => $objectif,
			'poids' => $poids,
			'duree_semaine' => $dureeSemaine,
			'required_var' => $requiredVar,
		];
	}

	private function computeRequiredVar(string $objectif, float $poids, int $dureeSemaine): float
	{
		$poids = abs($poids);
		$days = max(1, $dureeSemaine * 7);
		$var = $poids / $days;

		if ($objectif === 'augmenter') {
			return $var;
		}

		return -$var;
	}

	private function matchesRequiredVar(float $candidate, float $required): bool
	{
		if ($required < 0) {
			return $candidate < 0 && abs($candidate) >= abs($required);
		}

		return $candidate > 0 && abs($candidate) >= abs($required);
	}

	private function estimateDays(float $poids, float $varPoidsJour): int
	{
		$varPoidsJour = abs($varPoidsJour);
		if ($varPoidsJour <= 0) {
			return 0;
		}

		return (int) ceil(abs($poids) / $varPoidsJour);
	}
}
