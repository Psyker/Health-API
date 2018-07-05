<?php

namespace App\DataFixtures;

use App\Entity\Symptom;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class SymptomFixtures extends Fixture
{

    private $symptoms = [
        "Mal de tête", "Mal de gorge", "Nausées", "Brûlures d'estomac", "Difficulté à respirer", "Mal de dos", "Essouflement",
        "Démengeaisons", "Piqûres d'insecte", "Allergies", "Fatigue", "Vertiges", "Nez bouché", "Yeux rouges", "Mal aux dents",
        "Diarrhées", "Constipation", "Acouphènes", "Vomissements", "Insomnies", "Hallucinations", "Tremblements", "Perte de cheveux",
    ];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /** @var Symptom $symptom */
        foreach ($this->symptoms as $symptom) {
            $newSymptom = (new Symptom())->setName($symptom);
            $manager->persist($newSymptom);
        }

        $manager->flush();
    }
}
