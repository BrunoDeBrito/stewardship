<?php

namespace App\Services\Core;

use Illuminate\Database\Eloquent\Model;

class BaseService
{
    public function __construct(protected $repository) {}

    /**
     * @return bool
     */
    public function update(Model|int $modelOrId, array $data)
    {
        $item = $modelOrId instanceof Model ? $modelOrId : $this->repository->findById($modelOrId);

        if (! $item) {
            abort(response()->json([
                'message' => 'Registro não encontrado',
            ], 400));

        }

        return $this->repository->update($item, $data);
    }

    public function getAll(?array $data = null)
    {
        return $this->repository->getAll($data);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }

    public function delete(Model|int $modelOrId)
    {
        $item = $modelOrId instanceof Model ? $modelOrId : $this->repository->findById($modelOrId);
        //   $item = $this->repository->find($id);

        if (! $item) {
            abort(response()->json([
                'message' => 'Registro não encontrado',
            ], 400));
        }

        if (! $this->canDelete($item)) {
            abort(response()->json([
                'message' => 'Registro sendo utilizado',
            ], 400));
        }

        return $this->repository->delete($item);
    }

    public function canDelete($item): bool
    {
        if (isset($this->deleteRelations)) {
            foreach ($this->deleteRelations as $relation) {
                if (count($item->$relation()->get()) > 0) {
                    return false;
                }
            }
        }

        return true;
    }
}
