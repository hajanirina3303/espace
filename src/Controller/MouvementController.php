<?php

namespace App\Controller;

use App\Entity\Approvisionnement;
use App\Entity\Depense;
use App\Entity\Don;
use App\Entity\Mouvement;
use App\Entity\Piece;
use App\Entity\Recette;
use App\Form\FiltreBilanType;
use App\Form\FiltreType;
use App\Form\MouvementApprovisionnementType;
use App\Form\MouvementDepenseType;
use App\Form\MouvementDonType;
use App\Form\MouvementType;
use App\Repository\DonObjetRepository;
use App\Repository\MouvementRepository;
use App\Repository\RubriqueRepository;
use App\Repository\PieceRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/mouvement')]
class MouvementController extends AbstractController
{

    private MouvementRepository $mouvementRepository;
    private RubriqueRepository $rubriqueRepository;
    private PieceRepository $pieceRepository;
    private DonObjetRepository $donObjetRepository;

    public function __construct(
        MouvementRepository $mouvementRepository,
        RubriqueRepository $rubriqueRepository,
        PieceRepository $pieceRepository,
        DonObjetRepository $donObjetRepository
    )
    {
        //repository
        $this->mouvementRepository = $mouvementRepository;
        $this->rubriqueRepository = $rubriqueRepository;
        $this->pieceRepository = $pieceRepository;
        $this->donObjetRepository = $donObjetRepository;

    }
    
    #[Route('/', name: 'mouvement_index', methods: ['GET', 'POST'])]
    public function index(Request $request,EntityManagerInterface $entityManager): Response
    {
        $mouvements = array();
       
        $date_debut = new DateTime();
        $date_debut->setTime(0,0,0,0);

        $date_encour = new DateTime();

        $date_fin = new DateTime();
        $date_fin->setTime(24,59,59,0);


        $id_mouvement = null;

        $form_filtre = $this->createForm(FiltreType::class);
        $form_filtre->handleRequest($request);

        if ($form_filtre->isSubmitted() && $form_filtre->isValid()) {

            $data_filtre = $form_filtre->getData();
            $mouvements = $this->mouvementRepository->findByDate($data_filtre['dateDebut'],$data_filtre['dateFin']);
            $date_debut = $data_filtre['dateDebut'];
        }else {                      
            $mouvements = $this->mouvementRepository->findLast10($date_fin);

            if(count($mouvements)!=0){
                $date_debut = $mouvements[count($mouvements)-1]->getDatemouvement();
                $id_mouvement = $mouvements[count($mouvements)-1]->getIdmouvement();
            }            
        }

        return $this->render('mouvement/index.html.twig', [
            'mouvements' => $mouvements,
            'date_debut' => $date_debut,
            'id_mouvement' => $id_mouvement,
            'form_filtre' => $form_filtre->createView(),
            'date_encours' => $date_encour
        ]);
    }


