<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;
use App\Models\ProgramModel;
use App\Models\ProgramSportModel;
use App\Models\RegimeModel;
use App\Models\SportModel;
use App\Models\UserModel;

class ProgramController extends BaseController
{
	protected ProgramModel $programModel;
	protected ProgramSportModel $programSportModel;
	protected RegimeModel $regimeModel;
	protected SportModel $sportModel;
	protected UserModel $userModel;

	public function __construct()
	{
		$this->programModel = new ProgramModel();
		$this->programSportModel = new ProgramSportModel();
		$this->regimeModel = new RegimeModel();
		$this->sportModel = new SportModel();
		$this->userModel = new UserModel();
	}

	// GET /frontoffice/programme
	public function programList()
	{
		$userId = (int) session()->get('user_id');
		$programme = $this->buildProgrammeForUser($userId);

		return view('Programme/index', [
			'programme' => $programme,
		]);
	}

	// GET|POST /frontoffice/programmes/new
	public function createProgram()
	{
		if ($this->request->getMethod() === 'get') {
			$sports = $this->sportModel->findAll();

			return view('Programme/newFormStep1', [
				'sports' => $sports,
				'errors' => session()->getFlashdata('errors') ?? [],
			]);
		}

		if ($this->request->getPost('id_regime')) {
			return $this->finalizeProgram();
		}

		return $this->prepareProgramSuggestions();
	}

	// GET /frontoffice/programmes/user or /frontoffice/programmes/user/(:num)
	public function getProgramByUserId(?int $userId = null)
	{
		$userId = $userId ?? (int) session()->get('user_id');
		$programme = $this->buildProgrammeForUser($userId);

		return $this->response->setJSON($programme);
	}

	private function prepareProgramSuggestions()
	{
		$objectif = (string) $this->request->getPost('objectif');
		$rules = [
			'objectif' => 'required|in_list[augmenter,reduire,imc]',
			'duree_semaine' => 'required|is_natural_no_zero',
		];

		if ($objectif !== 'imc') {
			$rules['poids'] = 'required|numeric|greater_than[0]';
		}

		if (!$this->validate($rules)) {
			return redirect()->back()
							 ->with('errors', $this->validator->getErrors())
							 ->withInput();
		}

		$prefs = [
			'objectif' => $objectif,
			'poids' => $objectif === 'imc' ? null : (float) $this->request->getPost('poids'),
			'duree_semaine' => (int) $this->request->getPost('duree_semaine'),
			'activites' => array_map('intval', (array) $this->request->getPost('activites')),
		];

		session()->set('programme_prefs', $prefs);

		$regimes = $this->regimeModel->getByObjectif($objectif);
		$sports = $this->sportModel->getByIds($prefs['activites']);
		$sportsPayload = [];
		foreach ($sports as $sport) {
			$sportsPayload[] = [
				'id' => $sport['id'],
				'nom' => $sport['nom'],
				'quantite' => 1,
			];
		}

		$programmes = [];
		foreach ($regimes as $regime) {
			$programmes[] = [
				'id' => $regime['id'],
				'regime' => [
					'id' => $regime['id'],
					'nom' => $regime['nom'],
					'prix' => $regime['prix_jour'],
					'taux_poisson' => $regime['taux_poisson'],
					'taux_viande' => $regime['taux_viande'],
					'taux_volaille' => $regime['taux_volaille'],
				],
				'sports' => $sportsPayload,
			];
		}

		return view('Programme/newFormStep2', [
			'programmes' => $programmes,
		]);
	}

	private function finalizeProgram()
	{
		$prefs = session()->get('programme_prefs');
		if (!$prefs) {
			return redirect()->to('/frontoffice/programmes/new')
							 ->with('error', 'Veuillez définir vos préférences avant de choisir un régime.');
		}

		$userId = (int) session()->get('user_id');
		$user = $this->userModel->find($userId);
		if (!$user) {
			return redirect()->to('/frontoffice/programmes/new')
							 ->with('error', 'Utilisateur introuvable.');
		}

		$objectif = (string) ($prefs['objectif'] ?? 'imc');
		$poidsCible = (float) $user['poids'];
		if ($objectif === 'augmenter') {
			$poidsCible = (float) $user['poids'] + (float) $prefs['poids'];
		} elseif ($objectif === 'reduire') {
			$poidsCible = (float) $user['poids'] - (float) $prefs['poids'];
		}

		$dateDebut = date('Y-m-d');
		$dureeJour = ((int) $prefs['duree_semaine']) * 7;
		$dateFin = date('Y-m-d', strtotime('+' . $dureeJour . ' days'));

		$programId = $this->programModel->insert([
			'id_user' => $userId,
			'objectif' => $objectif,
			'poids_cible' => $poidsCible,
			'regime_id' => (int) $this->request->getPost('id_regime'),
			'duree_regime' => $dureeJour,
			'date_debut' => $dateDebut,
			'date_fin' => $dateFin,
		], true);

		if (!$programId) {
			return redirect()->to('/frontoffice/programmes/new')
							 ->with('error', 'Impossible de créer le programme.');
		}

		$sportIds = (array) $this->request->getPost('id_sport');
		$quantites = (array) $this->request->getPost('quantite_sport');
		$rows = [];
		foreach ($sportIds as $index => $sportId) {
			$rows[] = [
				'id_program' => (int) $programId,
				'id_sport' => (int) $sportId,
				'quantite' => (int) ($quantites[$index] ?? 1),
			];
		}

		if (!empty($rows)) {
			$this->programSportModel->insertBatch($rows);
		}

		session()->remove('programme_prefs');

		return redirect()->to('/frontoffice/programme')
						 ->with('success', 'Programme créé avec succès.');
	}

	private function buildProgrammeForUser(int $userId): ?array
	{
		$program = $this->programModel->getLatestByUserId($userId);
		if (!$program) {
			return null;
		}

		$regime = $this->regimeModel->find($program['regime_id']);
		$sports = $this->programSportModel->getSportsByProgramId((int) $program['id']);

		$regimePayload = [
			'nom' => '',
			'taux_poisson' => 0,
			'taux_viande' => 0,
			'taux_volaille' => 0,
		];

		if ($regime) {
			$regimePayload = [
				'nom' => $regime['nom'],
				'taux_poisson' => $regime['taux_poisson'],
				'taux_viande' => $regime['taux_viande'],
				'taux_volaille' => $regime['taux_volaille'],
			];
		}

		return [
			'id' => $program['id'],
			'date_fin' => $program['date_fin'],
			'regime' => $regimePayload,
			'sports' => array_map(static function (array $sport): array {
				return [
					'nom' => $sport['nom'],
					'quantite' => $sport['quantite'],
				];
			}, $sports),
		];
	}
}
