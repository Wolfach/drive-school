<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DriveSchoolController extends Controller
{
    public function index()
    {
        $categories = [
            ['letter' => 'A', 'title' => 'Мотоциклы', 'desc' => 'Категория A, A1, M', 'slug' => 'a'],
            ['letter' => 'B', 'title' => 'Легковые авто', 'desc' => 'Категория B, BE', 'slug' => 'b'],
            ['letter' => 'C', 'title' => 'Грузовые авто', 'desc' => 'Категория C, CE', 'slug' => 'c'],
            ['letter' => 'D', 'title' => 'Автобусы', 'desc' => 'Категория D, DE', 'slug' => 'd'],
        ];

        $instructors = [
            [
                'name' => 'Иванов Иван', 
                'exp' => 'Стаж 10 лет', 
                'rating' => 5,
                'car_img' => 'images/car1.jpg' // Путь к фото авто
            ],
            [
                'name' => 'Петров Петр', 
                'exp' => 'Стаж 7 лет', 
                'rating' => 4,
                'car_img' => 'images/car2.jpg'
            ],
            [
                'name' => 'Сидоров Сидор', 
                'exp' => 'Стаж 12 лет', 
                'rating' => 5,
                'car_img' => 'images/car3.jpg'
            ],
            [
                'name' => 'Смирнов Алексей', 
                'exp' => 'Стаж 5 лет', 
                'rating' => 5,
                'car_img' => 'images/car4.jpg'
            ],
        ];



        return view('drive-school', compact('categories', 'instructors'));
    }
}