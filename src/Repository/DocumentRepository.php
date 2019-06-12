<?php

namespace App\Repository;

use App\Entity\Document;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Document|null find( $id, $lockMode = NULL, $lockVersion = NULL )
 * @method Document|null findOneBy( array $criteria, array $orderBy = NULL )
 * @method Document[]    findAll()
 * @method Document[]    findBy( array $criteria, array $orderBy = NULL, $limit = NULL, $offset = NULL )
 */
class DocumentRepository extends ServiceEntityRepository {
	public function __construct ( RegistryInterface $registry ) {
		parent::__construct( $registry, Document::class );
	}

	// /**
	//  * @return Document[] Returns an array of Document objects
	//  */
	/*
	public function findByExampleField($value)
	{
		return $this->createQueryBuilder('d')
			->andWhere('d.exampleField = :val')
			->setParameter('val', $value)
			->orderBy('d.id', 'ASC')
			->setMaxResults(10)
			->getQuery()
			->getResult()
		;
	}
	*/

	/*
	public function findOneBySomeField($value): ?Document
	{
		return $this->createQueryBuilder('d')
			->andWhere('d.exampleField = :val')
			->setParameter('val', $value)
			->getQuery()
			->getOneOrNullResult()
		;
	}
	*/
}
