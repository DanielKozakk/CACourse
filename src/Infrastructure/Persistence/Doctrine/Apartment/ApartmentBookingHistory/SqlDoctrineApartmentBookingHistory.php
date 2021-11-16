<?php

namespace Infrastructure\Persistence\Doctrine\Apartment\ApartmentBookingHistory;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBooking;
use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;
use Domain\Apartment\ApartmentBookingHistory\BookingPeriod;
use Domain\Apartment\ApartmentBookingHistory\BookingStep;
use Infrastructure\Persistence\Helper\PropertiesUnwrapper;
use Query\Apartment\ApartmentBookingHistoryReadModel;
use Query\Apartment\ApartmentBookingReadModel;
use Query\Apartment\SqlDoctrineQueryApartmentBookingHistoryRepository;
use Query\Apartment\SqlDoctrineQueryApartmentReadModelRepository;
use ReflectionException;
use RuntimeException;


/**
 * @method ApartmentBookingHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApartmentBookingHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method ApartmentBookingHistory[]    findAll()
 * @method ApartmentBookingHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SqlDoctrineApartmentBookingHistory extends ServiceEntityRepository
{
    use PropertiesUnwrapper;

    private EntityManagerInterface $entityManager;
    private SqlDoctrineQueryApartmentBookingHistoryRepository $queryApartmentBookingHistoryRepository;
    private SqlDoctrineQueryApartmentReadModelRepository $apartmentReadModelRepository;

    public function __construct(ManagerRegistry                                   $registry,
                                EntityManagerInterface                            $entityManager,
                                SqlDoctrineQueryApartmentBookingHistoryRepository $queryApartmentBookingHistoryRepository,
                                SqlDoctrineQueryApartmentReadModelRepository      $apartmentReadModelRepository
    )
    {
        parent::__construct($registry, ApartmentBookingHistory::class);
        $this->entityManager = $entityManager;
        $this->queryApartmentBookingHistoryRepository = $queryApartmentBookingHistoryRepository;
        $this->apartmentReadModelRepository = $apartmentReadModelRepository;
    }

    /**
     * @throws ReflectionException
     */
    public function save(ApartmentBookingHistory $apartmentBookingHistory){

        $this->entityManager->persist($apartmentBookingHistory);
        $this->entityManager->flush();

        $this->saveApartmentBookingHistoryReadModel($apartmentBookingHistory);
    }

    public function existsById($id) : bool {
        return (bool)$this->find($id);
    }

    public function findById($id) : ApartmentBookingHistory {
        return $this->find($id) ?? throw new RuntimeException();
    }

    /**
     * @throws ReflectionException
     */
    private function saveApartmentBookingHistoryReadModel (ApartmentBookingHistory $apartmentBookingHistory){

        $apartmentBookingHistoryId = $this->getReflectionValue(ApartmentBookingHistory::class, 'id', $apartmentBookingHistory);
        $apartment = $this->getReflectionValue(ApartmentBookingHistory::class, 'apartment', $apartmentBookingHistory);
        $apartmentId = $this->getReflectionValue(Apartment::class, 'id', $apartment);
        $apartmentBookingList = $this->getReflectionValue(ApartmentBookingHistory::class, 'apartmentBookingList', $apartmentBookingHistory);

        $apartmentBookingHistoryReadModel = $this->queryApartmentBookingHistoryRepository->findOneById($apartmentBookingHistoryId);

        $apartmentBookingReadModelList = $this->createApartmentBookingReadModelListFromApartmentBookingList($apartmentBookingList);

        if(!isset($apartmentBookingHistoryReadModel)){
            $apartmentReadModel = $this->apartmentReadModelRepository->findOneById($apartmentId);
            $apartmentBookingHistoryReadModel = new ApartmentBookingHistoryReadModel($apartmentBookingHistoryId,$apartmentReadModel, $apartmentBookingReadModelList );
        }

        $apartmentBookingHistoryReadModel->setApartmentBookingReadModelList($apartmentBookingReadModelList);
        $this->queryApartmentBookingHistoryRepository->save($apartmentBookingHistoryReadModel);
    }

    /**
     * @param array<ApartmentBooking> $apartmentBookingList
     * @return array<ApartmentBookingReadModel>
     * @throws ReflectionException
     */
    private function createApartmentBookingReadModelListFromApartmentBookingList(array $apartmentBookingList):array{

        /** @var array<ApartmentBookingReadModel> $apartmentBookingListReadModel */
        $apartmentBookingListReadModel = [];

        foreach($apartmentBookingList as $apartmentBooking){

            $apartmentBookingId = $this->getReflectionValue(Apartmentbooking::class, 'id', $apartmentBooking);
            $apartmentBookingCreation = $this->getReflectionValue(Apartmentbooking::class, 'bookingCreation', $apartmentBooking);
            $apartmentBookingOwnerId = $this->getReflectionValue(Apartmentbooking::class, 'ownerId', $apartmentBooking);
            $apartmentBookingTenantId = $this->getReflectionValue(Apartmentbooking::class, 'tenantId', $apartmentBooking);

            $apartmentBookingPeriod = $this->getReflectionValue(Apartmentbooking::class, 'bookingPeriod', $apartmentBooking);

            $apartmentBookingStartDate = $this->getReflectionValue(BookingPeriod::class, 'startDate', $apartmentBookingPeriod);
            $apartmentBookingEndDate = $this->getReflectionValue(BookingPeriod::class, 'endDate', $apartmentBookingPeriod);

            $apartmentBookingStep = $this->getReflectionValue(ApartmentBooking::class, 'bookingStep', $apartmentBooking);

            $apartmentBookingStepState = $this->getReflectionValue(BookingStep::class, 'state', $apartmentBookingStep);

            $apartmentBookingListReadModel[] = new ApartmentBookingReadModel(
                $apartmentBookingId,
                $apartmentBookingCreation,
                $apartmentBookingOwnerId,
                $apartmentBookingTenantId,
                $apartmentBookingStartDate,
                $apartmentBookingEndDate,
                $apartmentBookingStepState
            );
        }
        return $apartmentBookingListReadModel;
    }

}
