<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CreditModel;

class CreditController extends BaseController
{
    protected CreditModel $creditModel;

    public function __construct()
    {
        $this->creditModel = new CreditModel();
    }

    // GET /backoffice/credits

    public function list()
    {
        $data = [
            'credits' => $this->creditModel->findAll(),
        ];

        return view('Credit/list', $data);
    }

    // GET /backoffice/credits/new

    public function newForm()
    {
        return view('Credit/newForm');
    }

    // POST /backoffice/credits/new

    public function submitNewForm()
    {
        $data = $this->request->getPost();

        if (!$this->creditModel->validate($data)) {
            return redirect()->back()
                            ->with('errors', $this->creditModel->errors())
                            ->withInput();
        }

        try {
            $this->creditModel->insert($data);
            return redirect()->to('/backoffice/credits')
                            ->with('success', 'Le crédit a été créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Une erreur est survenue : ' . $e->getMessage())
                            ->withInput();
        }
    }

    // GET /backoffice/credits/:id/edit

    public function editForm(int $id)
    {
        $credit = $this->creditModel->find($id);

        if (!$credit) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'credit' => $credit,
        ];

        return view('Credit/editForm', $data);
    }

    // POST /backoffice/credits/:id/edit

    public function submitEditForm(int $id)
    {
        $credit = $this->creditModel->find($id);

        if (!$credit) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = $this->request->getPost();

        $rules = $this->creditModel->getValidationRules();

        // Lors de la modification d'un crédit, ne pas valider l'unicité si le code n'a pas changé
        if (isset($data['code']) && $data['code'] === $credit['code']) {
            $rules['code'] = 'required|min_length[5]|max_length[14]';
            $this->creditModel->setValidationRules($rules);
        }

        if (!$this->creditModel->validate($data)) {
            return redirect()->back()
                            ->with('errors', $this->creditModel->errors())
                            ->withInput();
        }

        try {
            $this->creditModel->update($id, $data);
            return redirect()->to('/backoffice/credits')
                            ->with('success', 'Le crédit a été modifié avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Une erreur est survenue : ' . $e->getMessage())
                            ->withInput();
        }
    }

    // POST /backoffice/credits/:id/delete

    public function delete(int $id)
    {
        if (!$this->creditModel->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        try {
            $this->creditModel->delete($id);
            return redirect()->to('/backoffice/credits')
                            ->with('success', 'Le crédit a été supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                        ->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }
}
