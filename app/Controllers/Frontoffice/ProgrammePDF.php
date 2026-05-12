<?php

namespace App\Controllers\Frontoffice;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\ThirdParty\FPDF;

class ProgrammePDF extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $programController = new ProgramController();

        $userId = (int) session()->get('user_id');
        $user = $userModel->find($userId);
        $programme = $programController->buildProgrammeForUser($userId);
        $imc  = $userModel->calculerIMC((float) $user['poids'], (float) $user['taille']);
        $avatarPath = FCPATH . 'assets/images/avatar-user.jpg';

        switch ($programme['objectif']) {
            case 'augmenter':
                $objectif = 'Augmenter le poids';
                break;
            case 'reduire':
                $objectif = 'Réduire le poids';
                break;
            default:
                $objectif = 'Atteindre l’IMC idéal';
        }


        $this->response->setHeader('Content-Type', 'application/pdf');

        $pdf = new FPDF();
        $pdf->SetMargins(16, 18, 16);
        $pdf->SetAutoPageBreak(true, 20);
        $pdf->AddPage();

        $pdf->SetFillColor(245, 242, 247);
        $pdf->Rect(0, 0, $pdf->GetPageWidth(), $pdf->GetPageHeight(), 'F');

        $marginX = 16;
        $pageWidth = $pdf->GetPageWidth() - ($marginX * 2);

        $heroHeight = 26;
        $heroY = $pdf->GetY();
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetDrawColor(184, 112, 184);
        $pdf->Rect($marginX, $heroY, $pageWidth, $heroHeight, 'DF');

        $avatarSize = 14;
        $avatarX = $marginX + 8;
        $avatarY = $heroY + 6;
        if (is_file($avatarPath)) {
            $pdf->Image($avatarPath, $avatarX, $avatarY, $avatarSize, $avatarSize);
        }

        $heroTextX = $avatarX + $avatarSize + 8;
        $pdf->SetXY($heroTextX, $heroY + 6);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->SetTextColor(51, 15, 66);
        $pdf->Cell(0, 6, $this->u($user['nom']), 0, 1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(123, 106, 130);
        $pdf->SetXY($heroTextX, $heroY + 13);
        $pdf->Cell(0, 5, $this->u($user['email']), 0, 1);

        $pdf->SetY($heroY + $heroHeight + 10);

        $genre = $user['genre'] == 'M' ? 'Homme' : 'Femme';
        $this->addSectionCard($pdf, 'Informations personnelles', [
            ['label' => 'Nom', 'value' => $user['nom']],
            ['label' => 'Genre', 'value' => $genre],
            ['label' => 'Email', 'value' => $user['email']],
        ], $marginX);

        $this->addSectionCard($pdf, 'Informations de santé', [
            ['label' => 'Taille', 'value' => $user['taille'] . ' cm'],
            ['label' => 'Poids', 'value' => $user['poids'] . ' kg'],
            ['label' => 'IMC', 'value' => $imc],
            ['label' => 'Objectif', 'value' => $objectif],
            ['label' => 'Poids cible', 'value' => $programme['poids_cible'] . ' kg'],
            ['label' => 'Date de fin', 'value' => date('d/m/Y', strtotime($programme['date_fin']))],
        ], $marginX);

        $this->addSectionCard($pdf, $programme['regime']['nom'], [
            ['label' => 'Taux de viande', 'value' => $programme['regime']['taux_viande'] . '%'],
            ['label' => 'Taux de poisson', 'value' => $programme['regime']['taux_poisson'] . '%'],
            ['label' => 'Taux de volaille', 'value' => $programme['regime']['taux_volaille'] . '%'],
        ], $marginX);

        $sportRows = [];
        foreach ($programme['sports'] as $sport) {
            $sportRows[] = ['label' => $sport['nom'], 'value' => '×' . $sport['quantite']];
        }
        $this->addSectionCard($pdf, 'Activités sportives', $sportRows, $marginX);

        $pdf->Output(null, 'programme.pdf');
    }

    private function u($texte)
    {
        return mb_convert_encoding($texte, 'CP1252', 'UTF-8');
    }

    private function addSectionCard(FPDF $pdf, string $title, array $rows, int $marginX = 16): void
    {
        $normalizedRows = [];
        foreach ($rows as $key => $value) {
            if (is_array($value) && array_key_exists('label', $value) && array_key_exists('value', $value)) {
                $normalizedRows[] = $value;
            } else {
                $normalizedRows[] = ['label' => $key, 'value' => $value];
            }
        }

        $pageWidth = $pdf->GetPageWidth();
        $cardWidth = $pageWidth - ($marginX * 2);
        $x = $marginX;
        $y = $pdf->GetY();
        $paddingX = 8;
        $paddingY = 7;
        $titleHeight = 7;
        $rowHeight = 7;
        $dividerHeight = 3;
        $cardHeight = $paddingY + $titleHeight + $dividerHeight + (count($normalizedRows) * $rowHeight) + $paddingY;

        $pdf->SetDrawColor(184, 112, 184);
        $pdf->SetLineWidth(0.25);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->Rect($x, $y, $cardWidth, $cardHeight, 'DF');

        $pdf->SetXY($x + $paddingX, $y + $paddingY);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetTextColor(51, 15, 66);
        $pdf->Cell(0, $titleHeight, $this->u($title), 0, 1);

        $lineY = $pdf->GetY();
        $pdf->SetDrawColor(184, 112, 184);
        $pdf->Line($x + $paddingX, $lineY, $x + $cardWidth - $paddingX, $lineY);
        $pdf->Ln($dividerHeight);

        foreach ($normalizedRows as $row) {
            $label = $row['label'] ?? '';
            $value = $row['value'] ?? '';

            $pdf->SetX($x + $paddingX);
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->SetTextColor(102, 51, 102);
            $pdf->Cell(60, $rowHeight, $this->u((string) $label), 0, 0);

            $pdf->SetFont('Arial', '', 10);
            $pdf->SetTextColor(42, 29, 51);
            $pdf->Cell($cardWidth - 2 * $paddingX - 60, $rowHeight, $this->u((string) $value), 0, 1, 'R');
        }

        $pdf->SetY($y + $cardHeight + 10);
    }
}
