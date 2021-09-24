<?php
//
//namespace Infrastructure\Persistence\Doctrine\Hotel\HotelRoomBookingHistory;
//
//use Domain\Apartment\ApartmentBookingHistory\ApartmentBookingHistory;
//use Domain\Hotel\HotelBookingHistory\HotelBookingHistory;
//use Domain\Hotel\HotelBookingHistory\HotelBookingHistoryRepository;
//use Domain\Hotel\HotelRoom\HotelRoom;
//use Domain\Hotel\HotelRoom\HotelRoomRepository;
//
//class DoctrineHotelRoomBookingHistoryRepository implements HotelBookingHistoryRepository
//{
//    private SqlDoctrineHotelBookingHistoryRepository $sqlDoctrineHotelRoomRepository;
//
//    /**
//     * @param SqlDoctrineHotelBookingHistoryRepository $sqlDoctrineHotelRoomRepository
//     */
//    public function __construct(SqlDoctrineHotelBookingHistoryRepository $sqlDoctrineHotelRoomRepository)
//    {
//        $this->sqlDoctrineHotelRoomRepository = $sqlDoctrineHotelRoomRepository;
//    }
//
//
//    public function existsFor(string $hotelId): bool
//    {
//        $this->sqlDoctrineHotelRoomRepository->existsById($hotelId);
//    }
//
//    public function findFor(string $hotelId): HotelBookingHistory
//    {
//        $this->sqlDoctrineHotelRoomRepository->findById($hotelId);
//    }
//
//    public function save(HotelBookingHistory $hotelBookingHistory): void
//    {
//        $this->sqlDoctrineHotelRoomRepository->save($hotelBookingHistory);
//    }
//}