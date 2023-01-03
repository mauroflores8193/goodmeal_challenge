<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory {
    public function definition() {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->paragraph(1),
            'location' => $this->faker->paragraph(1),
            'latitude' => $this->faker->randomFloat(10, -90, 90),
            'longitude' => $this->faker->randomFloat(10, -180, 180),
            'icon' => $this->getIcon(),
            'banner' => $this->getBanner(),
            'start_time' => $this->faker->time(),
            'end_time' => $this->faker->time()
        ];
    }

    private function getBanner() {
        $banners = [
            'https://cdn.pixabay.com/photo/2016/09/01/19/53/pocket-watch-1637396__340.jpg',
            'https://cdn.pixabay.com/photo/2015/12/06/09/15/maple-1079235__340.jpg',
            'https://cdn.pixabay.com/photo/2017/03/22/12/14/easter-nest-2164822__340.jpg',
            'https://cdn.pixabay.com/photo/2017/10/03/17/53/nature-2813487__340.jpg',
            'https://cdn.pixabay.com/photo/2015/10/11/11/20/banner-982162__340.jpg',
            'https://cdn.pixabay.com/photo/2016/03/14/16/10/banner-1255730__340.jpg',
            'https://cdn.pixabay.com/photo/2016/05/27/08/51/mobile-phone-1419275__340.jpg',
            'https://cdn.pixabay.com/photo/2018/06/07/09/01/emotions-3459666__340.jpg',
            'https://cdn.pixabay.com/photo/2017/07/23/16/01/nature-2531761__340.jpg',
            'https://cdn.pixabay.com/photo/2017/09/21/14/05/animals-2772006__340.jpg',
            'https://cdn.pixabay.com/photo/2016/03/07/10/32/color-1241879__340.jpg',
            'https://cdn.pixabay.com/photo/2016/09/04/20/14/sunset-1645103__340.jpg',
            'https://cdn.pixabay.com/photo/2017/04/11/15/55/animals-2222007__340.jpg',
            'https://cdn.pixabay.com/photo/2016/09/04/20/14/sunset-1645105__340.jpg',
            'https://cdn.pixabay.com/photo/2015/12/15/09/04/banner-1093909__340.jpg',
            'https://cdn.pixabay.com/photo/2016/03/06/17/39/banner-1240822__340.jpg'
        ];
        return $banners[array_rand($banners)];
    }

    private function getIcon() {
        $icons = [
            'https://www.shutterstock.com/image-vector/square-logo-design-vector-blue-260nw-706178086.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTp-bdZaY-8wXJXi_m4BjVC2L3new_7-_3WMA&usqp=CAU',
            'https://www.clipartmax.com/png/middle/334-3341544_black-square-logo-square-point-of-sale-logo.png',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTS6hha1D-5eYlQibkJ-T0HxgsGQ_TfXqCT7w&usqp=CAU',
            'https://images-platform.99static.com//5B84bLRYIYNZJT9PNX8tceHxlZs=/356x1092:930x1666/fit-in/590x590/projects-files/41/4116/411647/fa568b0e-fee0-4895-a6a7-f22dc0e1f5e7.png',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRF4mitZegM5djlD1bSaoI_klXEF4VNC2drlg&usqp=CAU',
            'https://www.creativefabrica.com/wp-content/uploads/2020/09/21/Modern-Square-Logo-Design-Graphics-5580883-1-580x386.jpg',
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSMgMFQE7744Ebt1v172DZe85QHbKfeb7FHDg&usqp=CAU',
            'https://www.designevo.com/res/templates/thumb_small/shape-square-abstract-friend.png',
            'https://99designs-blog.imgix.net/blog/wp-content/uploads/2018/10/attachment_57810318-e1539290902964.png?auto=format&q=60&fit=max&w=930',
            'https://www.shutterstock.com/image-vector/abstract-art-square-rhombus-logo-260nw-1911651898.jpg'
        ];
        return $icons[array_rand($icons)];
    }
}
