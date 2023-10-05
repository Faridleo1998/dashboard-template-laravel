<?php

namespace App\Helpers;

trait ToastNotificationTrait
{
    public function created(string $nameItem, bool $isFemale = false): array
    {
        return [
            'toast_message' => $isFemale ? $nameItem.' creada' : $nameItem.' creado',
        ];
    }

    public function updated(string $nameItem, bool $isFemale = false): array
    {
        return [
            'toast_message' => $isFemale ? $nameItem.' actualizada' : $nameItem.' actualizado',
        ];
    }

    public function deleted(string $nameItem, bool $isFemale = false): array
    {
        return [
            'toast_message' => $isFemale ? $nameItem.' eliminada' : $nameItem.' eliminado',
            'toast_icon' => 'trash',
            'toast_type' => 'danger',
        ];
    }

    public function custom(string $message, string $icon = 'check', string $type = 'success'): array
    {
        return [
            'toast_message' => $message,
            'toast_icon' => $icon,
            'toast_type' => $type,
        ];
    }
}
