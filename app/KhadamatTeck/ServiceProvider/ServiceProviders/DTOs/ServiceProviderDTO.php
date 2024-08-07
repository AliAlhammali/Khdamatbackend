<?php

namespace App\KhadamatTeck\ServiceProvider\ServiceProviders\DTOs;

class ServiceProviderDTO implements \JsonSerializable
{
    private int $id;
    private ?string $title;
    private ?string $description;
    private ?string $status;
    private ?string $address;
    private ?string $phone;
    private ?string $logo;
    private ?string $vat_file;
    private ?string $cr_file;
    private ?string $sales_agreement_file;
    private ?string $cr_number;
    private ?string $vat_number;
    private ?string $email;

    private bool $can_collect_vat = true;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): void
    {
        $this->status = $status;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): void
    {
        $this->logo = $logo;
    }

    public function getVatFile(): ?string
    {
        return $this->vat_file;
    }

    public function setVatFile(?string $vat_file): void
    {
        $this->vat_file = $vat_file;
    }

    public function getCrFile(): ?string
    {
        return $this->cr_file;
    }

    public function setCrFile(?string $cr_file): void
    {
        $this->cr_file = $cr_file;
    }

    public function getSalesAgreementFile(): ?string
    {
        return $this->sales_agreement_file;
    }

    public function setSalesAgreementFile(?string $sales_agreement_file): void
    {
        $this->sales_agreement_file = $sales_agreement_file;
    }

    public function getCrNumber(): ?string
    {
        return $this->cr_number;
    }

    public function setCrNumber(?string $cr_number): void
    {
        $this->cr_number = $cr_number;
    }

    public function getVatNumber(): ?string
    {
        return $this->vat_number;
    }

    public function setVatNumber(?string $vat_number): void
    {
        $this->vat_number = $vat_number;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getCanCollectVat(): bool
    {
        return $this->can_collect_vat;
    }

    public function setCanCollectVat(bool $can_collect_vat): void
    {
        $this->can_collect_vat = $can_collect_vat;
    }


    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'status' => $this->getStatus(),
            'address' => $this->getAddress(),
            'phone' => $this->getPhone(),
            'logo' => $this->getLogo(),
            'vat_file' => $this->getVatFile(),
            'cr_file' => $this->getCrFile(),
            'sales_agreement_file' => $this->getSalesAgreementFile(),
            'cr_number' => $this->getCrNumber(),
            'vat_number' => $this->getVatNumber(),
            'email' => $this->getEmail(),
            'can_collect_vat' => $this->getCanCollectVat()

        ];
    }
}
