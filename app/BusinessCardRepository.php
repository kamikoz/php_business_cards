<?php

interface BusinessCardRepository
{
    public function add(BusinessCard $businessCard): int;
    public function searchByID(int $ID): array;
    public function searchByFields(array $fields): array;
    public function searchAll(): array;
}