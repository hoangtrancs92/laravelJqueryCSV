<?php

namespace App\Repositories\Interfaces;

interface GroupRepositoryInterface
{
    public function getAllGroups();
    public function getIdGroups();
    public function importCSV($condition);
    public function getListGroup();

}
