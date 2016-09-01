admin
$2y$10$VGuexkFQhPq/JRElhPMA4.DmmlfhPwJCFTyi139bFyP9Hvi8QH1Y6

php vendor/doctrine/orm/bin/doctrine orm:schema-tool:update --force

php vendor/doctrine/orm/bin/doctrine orm:generate:entities src/Entity
php vendor/doctrine/orm/bin/doctrine orm:generate:repository src/Repository

---save function

    public function save(\WiredBeans\KenankanCRM\Entity\Car $Car)
    {
        $em = $this->getEntityManager();
        $em->getConnection()->beginTransaction();
        try {
            $em->persist($Car);
            $em->flush();
            $em->getConnection()->commit();
        } catch (\Exception $ex) {
            echo $ex;
            $em->getConnection()->rollBack();
            return false;
        }
        return $Car->getId();
    }
