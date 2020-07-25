<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use Domains\Auth\Repositories\RoleRepository;
use Domains\Auth\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * Undocumented variable.
     *
     * @var [UserRepository]
     */
    protected $userRepository;

    /**
     * create an instance of the controller.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $this->authorize('read-users');

        return Inertia::render('Users/Index', [
            'users' => $this->userRepository->getAllWithRoles()
        ]);
    }

    public function create(RoleRepository $roleRepository)
    {
        $this->authorize('create-users');

        return inertia::render('Users/Create', [
            'roles' => $roleRepository->all(['name', 'id']),
        ]);
    }

    public function store(UserFormRequest $request)
    {
        $this->authorize('created-users');

        $this->userRepository->create($request);

        return redirect()
            ->route('users.index')
            ->withSuccess('User Added Successfully!');
    }

    public function show($id)
    {
        $this->authorize('read-users');
        $user = $this->userRepository->getById($id);
        return Inertia::render('Users/Show', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'active' => $user->active,
                'email_verified_at' => $user->email_verified_at,
                'created_at' => $user->created_at,
                'roles' => $user->roles->pluck('name')->toArray(),
            ]
        ]);
    }

    public function edit($id, RoleRepository $roleRepository)
    {
        $this->authorize('update-users');
        $user = $this->userRepository->getById($id);
        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'active' => $user->active,
                'email_verified_at' => $user->email_verified_at,
                'created_at' => $user->created_at,
                'roles' => $user->roles->pluck('id')->toArray(),
            ],
            'roles' => $roleRepository->all(['name', 'id']),
        ]);
    }

    public function update(UserFormRequest $request, $id)
    {
        $this->authorize('update-users');

        $this->userRepository->update(
            $request,
            $this->userRepository->getById($id)
        );

        return redirect()
            ->route('users.show', $id)
            ->withSuccess('User Updated Successfully!');
    }

    public function destroy($id)
    {
        $this->authorize('delete-users');

        $this->userRepository->delete($id);

        return redirect()
            ->route('users.index')
            ->withSuccess('User Deleted Successfully!');
    }
}