    #[Route('/bilan', name: 'mouvement_bilan', methods: ['GET', 'POST'])]
    public function bilan(Request $request,EntityManagerInterface $entityManager): Response
    {
        $bilans = array();

        $date_encour = new DateTime();

        $mois = date('n');
        $year = date('Y');
        $jour_balance = null;
        $jour_fin_balance= null;

        $mois_r = $mois==1?12:$mois-1;
        $year_r = $mois==1?$year-1:$year;

        $bilan_type = '';
        $bilan_type_choix = ''; 
        $bilan_type_annee = '';

        $trimestriel = array(1=>array(1,2,3), 2 => array(4,5,6), 3 => array(7,8,9), 4 => array(10,11,12));
        $semestre = array(1 => array(1,2,3,4,5,6), 2 => array(7,8,9,10,11,12));
        $mensuel = array(1 => array(1),2 => array(2),3 => array(3), 4 => array(4),5 => array(5),6 => array(6),7 => array(7),8 => array(8),9 => array(9),10 => array(10),11 => array(11),12 => array(12));

        $form_filtre = $this->createForm(FiltreBilanType::class);
        $form_filtre->handleRequest($request);

        if ($form_filtre->isSubmitted() && $form_filtre->isValid()) {

            $data_filtre = $form_filtre->getData();
            
            $bilan_type = $data_filtre['type'];
            $bilan_type_annee = $data_filtre['annee'];

            $liste_mois = ['','JANVIER', 'FEVRIER', 'MARS', 'AVRIL', 'MAI', 'JUIN','JUILLET', 'AOUT', 'SEPTEMBRE','OCTOBRE','NOVEMBRE','DECEMBRE'];
            $liste_trimestre = ['','PREMIER TRIMESTRE','DEUXIEME TRIMESTRE','TROISEIEME TREIMESTRE','QUATRIEME TRIMESTRE'];
            $liste_semestre = ['','PREMIER SEMESTRE','DEUXIEME SEMESTRE'];

            

            switch ($data_filtre['type']) {
                case 'Annuel':
                    $bilans = $this->rubriqueRepository->findBilan(array(1,2,3,4,5,6,7,8,9,10,11,12), $data_filtre['annee']);
                    $jour_balance = new DateTime(date('Y-m-d', mktime(0,0,0,1,1, $data_filtre['annee']))); 
                    break;
                case 'Mensuel':
                    $bilan_type_choix = $liste_mois[$data_filtre['mensuel']->id];
                    $bilans = $this->rubriqueRepository->findBilan($mensuel[$data_filtre['mensuel']->id], $data_filtre['annee']);
                    $jour_balance = new DateTime(date('Y-m-d', mktime(0,0,0,$mensuel[$data_filtre['mensuel']->id][0],1, $data_filtre['annee']))); 
                    
                    break;
                case 'Trimestriel':
                    $bilan_type_choix = $liste_trimestre[$data_filtre['trimestriel']];
                    $bilans = $this->rubriqueRepository->findBilan($trimestriel[$data_filtre['trimestriel']], $data_filtre['annee']);
                    $jour_balance = new DateTime(date('Y-m-d', mktime(0,0,0,$trimestriel[$data_filtre['trimestriel']][0],1, $data_filtre['annee']))); 
                    break;
                case 'Semestriel':
                    $bilan_type_choix = $liste_semestre[$data_filtre['semestre']];
                    $bilans = $this->rubriqueRepository->findBilan($semestre[$data_filtre['semestre']], $data_filtre['annee']);
                    $jour_balance = new DateTime(date('Y-m-d', mktime(0,0,0,$semestre[$data_filtre['semestre']][0],1, $data_filtre['annee'])));     
                    break;
                default:
                    $bilans = $this->rubriqueRepository->findBilan(array($mois_r), $year_r);
                    $jour_balance = new DateTime(date('Y-m-d', mktime(0,0,0,$mois_r,1, $year_r)));     
                    break;
            }
        }else { 
            $jour_balance = new DateTime(date('Y-m-d', mktime(0,0,0,$mois_r,1, $year_r)));        
            $bilans = $this->rubriqueRepository->findBilan(array($mois_r), $year_r);
        }

        return $this->render('bilan/index.html.twig', [
            'bilans' => $bilans,
            'jour_balance' => $jour_balance,
            'form_filtre' => $form_filtre->createView(),
            'date_encours' => $date_encour,
            'bilan_type' => $bilan_type,
            'bilan_type_choix' => $bilan_type_choix,
            'bilan_type_annee' => $bilan_type_annee
        ]);
    }

