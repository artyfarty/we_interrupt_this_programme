<?php


namespace App\Repositories;

use App\Models\QueueElement;

class QueueRepository {
    /**
     * @return QueueElement
     */
    public function now() {
        $now = date_create()->format("Y-m-d H:i:s");

        return QueueElement::all()
            ->where("was_displayed", "=", "0")
            ->where("display_at", "<=", $now)
            ->sortBy("display_at")
            ->first();
    }
    /**
     * @return QueueElement
     */
    public function next() {
        return QueueElement::all()
            ->where("was_displayed", "=", "0")
            ->sortBy("display_at")
            ->first();
    }
}
