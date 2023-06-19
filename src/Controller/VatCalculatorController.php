<?php

namespace App\Controller;

use App\Entity\Calculation;
use App\Repository\CalculationRepository;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Writer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VatCalculatorController extends AbstractController
{
    private $entityManager;
    private $calculationRepository;

    public function __construct(EntityManagerInterface $entityManager, CalculationRepository $calculationRepository)
    {
        $this->entityManager = $entityManager;
        $this->calculationRepository = $calculationRepository;
    }

    //vat history list
    public function index(): Response
    {
        $calculations = $this->calculationRepository->findAll();

        return $this->render('vat_calculator/index.html.twig', [
            'calculations' => $calculations,
        ]);
    }

    //calculation
    public function calculate(Request $request): Response
    {
        $value = $request->request->get('value');
        $vatRate = $request->request->get('vat_rate');

        // Perform VAT calculations

        $vatAmount = $value * ($vatRate / 100);
        $exVatValue = $value - $vatAmount;
        $incVatValue = $value + $vatAmount;

        $calculation = new Calculation();
        $calculation->setValue($value);
        $calculation->setVatRate($vatRate);
        $calculation->setExVatValue($exVatValue);
        $calculation->setIncVatValue($incVatValue);
        $calculation->setVatAmount($vatAmount);
        $calculation->setCreatedAt(new \DateTime());

        $this->entityManager->persist($calculation);
        $this->entityManager->flush();

        return $this->redirectToRoute('app_home');
    }

    //clear history
    public function clearHistory(): Response
    {
        $calculations = $this->calculationRepository->findAll();

        foreach ($calculations as $calculation) {
            $this->entityManager->remove($calculation);
        }

        $this->entityManager->flush();

        return $this->redirectToRoute('app_home');
    }

    //export csv
    public function exportCsv(): Response
{
    $calculations = $this->calculationRepository->findAll();

    // Set the CSV response headers
    $response = new Response();
    $response->headers->set('Content-Type', 'text/csv');
    $response->headers->set('Content-Disposition', 'attachment; filename="calculations.csv"');

    // Create a CSV writer
    $csvWriter = Writer::createFromString('');
    $csvWriter->setDelimiter(',');
    $csvWriter->setNewline("\r\n");

    // Write the CSV header
    $csvWriter->insertOne(['Value', 'VAT Rate', 'Ex VAT Value', 'Inc VAT Value', 'VAT Amount']);

    // Write the calculation data
    foreach ($calculations as $calculation) {
        $csvWriter->insertOne([
            $calculation->getValue(),
            $calculation->getVatRate(),
            $calculation->getExVatValue(),
            $calculation->getIncVatValue(),
            $calculation->getVatAmount(),
        ]);
    }

    // Output the CSV content
    $response->setContent($csvWriter->getContent());

    return $response;
}
}
