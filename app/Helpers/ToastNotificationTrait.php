<?php

namespace App\Helpers;

trait ToastNotificationTrait
{
    public function created($isFemale = false)
    {
        return [
            'toast_message' => $isFemale ? 'Creada con éxito.' : 'Creado con éxito',
        ];
    }

    public function updated($isFemale = false)
    {
        return [
            'toast_message' => $isFemale ? 'Actualizada con éxito' : 'Actualizado con éxito',
        ];
    }

    public function deleted($isFemale = false)
    {
        return [
            'toast_message' => $isFemale ? 'Eliminada con éxito' : 'Eliminado con éxito',
            'toast_icon' => 'trash',
            'toast_type' => 'danger',
        ];
    }

    public function custom($message, $icon = 'check', $type = 'success')
    {
        return [
            'toast_message' => $message,
            'toast_icon' => $icon,
            'toast_type' => $type,
        ];
    }
}
