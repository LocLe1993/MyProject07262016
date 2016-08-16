<?php

namespace MyProject\Repository;

use MyProject\Entity\Blog;
/**
 * BlogTypeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class BlogTypeRepository extends \Doctrine\ORM\EntityRepository
{
	public  function getListAll(){
		return  $this->createQueryBuilder('p')
					->select('p.name, p.rank')
					->getQuery()
					->getArrayResult();
	}
	
	public function getAllForCBB() {
		return $this->createQueryBuilder('bt')
			->select('bt.id, bt.name')
			->where('bt.del_flg=0')->getQuery()->getArrayResult();
	}
}
