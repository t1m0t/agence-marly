<?php

namespace App\Repository;

use App\Entity\Bien;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;

/**
 * @extends ServiceEntityRepository<Bien>
 *
 * @method Bien|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bien|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bien[]    findAll()
 * @method Bien[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BienRepository extends ServiceEntityRepository
{
    public const RESULT_PER_PAGE = 10;

    public const TYPES = ['vente', 'location'];

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bien::class);
    }

    public function add(Bien $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Bien $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getBiensWithFilters(Request $request, int $pageNumber, int $resultPerPage = Self::RESULT_PER_PAGE): array
    {
        (int)$prixMin = $request->query->get('pmin') ?? null;
        (int)$prixMax = $request->query->get('pmaw') ?? null;
        (int)$surfaceMin = $request->query->get('smin') ?? null;
        (int)$surfaceMax = $request->query->get('smax') ?? null;
        (int)$pieceMin = $request->query->get('pimin') ?? null;
        (int)$pieceMax = $request->query->get('pimax') ?? null;

        (string)$orderby = $request->query->get('ob') ?? null;
        (string)$order = $request->query->get('or') ?? null;

        if ($orderby !== 'prix' || $orderby !== 'surface' || $orderby !== 'carrez') $orderby = null;
        if ($order !== 'desc') $order = 'asc';

        $qb = $this->createQueryBuilder('b');

        if ($prixMin !== null) {
            $qb->andWhere('b.prix >= :prix')
                ->setParameter('prix', $prixMin);
        }
        if ($prixMax !== null) {
            $qb->andWhere('b.prix <= :prix')
                ->setParameter('prix', $prixMax);
        }
        if ($surfaceMin !== null) {
            $qb->andWhere('b.surface >= :surface')
                ->setParameter('surface', $surfaceMin);
        }
        if ($surfaceMax !== null) {
            $qb->andWhere('b.surface <= :surface')
                ->setParameter('surface', $surfaceMax);
        }
        if ($pieceMin !== null) {
            $qb->andWhere('b.carrez >= :carrez')
                ->setParameter('carrez', 'T' . $pieceMin);
        }
        if ($pieceMax !== null) {
            $qb->andWhere('b.carrez <= :carrez')
                ->setParameter('carrez', 'T' . $pieceMax);
        }
        if ($orderby !== null) {
            $qb->orderby('b.' . $orderby, $order);
        }
        $qbForCount = clone $qb;
        $query = $qb
            ->setMaxResults($resultPerPage)
            ->setFirstResult($resultPerPage * ($pageNumber - 1))
            ->getQuery();

        return [
            'query' => $query,
            'maxResult' => count($qbForCount->getQuery()->getResult())
        ];
    }
}
