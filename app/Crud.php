<?php

interface Crud
{
    public function search(string $query): array;
    public function add(array $params): bool;
    public function deleteByID(string $id): bool;
    public function updateByID(string $id): bool;
}