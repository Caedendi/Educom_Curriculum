<?php

namespace App\Repository;

use App\Entity\Poppodium;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Poppodium|null find($id, $lockMode = null, $lockVersion = null)
 * @method Poppodium|null findOneBy(array $criteria, array $orderBy = null)
 * @method Poppodium[]    findAll()
 * @method Poppodium[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PoppodiumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Poppodium::class);
    }

    public function savePodium($params) {
        if (isset($params["id"])) {
            $podium = $this->find($params["id"]);
        }
        if ($podium == null) {
            $podium = new Poppodium();
        }

        $podium->setNaam($params["naam"]);
        $podium->setAdres($params["adres"]);
        $podium->setPostcode($params["postcode"]);
        $podium->setWoonplaats($params["woonplaats"]);
        $podium->setTelefoonnummer($params["telefoonnummer"]);
        $podium->setWebsite($params["website"]);
        $podium->setLogoUrl($params["logo_url"]);
        $podium->setAfbeeldingUrl($params["afbeelding_url"]);

        $em = $this->getEntityManager();
        $em->persist($podium);
        $em->flush();

        return($podium);
    }

    public function removePodium($id) {
        $podium = $this->find($id);
        if($podium) {
            $em = $this->getEntityManager();
            $em->remove($podium);
            $em->flush();
        }
        return(false);
    }

    public function findPodiumByNaam($naam) {
        $podium = $this->findOneBy(array("naam" => $naam));

        return $podium;
    }

    // /**
    //  * @return Poppodium[] Returns an array of Poppodium objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Poppodium
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
