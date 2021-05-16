<?php

namespace App\Contract;

interface RepositoryInterface
{
    public function all();
    public function getById($id);
    public function update($id, ...$data);
    public function create(...$params);
    public function destroy($id);
}
