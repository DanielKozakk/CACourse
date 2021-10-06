<?php

namespace Infrastructure\Persistence\Doctrine\Hotel\HotelRoom;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\PersistentCollection;
use Domain\Hotel\Hotel;
use Domain\Hotel\HotelRoom\HotelRoom;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Hotel\HotelRoom\Space;
use Domain\Hotel\HotelRoom\SquareMeter;
use Infrastructure\Persistence\Helper\PropertiesUnwrapper;
use Query\Hotel\HotelRoom\HotelRoomReadModel;
use Query\Hotel\HotelRoom\SpaceReadModel;
use ReflectionException;

/**
 * @method HotelRoom|null find($id, $lockMode = null, $lockVersion = null)
 * @method HotelRoom|null findOneBy(array $criteria, array $orderBy = null)
 * @method HotelRoom[]    findAll()
 * @method HotelRoom[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SqlDoctrineHotelRoomRepository extends ServiceEntityRepository
{

    use PropertiesUnwrapper;

    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        parent::__construct($registry, HotelRoom::class);
        $this->entityManager = $entityManager;
    }

    /**
     * @throws ReflectionException
     */
    public function addHotelRoomToHotel(HotelRoom $hotelRoom)
    {

        $this->entityManager->persist($hotelRoom);
        $this->entityManager->flush();

        $newHotelRoomReadModel = $this->addHotelRoomReadModelToHotelReadModel($hotelRoom);
        $this->entityManager->persist($newHotelRoomReadModel);
        $this->entityManager->flush();
    }

    /**
     * @throws ReflectionException
     */
    private function addHotelRoomReadModelToHotelReadModel(HotelRoom $hotelRoom): HotelRoomReadModel
    {
        $hotelRoomReadModelId = $this->getReflectionValue(HotelRoom::class, 'id', $hotelRoom);
        $hotelRoomReadModelHotel = $this->getReflectionValue(HotelRoom::class, 'hotel', $hotelRoom);
        $hotelRoomReadModelHotelId = $this->getReflectionValue(Hotel::class, 'id', $hotelRoomReadModelHotel);
        $hotelRoomReadModelNumber = $this->getReflectionValue(HotelRoom::class, 'hotelRoomNumber', $hotelRoom);
        $hotelRoomReadModelSpaces = $this->getReflectionValue(HotelRoom::class, 'spaces', $hotelRoom);
        $hotelRoomReadModelDescription = $this->getReflectionValue(HotelRoom::class, 'description', $hotelRoom);

        $newHotelRoomReadModel = new HotelRoomReadModel($hotelRoomReadModelId, $hotelRoomReadModelHotelId, $hotelRoomReadModelNumber, $hotelRoomReadModelDescription);



        $this->assignSpaceReadModelsToHotelRoomReadModel($hotelRoomReadModelSpaces->getValues(), $newHotelRoomReadModel);

        return $newHotelRoomReadModel;
    }

    /**
     * @param array<Space> $spaces
     * @return void
     * @throws ReflectionException
     */
    private function assignSpaceReadModelsToHotelRoomReadModel(array $spaces, HotelRoomReadModel $hotelRoomReadModel)
    {
        foreach ($spaces as $space) {
            $spaceReadModelId = $this->getReflectionValue(Space::class, 'id', $space);
            $spaceReadModelName = $this->getReflectionValue(Space::class, 'name', $space);
            $spaceReadModelSquareMeter = $this->getReflectionValue(Space::class, 'squareMeter', $space);
            $spaceReadModelSquareMeterSize = $this->getReflectionValue(SquareMeter::class, 'size', $spaceReadModelSquareMeter);
            SpaceReadModel::assignNewSpaceReadModelToHotelRoomReadModel($spaceReadModelId, $spaceReadModelName,$spaceReadModelSquareMeterSize,$hotelRoomReadModel);
        }
    }

}
