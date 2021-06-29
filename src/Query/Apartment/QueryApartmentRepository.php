<?php


namespace App\Query\Apartment;


class QueryApartmentRepository
{

    private DoctrineSqlQueryApartmentRepository $repository;

    /**
     * QueryApartmentRepository constructor.
     * @param DoctrineSqlQueryApartmentRepository $sqlQueryApartmentRepository
     */
    public function __construct(DoctrineSqlQueryApartmentRepository $sqlQueryApartmentRepository)
    {
        $this->repository = $sqlQueryApartmentRepository;
    }

    /**
     * @return ApartmentReadModel[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @return ApartmentReadModel|null
     */
    public function findById(string $id): ?ApartmentReadModel
    {
        return $this->repository->findApartmentById($id);
    }
}