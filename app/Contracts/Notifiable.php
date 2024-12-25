<?php

namespace App\Contracts;

interface Notifiable
{
    /**
     * Implement this function to notify via Mail or SMS
     *
     * @param string $notificationAddress
     * @return void
     */
    public function notify(string $notificationAddress): void;
}
