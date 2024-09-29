<?php

namespace App\Controller;

use App\Entity\AttributesTypes;
use App\Entity\AttributesValues;
use App\Form\AttributesType;
use App\Form\AttributesValuesType;
use App\Repository\AttributesTypesRepository;
use App\Repository\AttributesValuesRepository;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AttributesController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private TypeRepository $repoType;
    private AttributesTypesRepository $repoAttributes;

    public function __construct(EntityManagerInterface $entityManager, TypeRepository $repoType, AttributesTypesRepository $repoAttributes)
    {
        $this->entityManager = $entityManager;
        $this->repoType = $repoType;
        $this->repoAttributes = $repoAttributes;
    }

    #[Route('/attributes', name: 'app_create_attributes')]
    public function index(Request $request): Response
    {
        $attributeType = new AttributesTypes();
        $form = $this->createForm(AttributesType::class, $attributeType);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->handleAttributeSubmission($form->getData()->getDataType());
            return $this->redirectToRoute('app_list_attributes');
        }

        return $this->render('attributes/index.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'AttributesController',
        ]);
    }

    #[Route('/attributes/list', name: 'app_list_attributes')]
    public function list(AttributesValuesRepository $repoAttributeValues): Response
    {
        $attributes = $this->repoAttributes->findAll();
        $attributesValues = $repoAttributeValues->findAll();

        $idAttributeCounts = $this->countAttributeOccurrences($attributesValues);
        foreach ($attributes as $attribute) {
            $attribute->count = $idAttributeCounts[$attribute->getId()] ?? 0;
        }

        return $this->render('attributes/list.html.twig', [
            'attributes' => $attributes,
        ]);
    }

    #[Route('/attributes/add/value/{id}', name: 'attribute_add')]
    public function addValues(Request $request, AttributesTypes $attribut): Response
    {
        $attributeValue = new AttributesValues();
        $form = $this->createForm(AttributesValuesType::class, $attributeValue, ['attribute_type' => $attribut->getType()]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $value = $attributeValue->getValue(); 
            
            if ($value) {
                $this->persistAttributeValue($attribut, $value);
                return $this->redirectToRoute('app_list_attributes');
            } else {
                $this->addFlash('danger', 'La valeur ne peut pas être vide.');
            }
        } else {
            $errors = $form->getErrors(true);
            foreach ($errors as $error) {
                $this->addFlash('error', $error->getMessage());
            }
        }

        return $this->render('attributes/addValues.html.twig', [
            'form' => $form->createView(),
            'controller_name' => 'AttributesController',
        ]);
    }


    private function handleAttributeSubmission(string $dataTypesJson): void
    {
        $dataTypesArray = json_decode($dataTypesJson, true);
        if (!is_array($dataTypesArray)) {
            $this->addFlash('danger', 'Format de données invalide.');
            return;
        }

        foreach ($dataTypesArray as $attribute) {
            foreach ($attribute as $label => $type) {
                $newAttribute = new AttributesTypes();
                $newAttribute->setLabel($label);
                $newAttribute->setType($this->repoType->find($type));
                $this->entityManager->persist($newAttribute);
            }
        }

        $this->flushEntityManager('L\'attribut a été créé avec succès !', 'Une erreur est survenue lors de la sauvegarde des attributs.');
    }

    private function countAttributeOccurrences(array $attributesValues): array
    {
        $idAttributeCounts = [];
        foreach ($attributesValues as $values) {
            $attributeType = $values->getAttributesType();
            if ($attributeType && ($id = $attributeType->getId())) {
                $idAttributeCounts[$id] = ($idAttributeCounts[$id] ?? 0) + 1;
            }
        }
        return $idAttributeCounts;
    }

    private function persistAttributeValue(AttributesTypes $attribut, string $value): void
    {
        $attributeValue = new AttributesValues();
        $attributeValue->setAttributesType($attribut);
        $attributeValue->setValue($value);
        $this->entityManager->persist($attributeValue);
        $this->flushEntityManager('La valeur a été ajoutée avec succès!');
    }

    private function flushEntityManager(string $successMessage, string $errorMessage = 'Une erreur est survenue.'): void
    {
        try {
            $this->entityManager->flush();
            $this->addFlash('success', $successMessage);
        } catch (\Exception $e) {
            $this->addFlash('error', $errorMessage);
        }
    }
}
