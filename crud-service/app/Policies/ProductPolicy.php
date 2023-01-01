<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy {
    use HandlesAuthorization;

    public function view(User $user, Product $record): bool {
        return $user->id === $record->user_id;
    }

    public function update(User $user, Product $record): bool {
        return $this->view($user, $record);
    }

    public function delete(User $user, Product $record): bool {
        return $this->view($user, $record);
    }
}
