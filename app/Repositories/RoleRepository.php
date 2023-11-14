<?php
namespace App\Repositories;

use App\Http\Requests\StoreRoleRequest;
use App\Interfaces\RoleRepositoryInterface;
use App\Models\Role;
use App\Traits\ResponseAPI;

class RoleRepository implements RoleRepositoryInterface
{

    use ResponseAPI;

    public function index()
    {
        try {
            $roles = Role::select('id', 'name', 'created_at')->get();
            return $this->success("feched sucessfully", $roles, 200);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Summary of store
     * @param \App\Http\Requests\StoreRoleRequest $request
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function store(StoreRoleRequest $request)
    {
        try {
            $role = Role::create($request->all());
            return $this->success("created sucessfully", $role, 201);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Summary of show
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function show($id)
    {
        try {
            $role = Role::find($id);

            if (!$role) {
                return $this->error('role not found', 404);
            }
            return $this->success("feched sucessfully", $role, 200);
        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Summary of update
     * @param \App\Http\Requests\StoreRoleRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function update(StoreRoleRequest $request, $id)
    {
        try {
            $role = Role::find($id);

            if (!$role) {
                return $this->error('role not found', 404);
            }
            $role->update($request->all());

            return $this->success("updated sucessfully", $role, 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Summary of destroy
     * @param mixed $id
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function destroy($id)
    {
        try {
            $role = Role::find($id);

            if (!$role) {
                return $this->error('role not found', 404);
            }
            $role->delete();
            return $this->success("deleted sucessfully", $role, 200);

        } catch (\Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
}

?>