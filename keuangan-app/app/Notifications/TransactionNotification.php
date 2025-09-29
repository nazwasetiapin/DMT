<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TransactionNotification extends Notification
{
    use Queueable;

    protected $transaction;

    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title'   => 'Transaksi Baru',
            'message' => 'Rp ' . number_format($this->transaction->amount, 0, ',', '.') 
                        . ' (' . $this->transaction->category->name . ') '
                        . ' ditambahkan oleh ' . ($this->transaction->user->name ?? ' Admin '),
            'url'     => url('/transactions/' . $this->transaction->id),
        ];
    }
}
