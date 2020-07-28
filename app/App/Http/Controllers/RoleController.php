<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoleFormRequest;
use Domains\Auth\Repositories\RoleRepository;
use Domains\Auth\Repositories\PermissionRepository;

class RoleController extends Controller
{
    /**
     * Undocumented variable.
     *
     * @var [RoleRepository]
     */
    protected $roleRepository;

    /**
     * create an instance of the controller.
     *
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        $this->authorize('read-roles');

        return Inertia::render('Roles/Index', [
            'roles' => $this->roleRepository->getAllWithPermissions()
        ]);
    }

    public function create(PermissionRepository $permissionRepository)
    {
        $this->authorize('create-roles');

        return Inertia::render('Roles/Create', [
            'permissions' => $permissionRepository->all(['name', 'id'])->toArray()
        ]);
    }

    public function store(RoleFormRequest $request)
    {
        $this->authorize('create-roles');

        $this->roleRepository->create($request);

        return redirect()
            ->route('roles.index')
            ->withSuccess('Role Added Successfully!');
    }

    public function edit($id, PermissionRepository $permissionRepository)
    {
        $this->authorize('update-roles');

        $role = $this->roleRepository->getById($id);

        return Inertia::render('Roles/edit', [
            'role' => [
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => $role->permissions->pluck('name')->toArray()
            ],
            'permissions' => $permissionRepository->all()->pluck('name', 'id'),
        ]);
    }

    public function update(RoleFormRequest $request, $id)
    {
        $this->authorize('update-roles');

        $this->roleRepository->update(
            $request,
            $this->roleRepository->getById($id)
        );

        return redirect()
            ->route('roles.show', $id)
            ->withSuccess('Role Updated Successfully!');
    }

    public function destroy($id)
    {
        $this->authorize('delete-roles');

        $this->roleRepository->deleteById($id);

        return redirect()
            ->route('roles.index')
            ->withSuccess('Role Deleted Successfully!');
    }
}
