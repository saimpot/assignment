<?php

namespace App\Domain\Cart\Repositories;

use App\Domain\Cart\Models\CartItem;
use Illuminate\Database\Eloquent\Collection;

class CartItemRepository implements CartItemRepositoryInterface
{
    protected CartItem $cartItemModel;

    public function __construct(CartItem $cartItemModel)
    {
        $this->cartItemModel = $cartItemModel;
    }

    public function getById(int $id): ?CartItem
    {
        return $this->cartItemModel->find($id);
    }

    public function update(CartItem $cartItem): CartItem
    {
        $cartItem->save();

        return $cartItem;
    }

    public function save(CartItem $cartItem): CartItem
    {
        $cartItem->save();

        return $cartItem;
    }

    public function getAll(): Collection
    {
        return $this->cartItemModel->all();
    }

    public function getByGuestCartId(string $guestCartId)
    {
        return $this->cartItemModel->where('guest_cart_id', $guestCartId)->get();
    }

    public function getByUserId(string $userId): Collection
    {
        return $this->cartItemModel->where('user_id', $userId)->get();
    }

    public function deleteByGuestCartAndCartItemId(string $guestCartId, int $cartItemId): void
    {
        $this->cartItemModel->where('guest_cart_id', $guestCartId)->where('product_id', $cartItemId)->delete();
    }

    public function delete(CartItem $cartItem): void
    {
        $cartItem->delete();
    }

    public function deleteByUserAndCartItemId(int $userId, int $cartItemId): void
    {
        $this->cartItemModel->where('user_id', $userId)->where('product_id', $cartItemId)->delete();
    }
}
