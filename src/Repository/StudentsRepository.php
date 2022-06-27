<?php

namespace App\Repository;

use App\Entity\Students;
use Exception;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Students>
 *
 * @method Students|null find($id, $lockMode = null, $lockVersion = null)
 * @method Students|null findOneBy(array $criteria, array $orderBy = null)
 * @method Students[]    findAll()
 * @method Students[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Students::class);
    }

    public function add(Students $entity, bool $flush = false): void
    {
        try
        {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
        $this->getEntityManager()->commit();
    }
    catch(Exception $ex)
    {
      $this->getEntityManager()->rollback();
    }
    }

    public function RawQuery($RawQuery  = null)
    {
        $statement = $this->getEntityManager()->getConnection()->prepare($RawQuery );
        return $statement->executeQuery()->fetchAllAssociative();
    }

    public function remove(Students $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function FindStudent()
    {

        $conn = $this->getEntityManager()->getConnection(); 
        $sql = 'SELECT students.id,students.name, students.class_id,students.admission_number,
        classes.class_name FROM classes JOIN students ON classes.id = students.class_id';

        $stmt = $conn->prepare($sql);

        $resultSet = $stmt->executeQuery();

         return $resultSet->fetchAllAssociative();
    }

    public function GetByClassId(int $id)
    {
        $conn = $this->getEntityManager()->getConnection();
        // $sql="SELECT b.id,b.class_id, b.Admission_Number, b.name as StuName,
        // a.Name FROM classes a JOIN students b on b.class_Id = '$id'
        // GROUP BY b.id"
        $sql="SELECT students.id,students.class_id, students.admission_number,students.name as studentname, classes.class_name
         FROM students JOIN classes ON classes.id = '$id' Where students.class_id = '$id';";
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();
         return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return Students[] Returns an array of Students objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Students
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
