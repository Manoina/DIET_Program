<?php

namespace App\Controllers;

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
    public function list()
    {
        $data = [
            'regimes' => $this->regimeModel->findAll(),
        ];

        return view('Backoffice/Regime/list', $data);
    }


    // GET /backoffice/regimes/new
    public function newForm()
    {
        return view('Backoffice/Regime/newForm');
    }


    // POST /backoffice/regimes/new
    public function submitNewForm()
    {

        $data = $this->request->getPost();


        if (!$this->regimeModel->validate($data)) {
            return redirect()->back()
                            ->with('errors', $this->regimeModel->errors())
                            ->withInput();
        }


        try {
            $this->regimeModel->insert($data);
            return redirect()->to('/backoffice/regimes')
                            ->with('success', 'Le régime a été créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Une erreur est survenue : ' . $e->getMessage())
                            ->withInput();
        }
    }


    // GET /backoffice/regimes/:id/edit

    public function editForm(int $id)
    {
        $regime = $this->regimeModel->find($id);

        if (!$regime) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'regime' => $regime,
        ];

        return view('Backoffice/Regime/editForm', $data);
    }

    // POST /backoffice/regimes/:id/edit
    public function submitEditForm(int $id)
    {
        
        if (!$this->regimeModel->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
        $data = $this->request->getPost();


        if (!$this->regimeModel->validate($data)) {
            return redirect()->back()
                            ->with('errors', $this->regimeModel->errors())
                            ->withInput();
        }
        try {
            $this->regimeModel->update($id, $data);
            return redirect()->to('/backoffice/regimes')
                            ->with('success', 'Le régime a été modifié avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Une erreur est survenue : ' . $e->getMessage())
                            ->withInput();
        }
    }

    // POST /backoffice/regimes/:id/delete
    public function delete(int $id)
    {
        if (!$this->regimeModel->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        try {
            $this->regimeModel->delete($id);
            return redirect()->to('/backoffice/regimes')
                            ->with('success', 'Le régime a été supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }
}
