<?php

declare(strict_types=1);

namespace App\Employee\Domain;

use App\Employee\Infrastructure\Persistence\Doctrine\Repository\DoctrineEmployeeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: DoctrineEmployeeRepository::class)]
final readonly class Employee
{
    #[ORM\Id]
    #[ORM\Column(type: 'uuid', unique: true)]
    private Uuid $id;

    #[ORM\Column(unique: true)]
    private int $employeeID;

    #[ORM\Column]
    private string $userName;

    #[ORM\Column(length: 5)]
    private string $namePrefix;

    #[ORM\Column]
    private string $firstName;

    #[ORM\Column]
    private string $middleInitial;

    #[ORM\Column]
    private string $lastName;

    #[ORM\Column(length: 1)]
    private string $gender;

    #[ORM\Column]
    private string $email;

    #[ORM\Column]
    private \DateTimeImmutable $dateAndTimeOfBirth;

    #[ORM\Column]
    private \DateTimeImmutable $dateOfJoining;

    #[ORM\Column]
    private string $phoneNo;

    #[ORM\Column]
    private string $placeName;

    #[ORM\Column]
    private string $county;

    #[ORM\Column]
    private string $city;

    #[ORM\Column]
    private string $zip;

    #[ORM\Column]
    private string $region;

    public static function importFirst(
        int $employeeID,
        string $userName,
        string $namePrefix,
        string $firstName,
        string $middleInitial,
        string $lastName,
        string $gender,
        string $email,
        string $dateOfBirth,
        string $timeOfBirth,
        string $dateOfJoining,
        string $phoneNo,
        string $placeName,
        string $county,
        string $city,
        string $zip,
        string $region,
    ): self {
        $self = new self();
        $self->generateId();
        $self->setEmployeeID($employeeID);
        $self->import(
            $userName,
            $namePrefix,
            $firstName,
            $middleInitial,
            $lastName,
            $gender,
            $email,
            $dateOfBirth,
            $timeOfBirth,
            $dateOfJoining,
            $phoneNo,
            $placeName,
            $county,
            $city,
            $zip,
            $region,
        );

        return $self;
    }

    public function import(
        string $userName,
        string $namePrefix,
        string $firstName,
        string $middleInitial,
        string $lastName,
        string $gender,
        string $email,
        string $dateOfBirth,
        string $timeOfBirth,
        string $dateOfJoining,
        string $phoneNo,
        string $placeName,
        string $county,
        string $city,
        string $zip,
        string $region,
    ): void {
        $this->userName = $userName;
        $this->namePrefix = $namePrefix;
        $this->firstName = $firstName;
        $this->middleInitial = $middleInitial;
        $this->lastName = $lastName;
        $this->gender = $gender;
        $this->email = $email;
        $this->dateAndTimeOfBirth = new \DateTimeImmutable($dateOfBirth.' '.$timeOfBirth);
        $this->dateOfJoining = new \DateTimeImmutable($dateOfJoining);
        $this->phoneNo = $phoneNo;
        $this->placeName = $placeName;
        $this->county = $county;
        $this->city = $city;
        $this->zip = $zip;
        $this->region = $region;
    }

    private function setEmployeeID(int $employeeID): void
    {
        $this->employeeID = $employeeID;
    }

    private function generateId(): void
    {
        $this->id = Uuid::v4();
    }

    public function getId(): Uuid
    {
        return $this->id;
    }

    public function getEmployeeID(): int
    {
        return $this->employeeID;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getNamePrefix(): string
    {
        return $this->namePrefix;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getMiddleInitial(): string
    {
        return $this->middleInitial;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getDateOfBirth(): string
    {
        return $this->dateAndTimeOfBirth->format('m/d/Y');
    }

    public function getTimeOfBirth(): string
    {
        return $this->dateAndTimeOfBirth->format('h:i:s A');
    }

    public function getAgeInYrs(): float
    {
        return (float) $this->dateAndTimeOfBirth->diff(new \DateTimeImmutable())->format('%y'); // @todo musst fix
    }

    public function getDateOfJoining(): string
    {
        return $this->dateOfJoining->format('m/d/Y');
    }

    public function getAgeInCompany(): float
    {
        return (float) $this->dateOfJoining->diff(new \DateTimeImmutable())->format('%y'); // @todo musst fix
    }

    public function getPhoneNo(): string
    {
        return $this->phoneNo;
    }

    public function getPlaceName(): string
    {
        return $this->placeName;
    }

    public function getCounty(): string
    {
        return $this->county;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function getRegion(): string
    {
        return $this->region;
    }
}
