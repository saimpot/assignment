<?php

namespace App\Domain\Cart\Services;

use App\Domain\Cart\Repositories\CartItemRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cookie;

class CartItemService implements CartItemServiceInterface
{
    private CartItemRepositoryInterface $cartItemRepository;

    public function __construct(CartItemRepositoryInterface $cartItemRepository)
    {
        $this->cartItemRepository = $cartItemRepository;
    }

    public function getAllCartItems(): Collection
    {
        if (auth()->check()) {
            return $this->cartItemRepository->getByUserId(auth()->id());
        }

        return $this->cartItemRepository->getByGuestCartId(Cookie::get('guest_cart_id'));
    }

    public function getTotalPrice(): float|int
    {
        $cartItems = $this->cartItemRepository->getAll();
        $totalPrice = 0;

        foreach ($cartItems as $cartItem) {
            $totalPrice += $cartItem?->product?->price * $cartItem->quantity;
        }

        return $totalPrice;
    }

    public function deleteCartItem(int $cartItemId): void
    {
        if (auth()->check()) {
            $this->cartItemRepository->deleteByUserAndCartItemId(auth()->id(), $cartItemId);
        }

        $this->cartItemRepository->deleteByGuestCartAndCartItemId(Cookie::get('guest_cart_id'), $cartItemId);
    }


    public function deleteAllCartItems(int $cartItemId): void
    {
        // TODO: Implement deleteAllCartItems() method.
    }
}