    #[Route('/bilan_objet', name: 'bilan_objet', methods: ['GET', 'POST'])]
    public function bilan_objet(Request $request,EntityManagerInterface $entityManager): Response
    {
        $bilans = array();

        $date_encour = new DateTime();

        $mois = date('n');
        $year = date('Y');
        $jour_balance = null;
        $jour_fin_balance= null;

        $mois_r = $mois==1?12:$mois-1;
        $year_r = $mois==1?$year-1:$year;

        $bilan_type = '';
        $bilan_type_choix = ''; 
        $bilan_type_annee = '';

        $trimestriel = array(1=>array(1,2,3), 2 => array(4,5,6), 3 => array(7,8,9), 4 => array(10,11,12));
        $semestre = array(1 => array(1,2,3,4,5,6), 2 => array(7,8,9,10,11,12));
        $mensuel = array(1 => array(1),2 => array(2),3 => array(3), 4 => array(4),5 => array(5),6 => array(6),7 => array(7),8 => array(8),9 => array(9),10 => array(10),11 => array(11),12 => array(12));

        $form_filtre = $this->createForm(FiltreBilanType::class);
        $form_filtre->handleRequest($request);

        if ($form_filtre->isSubmitted() && $form_filtre->isValid()) {

            $data_filtre = $form_filtre->getData();
            
            $bilan_type = $data_filtre['type'];
            $bilan_type_annee = $data_filtre['annee'];

            $liste_mois = ['','JANVIER', 'FEVRIER', 'MARS', 'AVRIL', 'MAI', 'JUIN','JUILLET', 'AOUT', 'SEPTEMBRE','OCTOBRE','NOVEMBRE','DECEMBRE'];
            $liste_trimestre = ['','PREMIER TRIMESTRE','DEUXIEME TRIMESTRE','TROISEIEME TREIMESTRE','QUATRIEME TRIMESTRE'];
            $liste_semestre = ['','PREMIER SEMESTRE','DEUXIEME SEMESTRE'];

            

            switch ($data_filtre['type']) {
                case 'Annuel':
                    $bilans = $this->donObjetRepository->findByDate(array(1,2,3,4,5,6,7,8,9,10,11,12), $data_filtre['annee']);
                    $jour_balance = new DateTime(date('Y-m-d', mktime(0,0,0,1,1, $data_filtre['annee']))); 
                    break;
                case 'Mensuel':
                    $bilan_type_choix = $liste_mois[$data_filtre['mensuel']->id];
                    $bilans = $this->donObjetRepository->findByDate($mensuel[$data_filtre['mensuel']->id], $data_filtre['annee']);
                    $jour_balance = new DateTime(date('Y-m-d', mktime(0,0,0,$mensuel[$data_filtre['mensuel']->id][0],1, $data_filtre['annee']))); 
                    
                    break;
                case 'Trimestriel':
                    $bilan_type_choix = $liste_trimestre[$data_filtre['trimestriel']];
                    $bilans = $this->donObjetRepository->findByDate($trimestriel[$data_filtre['trimestriel']], $data_filtre['annee']);
                    $jour_balance = new DateTime(date('Y-m-d', mktime(0,0,0,$trimestriel[$data_filtre['trimestriel']][0],1, $data_filtre['annee']))); 
                    break;
                case 'Semestriel':
                    $bilan_type_choix = $liste_semestre[$data_filtre['semestre']];
                    $bilans = $this->donObjetRepository->findByDate($semestre[$data_filtre['semestre']], $data_filtre['annee']);
                    $jour_balance = new DateTime(date('Y-m-d', mktime(0,0,0,$semestre[$data_filtre['semestre']][0],1, $data_filtre['annee'])));     
                    break;
                default:
                    $bilans = $this->donObjetRepository->findByDate(array($mois_r), $year_r);
                    $jour_balance = new DateTime(date('Y-m-d', mktime(0,0,0,$mois_r,1, $year_r)));     
                    break;
            }
        }else { 
            $jour_balance = new DateTime(date('Y-m-d', mktime(0,0,0,$mois_r,1, $year_r)));        
            $bilans = $this->donObjetRepository->findByDate(array($mois_r), $year_r);
        }

        return $this->render('bilan_objet/index.html.twig', [
            'bilan_objets' => $bilans,
            'jour_balance' => $jour_balance,
            'form_filtre' => $form_filtre->createView(),
            'date_encours' => $date_encour,
            'bilan_type' => $bilan_type,
            'bilan_type_choix' => $bilan_type_choix,
            'bilan_type_annee' => $bilan_type_annee
        ]);

    }

    #[Route('/new', name: 'mouvement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EDITEUR');
        $form_don = $this->createForm(MouvementDonType::class);
        $form_don->handleRequest($request);

