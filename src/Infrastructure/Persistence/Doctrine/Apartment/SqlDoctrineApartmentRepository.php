<?php

namespace Infrastructure\Persistence\Doctrine\Apartment;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentAddress;
use Query\Apartment\ApartmentReadModel;
use ReflectionException;
use ReflectionProperty;

/**
 * @method Apartment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Apartment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Apartment[]    findAll()
 * @method Apartment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SqlDoctrineApartmentRepository extends ServiceEntityRepository
{

    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Apartment::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @throws ReflectionException
     */
    public function save(Apartment $apartment){

        $this->entityManager->persist($apartment);
        $this->entityManager->flush();

//        $this->entityManager->persist($this->createApartmentReadModelObjectFromApartment($apartment));
//        $this->entityManager->flush();

    }

    /**
     * @throws ReflectionException
     */
    private function createApartmentReadModelObjectFromApartment(Apartment $apartment) : ApartmentReadModel{
        $readModelId = $this->getReflectionValue(Apartment::class, 'id', $apartment);
        $readModelDescription = $this->getReflectionValue(Apartment::class, 'description', $apartment);
        $readModelOwnerId = $this->getReflectionValue(Apartment::class, 'ownerId', $apartment);

        $readModelApartmentAddress = $this->getReflectionValue(Apartment::class, 'address', $apartment);
        $readModelApartmentAddressStreet = $this->getReflectionValue(ApartmentAddress::class, 'street', $readModelApartmentAddress);
        $readModelApartmentAddressPostalCode = $this->getReflectionValue(ApartmentAddress::class, 'postalCode', $readModelApartmentAddress);
        $readModelApartmentAddressHouseNumber = $this->getReflectionValue(ApartmentAddress::class, 'houseNumber', $readModelApartmentAddress);
        $readModelApartmentAddressApartmentNumber = $this->getReflectionValue(ApartmentAddress::class, 'apartmentNumber', $readModelApartmentAddress);
        $readModelApartmentAddressCity = $this->getReflectionValue(ApartmentAddress::class, 'city', $readModelApartmentAddress);
        $readModelApartmentAddressCountry = $this->getReflectionValue(ApartmentAddress::class, 'country', $readModelApartmentAddress);

        $readModelRooms = $this->getReflectionValue(Apartment::class, 'rooms', $apartment);

        foreach ($readModelRooms as $room){
            var_dump($room);
        }

        return new ApartmentReadModel($readModelId,
            $readModelOwnerId,
            $readModelApartmentAddressStreet,
            $readModelApartmentAddressPostalCode,
            $readModelApartmentAddressHouseNumber,
            $readModelApartmentAddressApartmentNumber,
            $readModelApartmentAddressCity,
            $readModelApartmentAddressCountry,
            $readModelDescription, []);
    }

    /**
     * @throws ReflectionException
     */
    private function getReflectionValue(string $classFqn, string $propertyName, object $actualObject){
        $reflectionProperty = new ReflectionProperty($classFqn, $propertyName);
        $reflectionProperty->setAccessible(true);
        return $reflectionProperty->getValue($actualObject);
    }


}
