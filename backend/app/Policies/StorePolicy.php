<?php

namespace App\Policies;

use App\Models\Store;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StorePolicy {
    use HandlesAuthorization;

    public function view(User $user, Store $record): bool {
        return $user->id === $record->user_id;
    }

    public function update(User $user, Store $record): bool {
        return $this->view($user, $record);
    }

    public function delete(User $user, Store $record): bool {
        return $this->view($user, $record);
    }
}
