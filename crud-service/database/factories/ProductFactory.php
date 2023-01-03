<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory {
    public function definition() {
        $oldPrice = $this->faker->randomFloat(0, 100, 10000);
        $discount = $this->faker->numberBetween(1, 6) * 10;
        return [
            'name' => $this->faker->name(),
            'old_price' => $oldPrice,
            'price' => $oldPrice * $discount / 100,
            'amount' => $this->faker->numberBetween(0, 50),
            'image' => $this->getImage()
        ];
    }

    private function getImage() {
        $images = [
            'https://www.baltimoremagazine.com/wp-content/uploads/2019/05/square-meal-4.jpg',
            'https://media-cldnry.s-nbcnews.com/image/upload/t_fit-760w,f_auto,q_auto:best/newscms/2021_34/1765653/squareat-inline-02-khu-210825.png',
            'https://www.shutterstock.com/image-photo/homemade-square-belgian-waffles-fresh-260nw-654598555.jpg',
            'https://cdn.shopify.com/s/files/1/1574/5181/files/mealsquare3_480x480@2x.jpg?v=1613690158',
            'https://thumbs.dreamstime.com/z/gourmet-meal-2431449.jpg',
            'https://thumbs.dreamstime.com/z/breakfast-food-square-icon-set-sixteen-isolated-decorative-icons-meal-symbols-different-background-colour-shadows-80495704.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQZ3TdOsLEOaw221DS2cfG9GilML3wVgDViLA&usqp=CAU',
            'https://media-cdn.tripadvisor.com/media/photo-s/19/f1/38/b6/photo0jpg.jpg',
            'https://www.shutterstock.com/shutterstock/photos/441269839/display_1500/stock-vector-four-square-meal-tower-icon-set-with-descriptions-of-breakfast-fast-food-nutrition-and-sweets-441269839.jpg',
            'https://img.freepik.com/free-psd/american-food-square-flyer-template_23-2148477325.jpg?w=2000',
            'https://www.kansasbeef.org/Media/KSBeef/Images/sweet-potato-beef-mash-up-meal-square.jpeg?width=1120',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSu124U0U4GrOgSx2-nY6A8fA5DL-xKXGgwYg&usqp=CAU'
        ];
        return $images[array_rand($images)];
    }
}
