<?php

namespace App\KhadamatTeck\Merchant\Merchants\DTOs;

class MerchantDTO implements \JsonSerializable
{
            private int $id;
            private string $title;
            private string $description;
            private string $status;
            private string $address;
            private string $phone;
            private string $logo;
            private string $vat_file;
            private string $cr_file;
            private string $sales_agreement_file;
            private string $cr_number;
            private string $vat_number;


/**
     * @return int|null
     */
    public function getId(): int
    {
        return $this->id;
    }

/**
     * @param int|null $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }/**
     * @return string|null
     */
    public function getTitle(): string
    {
        return $this->title;
    }

/**
     * @param string|null $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }/**
     * @return string|null
     */
    public function getDescription(): string
    {
        return $this->description;
    }

/**
     * @param string|null $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }/**
     * @return string|null
     */
    public function getStatus(): string
    {
        return $this->status;
    }

/**
     * @param string|null $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }/**
     * @return string|null
     */
    public function getAddress(): string
    {
        return $this->address;
    }

/**
     * @param string|null $address
     */
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }/**
     * @return string|null
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

/**
     * @param string|null $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }/**
     * @return string|null
     */
    public function getLogo(): string
    {
        return $this->logo;
    }

/**
     * @param string|null $logo
     */
    public function setLogo(string $logo): void
    {
        $this->logo = $logo;
    }/**
     * @return string|null
     */
    public function getVatFile(): string
    {
        return $this->vat_file;
    }

/**
     * @param string|null $vat_file
     */
    public function setVatFile(string $vat_file): void
    {
        $this->vat_file = $vat_file;
    }/**
     * @return string|null
     */
    public function getCrFile(): string
    {
        return $this->cr_file;
    }

/**
     * @param string|null $cr_file
     */
    public function setCrFile(string $cr_file): void
    {
        $this->cr_file = $cr_file;
    }/**
     * @return string|null
     */
    public function getSalesAgreementFile(): string
    {
        return $this->sales_agreement_file;
    }

/**
     * @param string|null $sales_agreement_file
     */
    public function setSalesAgreementFile(string $sales_agreement_file): void
    {
        $this->sales_agreement_file = $sales_agreement_file;
    }/**
     * @return string|null
     */
    public function getCrNumber(): string
    {
        return $this->cr_number;
    }

/**
     * @param string|null $cr_number
     */
    public function setCrNumber(string $cr_number): void
    {
        $this->cr_number = $cr_number;
    }/**
     * @return string|null
     */
    public function getVatNumber(): string
    {
        return $this->vat_number;
    }

/**
     * @param string|null $vat_number
     */
    public function setVatNumber(string $vat_number): void
    {
        $this->vat_number = $vat_number;
    }

    public function jsonSerialize()
    {
        return [
                        'id'=>$this->getId(),
            'title'=>$this->getTitle(),
            'description'=>$this->getDescription(),
            'status'=>$this->getStatus(),
            'address'=>$this->getAddress(),
            'phone'=>$this->getPhone(),
            'logo'=>$this->getLogo(),
            'vat_file'=>$this->getVatFile(),
            'cr_file'=>$this->getCrFile(),
            'sales_agreement_file'=>$this->getSalesAgreementFile(),
            'cr_number'=>$this->getCrNumber(),
            'vat_number'=>$this->getVatNumber(),

        ];
    }
}
