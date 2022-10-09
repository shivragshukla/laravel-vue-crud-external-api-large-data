<?php

namespace App\Interfaces;

interface PropertyRepositoryInterface 
{
    public function getAllProperties();
    public function getAllTypes();
    public function getPropertyById($propertyId);
    public function deleteProperty($propertyId);
    public function createProperty(array $propertyDetails);
    public function updateProperty($propertyId, array $newDetails);
}