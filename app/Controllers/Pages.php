<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Skawan',
            'test' => ['satu', 'dua', 'tiga']
        ];
        return view('pages/index', $data);
    }
    public function about()
    {
        $data = [
            'title' => 'About Me'
        ];
        return view('pages/about', $data);
    }
    public function contact()
    {
        $data = [
            'title' => 'Contact Us',
            'alamat' => [
                [
                    'tipe' => 'Rumah',
                    'jalan' => 'Jl. Kenangan No 25',
                    'kota' => 'Sragen'
                ],
                [
                    'tipe' => 'Kantor',
                    'jalan' => 'Jl. Masalalu N0 25',
                    'kota' => 'Sragen'
                ]
            ]
        ];
        return view('pages/contact', $data);
    }
}
