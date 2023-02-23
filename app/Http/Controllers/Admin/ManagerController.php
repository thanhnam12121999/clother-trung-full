<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreManagerAccountRequest;
use App\Http\Requests\UpdateManagerAccountRequest;
use App\Http\Resources\AccountResource;
use App\Repositories\AccountRepository;
use App\Repositories\ManagerRepository;
use App\Services\ManagerService;
use App\Services\RoleService;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    protected $managerRepository;
    protected $accountRepository;
    protected $managerService;
    protected $roleService;

    public function __construct(
        ManagerRepository $managerRepository,
        AccountRepository $accountRepository,
        ManagerService $managerService,
        RoleService $roleService
        )
    {
        $this->managerRepository = $managerRepository;
        $this->accountRepository = $accountRepository;
        $this->managerService = $managerService;
        $this->roleService = $roleService;
    }

    public function index() {
        $listStaffs = AccountResource::collection($this->accountRepository->getAccountManager());
        return view('admin.manager.index', compact('listStaffs'));
    }

    public function create()
    {
        $roles = $this->roleService->getAllRole();
        return view('admin.manager.create', compact('roles'));
    }

    public function store(StoreManagerAccountRequest $request)
    {
        $response = $this->managerService->storeAccountOfManager($request);
        if ($response['success']) {
            return redirect()->route('admin.manager.index')->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }

    public function getFormEdit(int $id)
    {
        $managers = $this->managerRepository->getAll();
        $account = new AccountResource($this->accountRepository->getAccountManagerById($id));
        $roles = $this->roleService->getAllRole();
        return view('admin.manager.edit', compact('managers', 'account', 'roles'));
    }

    public function update(int $id, UpdateManagerAccountRequest $request)
    { 
        $response = $this->managerService->updateAccountOfManager($id, $request);
        if ($response['success']) {
            return redirect()->route('admin.manager.index')->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }

    public function destroy(int $id)
    {
        $response = $this->managerService->delete($id);
        if ($response['success']) {
            return redirect()->route('admin.manager.index')->with('success_msg', $response['message']);
        }
        return redirect()->back()->with('error_msg', $response['message']);
    }
}
