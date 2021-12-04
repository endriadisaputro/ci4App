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
            'penerbit' => 'required',
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar max: 1mb',
                    'is_image' => 'Yang anda upload bukan gambar',
                    'mime_in' => 'Yang anda upload bukan gambar',
                ]
            ]
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/comics/create')->withInput()->with('validation', $validation);
            return redirect()->to('/comics/create')->withInput();
        }

        // Ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        // Apakah tidak ada gambar yg dipuload
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'login.png';
        } else {
            // generate nama file
            $namaSampul = $fileSampul->getRandomName();
            // Pindahkan ke folder img
            $fileSampul->move('img', $namaSampul);
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->comicsData->save([
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);

        session()->setFlashdata('success', 'Data successfully to added..');
        return redirect()->to('/comics');
    }

    public function delete($id)
    {
        // cari gambar berdasarkan id
        $comic = $this->comicsData->find($id);
        // cek jika file gambarnya default
        if ($comic['sampul'] != 'login.png') {
            // hapus gambar
            unlink('img/' . $comic['sampul']);
        }

        $this->comicsData->delete($id);
        session()->setFlashdata('success', 'Data successfully to deleted..');
        return redirect()->to('/comics');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Edit Comic',
            'validation' => \Config\Services::validation(),
            'comic' => $this->comicsData->getComic($slug)
        ];
        return view('comics/edit', $data);
    }

    public function update($id)
    {
        //Cek judul
        $comicLama = $this->comicsData->getComic($this->request->getVar('slug'));
        if ($comicLama['title'] == $this->request->getVar('title')) {
            $rule_title = 'required';
        } else {
            $rule_title = 'required|is_unique[comics.title]';
        }
        // Validasi input
        if (!$this->validate([
            'title' => $rule_title,
            'penulis' => 'required',
            'penerbit' => 'required',
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar max: 1mb',
                    'is_image' => 'Yang anda upload bukan gambar',
                    'mime_in' => 'Yang anda upload bukan gambar',
                ]
            ]
        ])) {
            return redirect()->to('/comics/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $fileSampul = $this->request->getFile('sampul');

        // cek gambar, apakah tetap gambar lama
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            // generate nama file
            $namaSampul = $fileSampul->getRandomName();
            // Move gambar
            $fileSampul->move('img', $namaSampul);
            // hapus file yg lama
            unlink('img/' . $this->request->getVar('sampulLama'));
        }


        $slug = url_title($this->request->getVar('title'), '-', true);
        $this->comicsData->save([
            'id' => $id,
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul
        ]);
        session()->setFlashdata('success', 'Data successfully to edit..');
        return redirect()->to('/comics');
    }
}
