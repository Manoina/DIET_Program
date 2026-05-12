<?php

namespace App\Controllers\Backoffice;

use App\Controllers\BaseController;
use App\Models\SettingsModel;

class SettingsController extends BaseController
{
    protected SettingsModel $settingsModel;

    public function __construct()
    {
        $this->settingsModel = new SettingsModel();
    }

    public function editForm()
    {
        $settings = $this->settingsModel->first();
        return view('Settings/editForm', ['settings' => $settings]);
    }

    public function submitEditForm()
    {
        $data = $this->request->getPost();

        if (!$this->settingsModel->validate($data)) {
            return redirect()->back()
                             ->with('errors', $this->settingsModel->errors())
                             ->withInput();
        }

        try {
            $this->settingsModel->update(1, $data);
            return redirect()->to('/backoffice/settings')
                            ->with('success', 'Les paramètres ont été modifié avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Une erreur est survenue : ' . $e->getMessage())
                             ->withInput();
        }
    }
}
