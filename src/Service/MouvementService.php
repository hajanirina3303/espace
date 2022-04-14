<?php 

namespace App\Service;

use App\Repository\MouvementRepository;
use DateTime;

class MouvementService
{

    private MouvementRepository $mouvementRepository;

    public function __construct(
        MouvementRepository $mouvementRepository
    )
    {
        //repository
        $this->mouvementRepository = $mouvementRepository;

    }

    public function getSoldeDate($date) 
    {
        return $this->mouvementRepository->findSoldeByDate($date);
    }

    public function getIdDate($id) 
    {
        return $this->mouvementRepository->findSoldeById($id);
    }

    
}