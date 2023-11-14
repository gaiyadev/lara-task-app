<?php

namespace App\Interfaces;
use App\Http\Requests\StoreRoleRequest;


interface RoleRepositoryInterface {
    /**
     * Summary of index
     * @return void
     */
    public function index();

    /**
     * Summary of store
     * @param \App\Http\Requests\StoreRoleRequest $request
     * @return void
     */
    public function store(StoreRoleRequest $request);

    /**
     * Summary of show
     * @param mixed $id
     * @return void
     */
    public function show($id);

    /**
     * Summary of update
     * @param \App\Http\Requests\StoreRoleRequest $request
     * @param mixed $id
     * @return void
     */
    public function update(StoreRoleRequest $request, $id);
    /**
     * Summary of destroy
     * @param mixed $id
     * @return void
     */
    public function destroy($id);
}


?>