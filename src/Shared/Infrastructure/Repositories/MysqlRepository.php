<?php


namespace Src\Shared\Infrastructure\Repositories;


use Src\Shared\Domain\Contracts\BaseRepositoryContract;

abstract class MysqlRepository implements BaseRepositoryContract
{
    protected string $table;
    private MysqlDatabaseDriver $db;

    public function __construct(string $table)
    {
        $this->db = MysqlDatabaseDriver::getInstance();
        $this->table = $table;
    }

    protected function insert(string $query)
    {
        $this->db->query($query);
    }

    protected function delete(string $query)
    {
        $this->db->query($query);
    }

    public function findById(int $id)
    {
        $query = $this->db->query("SELECT * FROM $this->table WHERE id = {$id}");

        $resultSet = null;

        if($query == true)
            if($query->num_rows == 1)
                if($row = $query->fetch_assoc())
                    $resultSet = $row;

        return $resultSet;
    }


    public function search(string $query): ?array
    {
        $query = $this->db->query($query);

        $resultSet = null;

        if($query == true) {
            $resultSet = [];
            while ($row = $query->fetch_assoc())
                $resultSet[] = $row;
        }

        return $resultSet;
    }
}
