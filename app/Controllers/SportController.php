<?php

namespace App\Controllers;

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

    public function list()
    {
        $data = [
            'sports' => $this->sportModel->findAll(),
        ];

        return view('Sport/list', $data);
    }

    // GET /backoffice/sports/new

    public function newForm()
    {
        return view('Sport/newForm');
    }

    // POST /backoffice/sports/new

    public function submitNewForm()
    {

        $data = $this->request->getPost();

        if (!$this->sportModel->validate($data)) {
            return redirect()->back()
                            ->with('errors', $this->sportModel->errors())
                            ->withInput();
        }


        try {
            $this->sportModel->insert($data);
            return redirect()->to('/backoffice/sports')
                            ->with('success', 'Le sport a été créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Une erreur est survenue : ' . $e->getMessage())
                            ->withInput();
        }
    }


    // GET /backoffice/sports/:id/edit

    public function editForm(int $id)
    {
        $sport = $this->sportModel->find($id);

        if (!$sport) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $data = [
            'sport' => $sport,
        ];

        return view('Sport/editForm', $data);
    }

    // POST /backoffice/sports/:id/edit

    public function submitEditForm(int $id)
    {
        // Vérifier que le sport existe
        if (!$this->sportModel->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }


        $data = $this->request->getPost();


        if (!$this->sportModel->validate($data)) {
            return redirect()->back()
                            ->with('errors', $this->sportModel->errors())
                            ->withInput();
        }


        try {
            $this->sportModel->update($id, $data);
            return redirect()->to('/backoffice/sports')
                            ->with('success', 'Le sport a été modifié avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Une erreur est survenue : ' . $e->getMessage())
                            ->withInput();
        }
    }


    // POST /backoffice/sports/:id/delete

    public function delete(int $id)
    {

        if (!$this->sportModel->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }


        try {
            $this->sportModel->delete($id);
            return redirect()->to('/backoffice/sports')
                            ->with('success', 'Le sport a été supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }
}
