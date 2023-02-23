<?php

namespace App\View\Composers;

use App\Repositories\AttributeValueRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\NotificationRepository;
use Illuminate\View\View;

class MultiComposer
{
    protected $categoryRepository;
    protected $notificationRepository;
    protected $attributeValueRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        AttributeValueRepository $attributeValueRepository,
        NotificationRepository $notificationRepository
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->attributeValueRepository = $attributeValueRepository;
        $this->notificationRepository = $notificationRepository;
    }

    public function compose(View $view)
    {
        $categories = $this->categoryRepository->all();
        $attributeSize = $this->attributeValueRepository->getAllAttributeValueSize();
        $attributeColor = $this->attributeValueRepository->getAllAttributeValueColor();
        $notifications = $this->notificationRepository->getNotificationByNotifiableId();
        //collection to paginate
        $adminNoti = $notifications->filter(function ($noti) {
            return $noti->for_admin;
        });
        $adminNotiPagination = $adminNoti->paginate($perPage = 4);
        $unreadAdminNoti = $adminNoti->filter(function ($noti) {
            return empty($noti->read_at);
        });
        $data = [
            'categories' => $categories,
            'attributeSize' => $attributeSize,
            'attributeColor' => $attributeColor,
            'adminNoti' => $adminNotiPagination,
            'unreadAdminNoti' => $unreadAdminNoti,
        ];

        if (isMemberLogged()) {
            $memberNotifies = $this->notificationRepository->getMemberNotifies();
            $unreadMemberNoti = $memberNotifies->filter(function ($noti) {
                return empty($noti->read_at);
            });
            $data['memberNotifies'] = $memberNotifies;
            $data['unreadMemberNoti'] = $unreadMemberNoti;
        }

        $view->with($data);
    }
}