        $erreur = '';
        $ouvert='';
        if ($form_don->isSubmitted()) {
            $ouvert = 'don';
            
        }
        if ($form_don->isSubmitted() && $form_don->isValid()) {

            $data_don = $form_don->getData();

            $mouvement = new Mouvement();
            $mouvement->setRubriqueRef($data_don['rubriqueRef']);
            $mouvement->setDatemouvement($data_don['datemouvement']);

            $piece = new Piece();
            
            $piece->setNumeroPiece($data_don['numeroPiece']);
            $piece->setLibellepiece($data_don['libellepiece']);
            $piece->setDatepiece($data_don['datepiece']);
            $entityManager->persist($piece);
            $entityManager->flush();
            
            $mouvement->setPiece($piece);

            $mouvement->setDescription($data_don['description']);
            $mouvement->setMontant($data_don['montant']);
            $entityManager->persist($mouvement);
            $entityManager->flush();

            $recette = new Recette();
            $recette->setIdrecette($mouvement);
            $entityManager->persist($recette);
            $entityManager->flush();

            $don = new Don();
            $don->setNomdonnateur($data_don['donator']);
            $don->setIddon($recette);

            $entityManager->persist($don);
            $entityManager->flush();

               

            return $this->redirectToRoute('mouvement_index', [], Response::HTTP_SEE_OTHER);
        }

        $form_app = $this->createForm(MouvementApprovisionnementType::class);
        $form_app->handleRequest($request);
        if ($form_app->isSubmitted()) {
            $ouvert = 'approvisionnement';
        }
        if ($form_app->isSubmitted() && $form_app->isValid()) {

            $data_app = $form_app->getData();

            $mouvement = new Mouvement();
            $mouvement->setRubriqueRef($data_app['rubriqueRef']);
            $mouvement->setDatemouvement($data_app['datemouvement']);

            $piece = new Piece();
            $piece->setNumeroPiece($data_app['numeroPiece']);
            $piece->setLibellepiece($data_app['libellepiece']);
            $piece->setDatepiece($data_app['datepiece']);
            $entityManager->persist($piece);
            $entityManager->flush();
            $mouvement->setPiece($piece);

            $mouvement->setDescription($data_app['description']);
            $mouvement->setMontant($data_app['montant']);
            $entityManager->persist($mouvement);
            $entityManager->flush();

            $recette = new Recette();
            $recette->setIdrecette($mouvement);
            $entityManager->persist($recette);
            $entityManager->flush();

            $app = new Approvisionnement();
            $app->setIdapprovisionnement($recette);

            $entityManager->persist($app);
            $entityManager->flush();

            return $this->redirectToRoute('mouvement_index', [], Response::HTTP_SEE_OTHER);
        }

        $form_dep = $this->createForm(MouvementDepenseType::class);
        $form_dep->handleRequest($request);
        
