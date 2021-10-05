<?php /** @noinspection PhpMultipleClassDeclarationsInspection */

namespace Infrastructure\Persistence\Doctrine\Hotel;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Domain\Hotel\Hotel;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Hotel\HotelAddress;
use Helpers\PropertiesUnwrapper;
use Query\Hotel\HotelReadModel;
use ReflectionException;

/**
 * @method Hotel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hotel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hotel[]    findAll()
 * @method Hotel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SqlDoctrineHotelRepository extends ServiceEntityRepository
{

    use PropertiesUnwrapper;
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, Hotel::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @throws ReflectionException
     */
    public function save(Hotel $hotel){

        $this->entityManager->persist($hotel);
        $this->entityManager->flush();

        $this->entityManager->persist($this->createHotelReadModel($hotel));
        $this->entityManager->flush();

    }

    /**
     * @throws ReflectionException
     */
    private function createHotelReadModel(Hotel $hotel):HotelReadModel{

        $hotelReadModelId = $this->getReflectionValue(Hotel::class, 'id', $hotel);
        $hotelReadModelName = $this->getReflectionValue(Hotel::class, 'name', $hotel);
        $hotelReadModelAddress = $this->getReflectionValue(Hotel::class, 'address', $hotel);
        $hotelReadModelStreet = $this->getReflectionValue(HotelAddress::class, 'street', $hotelReadModelAddress);
        $hotelReadModelBuildingNumber = $this->getReflectionValue(HotelAddress::class, 'buildingNumber', $hotelReadModelAddress);
        $hotelReadModelPostalCode = $this->getReflectionValue(HotelAddress::class, 'postalCode', $hotelReadModelAddress);
        $hotelReadModelCity = $this->getReflectionValue(HotelAddress::class, 'city', $hotelReadModelAddress);
        $hotelReadModelCountry = $this->getReflectionValue(HotelAddress::class, 'country', $hotelReadModelAddress);

        return new HotelReadModel($hotelReadModelId,$hotelReadModelName, $hotelReadModelStreet, $hotelReadModelBuildingNumber, $hotelReadModelPostalCode, $hotelReadModelCity, $hotelReadModelCountry);
    }
}
