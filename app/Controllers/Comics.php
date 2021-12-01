<?php

namespace App\Controllers;

use App\Models\ComicModel;

class Comics extends BaseController
{
    protected $comicsData;
    public function __construct()
    {
        $this->comicsData = new ComicModel();
    }
    public function index()
    {
        // $comics = $this->comicsData->findAll();
        $data = [
            'title' => 'Comics | Skawan',
            'comics' => $this->comicsData->getComic()
        ];
        return view('comics/index', $data);
    }

    public function detail($slug)
    {
        $data = [
            'title' => 'Detail | Skawan',
            'comic' => $this->comicsData->getComic($slug)
        ];
        return view('comics/detail', $data);
    }
}