        if ($form_dep->isSubmitted()) {
            $ouvert = 'depense';
        }
        if ($form_dep->isSubmitted() && $form_dep->isValid()) {

            $data_dep = $form_dep->getData();

            $mouvement = new Mouvement();
            $mouvement->setRubriqueRef($data_dep['rubriqueRef']);
            $mouvement->setDatemouvement($data_dep['datemouvement']);

            $piece = new Piece();
    
            $piece->setNumeroPiece($data_dep['numeroPiece']);
            $piece->setLibellepiece($data_dep['libellepiece']);
            $piece->setDatepiece($data_dep['datepiece']);
            $entityManager->persist($piece);
            $entityManager->flush();
            $mouvement->setPiece($piece);

            $mouvement->setDescription($data_dep['description']);
            $mouvement->setMontant($data_dep['montant']);
            $entityManager->persist($mouvement);
            $entityManager->flush();

            $depense = new Depense();
            $depense->setIddepense($mouvement);
            $entityManager->persist($depense);
            $entityManager->flush();
 
            return $this->redirectToRoute('mouvement_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('mouvement/new.html.twig', [
            'form_don' => $form_don,
            'form_app' => $form_app,
            'form_dep' => $form_dep,
            'erreur' => $erreur,
            'ouvert' => $ouvert

        ]);
    }

    #[Route('/{idmouvement}', name: 'mouvement_show', methods: ['GET'])]
    public function show(Mouvement $mouvement): Response
    {
        return $this->render('mouvement/show.html.twig', [
            'mouvement' => $mouvement,
        ]);
    }

    #[Route('/new_1', name: 'mouvement_mvt_new', methods: ['GET'])]
    public function mvt_new(Mouvement $mouvement): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EDITEUR');
        return $this->render('mouvement/mvt_new.html.twig', [
            'mouvement' => $mouvement,
        ]);
    }

    #[Route('/{idmouvement}/edit', name: 'mouvement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mouvement $mouvement, EntityManagerInterface $entityManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_EDITEUR');
        $form_don = $this->createForm(MouvementDonType::class);
        $form_don->handleRequest($request);

        if ($form_don->isSubmitted() && $form_don->isValid()) {

            $data_don = $form_don->getData();

            $mouvement = new Mouvement();
            $mouvement->setRubriqueRef($data_don['rubriqueRef']);
            $mouvement->setDatemouvement($data_don['datemouvement']);

            $piece = new Piece();
            $piece->setNumeroPiece($data_don['numeroPiece']);
            $piece->setLibellepiece($data_don['libellepiece']);
            $piece->setDatepiece($data_don['datepiece']);
            $entityManager->persist($piece);
            $entityManager->flush();
            $mouvement->setPiece($piece);

            $mouvement->setDescription($data_don['description']);
            $mouvement->setMontant($data_don['montant']);
            $entityManager->persist($mouvement);
            $entityManager->flush();

            $recette = new Recette();
            $recette->setIdrecette($mouvement);
            $entityManager->persist($recette);
            $entityManager->flush();

            $don = new Don();
            $don->setNomdonnateur($data_don['donator']);
            $don->setIddon($recette);

            $entityManager->persist($don);
            $entityManager->flush();

            return $this->redirectToRoute('mouvement_index', [], Response::HTTP_SEE_OTHER);
        }

        $form_app = $this->createForm(MouvementApprovisionnementType::class);
        $form_app->handleRequest($request);

        if ($form_app->isSubmitted() && $form_app->isValid()) {

            $data_app = $form_app->getData();

            $mouvement = new Mouvement();
            $mouvement->setRubriqueRef($data_app['rubriqueRef']);
            $mouvement->setDatemouvement($data_app['datemouvement']);

            $piece = new Piece();
            $piece->setNumeroPiece($data_app['numeroPiece']);
            $piece->setLibellepiece($data_app['libellepiece']);
            $piece->setDatepiece($data_app['datepiece']);
            $entityManager->persist($piece);
            $entityManager->flush();
            $mouvement->setPiece($piece);

            $mouvement->setDescription($data_app['description']);
            $mouvement->setMontant($data_app['montant']);
            $entityManager->persist($mouvement);
            $entityManager->flush();

            $recette = new Recette();
            $recette->setIdrecette($mouvement);
            $entityManager->persist($recette);
            $entityManager->flush();

            $app = new Approvisionnement();
            $app->setIdapprovisionnement($recette);

            $entityManager->persist($app);
            $entityManager->flush();

            return $this->redirectToRoute('mouvement_index', [], Response::HTTP_SEE_OTHER);
        }

        $form_dep = $this->createForm(MouvementDepenseType::class);
        $form_dep->handleRequest($request);

        if ($form_dep->isSubmitted() && $form_dep->isValid()) {

            $data_dep = $form_dep->getData();

            $mouvement = new Mouvement();
            $mouvement->setRubriqueRef($data_dep['rubriqueRef']);
            $mouvement->setDatemouvement($data_dep['datemouvement']);

            $piece = new Piece();
            $piece->setNumeroPiece($data_dep['numeroPiece']);
            $piece->setLibellepiece($data_dep['libellepiece']);
            $piece->setDatepiece($data_dep['datepiece']);
            $entityManager->persist($piece);
            $entityManager->flush();
            $mouvement->setPiece($piece);

            $mouvement->setDescription($data_dep['description']);
            $mouvement->setMontant($data_dep['montant']);
            $entityManager->persist($mouvement);
            $entityManager->flush();

            $depense = new Depense();
            $depense->setIddepense($mouvement);
            $entityManager->persist($depense);
            $entityManager->flush();

            return $this->redirectToRoute('mouvement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mouvement/new.html.twig', [
            'form_don' => $form_don,
            'form_app' => $form_app,
            'form_dep' => $form_dep

        ]);
    }

    #[Route('/{idmouvement}', name: 'mouvement_delete', methods: ['POST'])]
    public function delete(Request $request, Mouvement $mouvement, EntityManagerInterface $entityManager): Response
    {
        
        $this->denyAccessUnlessGranted('ROLE_EDITEUR');
        if ($this->isCsrfTokenValid('delete'.$mouvement->getIdmouvement(), $request->request->get('_token'))) {
            $entityManager->remove($mouvement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mouvement_index', [], Response::HTTP_SEE_OTHER);
    }
}
