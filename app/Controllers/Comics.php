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
        // JIka komik tidak ada di tabel
        if (empty($data['comic'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Komik' . $slug . 'tidak ditemukan');
        }
        return view('comics/detail', $data);
    }

    public function create()
    {
        // session(); sudah di pindah ke base Controller
        $data = [
            'title' => 'Create new data',
            'validation' => \Config\Services::validation()
        ];
        return view('comics/create', $data);
    }

    public function save()
    {
        // Validasi input
        if (!$this->validate([
            'title' => 'required|is_unique[comics.title]',
            'penulis' => 'required',
            'penerbit' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/comics/create')->withInput()->with('validation', $validation);
        }
        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->comicsData->save([
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $this->request->getVar('sampul')
        ]);

        session()->setFlashdata('success', 'Data successfully to added..');
        return redirect()->to('/comics');
    }
}
