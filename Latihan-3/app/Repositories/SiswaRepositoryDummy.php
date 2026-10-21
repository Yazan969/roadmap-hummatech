<?php

namespace App\Repositories;

use App\Interfaces\SiswaRepositoryInterface;

class SiswaRepositoryDummy implements SiswaRepositoryInterface
{
    private array $data = [
        1 => ['id' => 1, 'nama' => 'Andi', 'nilai' => 90],
        2 => ['id' => 2, 'nama' => 'Budi', 'nilai' => 75],
    ];

    public function getAll()
    {
        return collect(array_map(
            fn (array $siswa) => (object) $siswa,
            array_values($this->data)
        ));
    }

    public function findById(int $id)
    {
        return isset($this->data[$id])
            ? (object) $this->data[$id]
            : null;
    }

    public function create(array $data)
    {
        $id = empty($this->data)
            ? 1
            : max(array_keys($this->data)) + 1;

        $siswa = array_merge($data, ['id' => $id]);

        $this->data[$id] = $siswa;

        return (object) $siswa;
    }

    public function update(int $id, array $data)
    {
        if (!isset($this->data[$id])) {
            return null;
        }

        $this->data[$id] = array_merge(
            $this->data[$id],
            $data
        );

        return (object) $this->data[$id];
    }

    public function delete(int $id): bool
    {
        if (!isset($this->data[$id])) {
            return false;
        }

        unset($this->data[$id]);

        return true;
    }
}
