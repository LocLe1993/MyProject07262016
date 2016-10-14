<?php

namespace MyProject\Repository;

class EntityRepository extends \Doctrine\ORM\EntityRepository {
	
	public function save(\MyProject\Entity\Entity $entity)
	{
		$em = $this->getEntityManager();
		$em->getConnection()->beginTransaction();
		try {
			$em->persist($entity);
			$em->flush();
			$em->getConnection()->commit();
		} catch (\Exception $ex) {
			echo $ex;
			$em->getConnection()->rollBack();
			return false;
		}
		return $entity->getId();
	}
	
	public function del_entity(\MyProject\Entity\Entity $entity)
	{
		$em = $this->getEntityManager();
		$em->getConnection()->beginTransaction();
		try {
			$entity->setDelFlg(true);
			$em->persist($entity);
			$em->flush();
			$em->getConnection()->commit();
		} catch (\Exception $ex) {
			echo $ex;
			$em->getConnection()->rollBack();
			return false;
		}
		return $entity->getId();
	}
	
	public function getById($id) {
		return $this->createQueryBuilder('p')
		->select('')
		->where('p.del_flg=0 AND p.id = :id')
		->setParameter('id',$id)
		->getQuery()
		->getSingleResult();
	}
}