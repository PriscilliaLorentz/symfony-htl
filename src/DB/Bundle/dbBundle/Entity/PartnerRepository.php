<?php

namespace DB\Bundle\dbBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PartnerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PartnerRepository extends EntityRepository
{
	public function findUserPartners($user) {
		$qb = $this->createQueryBuilder('p');
		$qb ->where('p.user = :user') ->setParameter('user', $user)
			->orWhere('p.user_partner = :user') ->setParameter('user', $user)
			->andWhere('p.active = :actif') ->setParameter('actif', TRUE)
			->orderBy('p.createDate', 'ASC'); 
		return $qb->getQuery()->getResult();
	}

	public function findWaitingPartners($user) {
		$qb = $this->createQueryBuilder('p');
		$qb ->where('p.user_partner = :user') ->setParameter('user', $user)
			->andWhere('p.active = :actif') ->setParameter('actif', FALSE)
			->orderBy('p.createDate', 'DESC'); 
		return $qb->getQuery()->getResult();
	}

	public function findPartner($user, $userPartner) {
		$qb = $this->createQueryBuilder('p');
		$qb ->where('p.user = :user') ->setParameter('user', $user)
			->andWhere('p.user_partner = :userPartner') ->setParameter('userPartner', $userPartner)
			->andWhere('p.active = :actif') ->setParameter('actif', TRUE);
		return $qb->getQuery()->getResult();
	}

	public function findWaitingPartner($user, $userPartner) {
		$qb = $this->createQueryBuilder('p');
		$qb ->where('p.user = :user') ->setParameter('user', $user)
			->andWhere('p.user_partner = :userPartner') ->setParameter('userPartner', $userPartner)
			->andWhere('p.active = :actif') ->setParameter('actif', FALSE);
		return $qb->getQuery()->getResult();
	}
}