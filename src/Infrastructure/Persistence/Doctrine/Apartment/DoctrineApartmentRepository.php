<?php
declare(strict_types=1);

namespace Infrastructure\Persistence\Doctrine\Apartment;

use _PHPStan_76800bfb5\Nette\Neon\Exception;
use Application\Apartment\ApartmentNotFoundException;
use Doctrine\ORM\EntityManager;
use Domain\Apartment\Apartment;
use Domain\Apartment\ApartmentRepository;
use ReflectionException;

class DoctrineApartmentRepository implements ApartmentRepository
{
    private SqlDoctrineApartmentRepository $sqlDoctrineApartmentRepository;

    /**
     * @param SqlDoctrineApartmentRepository $sqlDoctrineApartmentRepository
     */
    public function __construct(SqlDoctrineApartmentRepository $sqlDoctrineApartmentRepository)
    {
        $this->sqlDoctrineApartmentRepository = $sqlDoctrineApartmentRepository;
    }

    /**
     * @throws ReflectionException
     */
    public function save(Apartment $apartment): int
    {
     return   $this->sqlDoctrineApartmentRepository->save($apartment);
    }

    public function findById(int $apartmentId): Apartment
    {
        $apartment = $this->sqlDoctrineApartmentRepository->findOneBy(['id' => $apartmentId]);

        return $apartment ?? (throw new ApartmentNotFoundException('Apartment with id' . " $apartmentId " . 'does not exist'));
    }

    public function existById(int $apartmentId): bool
    {
        return false;
    }
}