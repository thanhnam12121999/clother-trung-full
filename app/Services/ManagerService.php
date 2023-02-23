<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Manager;
use App\Repositories\AccountRepository;
use App\Repositories\ManagerRepository;
use App\Traits\HandleImage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ManagerService extends BaseService
{
    use HandleImage;

    protected $managerRepository;
    protected $accountRepository;

    public function __construct(ManagerRepository $managerRepository, AccountRepository $accountRepository)
    {
        $this->managerRepository = $managerRepository;
        $this->accountRepository = $accountRepository;
    }

    public function updateAccountOfManager($id, $request)
    {
        try {
            DB::beginTransaction();
            $account = $this->accountRepository->find($id);
            $manager_id = $account->accountable->id;
            $accountsData = $request->only(['name', 'email', 'username', 'phone_number', 'gender', 'date_of_birth']);
            if ($request->hasFile('avatar')) {
                $response = $this->deleteImage($account->avatar, 'accounts');
                if (!$response) {
                    throw new \Exception;
                }
                $avatarAccount = $request->file('avatar');
                $newNameImage = $this->createImage($avatarAccount, 'accounts');
                if (!$newNameImage) {
                    return $this->sendError('Lỗi thêm ảnh đại diện, vui lòng thử lại', Response::HTTP_BAD_REQUEST);
                }
                $accountsData['avatar'] = $newNameImage;
            }
            $this->accountRepository->update($id, $accountsData);
            $this->managerRepository->update($manager_id, ['role' => $request->get('status')]);
            DB::commit();
            return $this->sendResponse('Sửa thành công.');
        } catch (\Exception $e) {
            Log::error($e);
            DB::rollBack();
        }
        return $this->sendError('Sửa thất bại');
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $account = $this->accountRepository->find($id);
            $resultDelete = $this->accountRepository->delete($id);
            if(!$resultDelete) {
                throw new \Exception;
            }
            $isDelete = $this->deleteImage($account->avatar, 'accounts');
            if (!$isDelete) {
                throw new \Exception;
            }
            DB::commit();
            return $this->sendResponse('Xóa thành công.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
        }
        return $this->sendError('Xóa thất bại');
    }

    public function storeAccountOfManager($request)
    {
        try {
            DB::beginTransaction();
            $manager = '';
            $accountsData = $request->only(['name', 'email', 'username', 'phone_number', 'gender', 'date_of_birth']);
            $avatarAccount = $request->file('avatar');
            if (!empty($avatarAccount)) {
                $newNameImage = $this->createImage($avatarAccount, 'accounts');
                if (!$newNameImage) {
                    return $this->sendError('Lỗi thêm ảnh đại diện, vui lòng thử lại', Response::HTTP_BAD_REQUEST);
                }
                $accountsData['avatar'] = $newNameImage;
            }
            $managerCheckExistRole = $this->managerRepository->getManagerByRole($request->role);
            if (!empty($managerCheckExistRole[0])) {
                $manager = $managerCheckExistRole[0];
            } else {
                $manager = $this->managerRepository->create(['role' => $request->role]);
            }
            if($manager) {
                $accountsData['accountable_id'] = $manager->id;
                $accountsData['accountable_type'] = Manager::class;
            }
            $this->accountRepository->create($accountsData);
            DB::commit();
            return $this->sendResponse('Thêm thành công.');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
        }
        return $this->sendError('Thêm thất bại');
    }
}
