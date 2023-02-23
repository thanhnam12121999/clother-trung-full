<?php

namespace App\Notifications;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrdersNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $link;
    protected $time;
    protected $message;
    protected $order;
    protected $orderStatus;
    protected $forAdmin;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order, $orderStatus, $forAdmin = true)
    {
        $this->order = $order;
        $this->orderStatus = $orderStatus;
        $this->forAdmin = $forAdmin;
        $this->setLinkAndMessage();
    }

    private function setLinkAndMessage()
    {
        if ($this->forAdmin) {
            $this->link = url('/') . "/admin/orders?id={$this->order->id}&status={$this->orderStatus}";
        } else {
            // $this->link = config("app.url") . "/don-mua/{$this->order->id}?code={$this->order->order_code}&status={$this->orderStatus}";
            $this->link = url('/') . "/don-mua";
        }
        switch ($this->orderStatus) {
            case Order::WAITING_CONFIRM_STATUS:
                if ($this->forAdmin) {
                    $this->message = __('notifications.orders.waiting_admin', [
                        'orderCode' => $this->order->order_code,
                        'customerName' => $this->order->name
                    ]);
                } else {
                    $this->message = __('notifications.orders.waiting_member', [
                        'orderCode' => $this->order->order_code
                    ]);
                }
                break;
            case Order::CONFIRMED_DELIVERY_STATUS:
                $this->message = __('notifications.orders.confirmed', [
                    'orderCode' => $this->order->order_code,
                ]);
                break;
            case Order::DELIVERED_STATUS:
                if ($this->forAdmin) {
                    $this->message = __('notifications.orders.admin_delivered', [
                        'orderCode' => $this->order->order_code,
                        'customerName' => $this->order->name
                    ]);
                } else {
                    $this->message = __('notifications.orders.member_delivered', [
                        'orderCode' => $this->order->order_code,
                        'customerName' => $this->order->name
                    ]);
                }
                break;
            case Order::CANCEL_STATUS:
                if ($this->forAdmin) {
                    $this->message = __('notifications.orders.admin_cancel', [
                        'orderCode' => $this->order->order_code,
                        'customerName' => $this->order->name
                    ]);
                } else {
                    $this->message = __('notifications.orders.member_cancel', [
                        'orderCode' => $this->order->order_code
                    ]);
                }
                break;
            default:
                break;
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    /* public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    } */

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'link' => $this->link,
            'message' => $this->message,
            'for_admin' => $this->forAdmin,
            'time' => Carbon::parse($this->order->updated_at)->format('d-m-Y H:i:s')
        ];
    }
}
