<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    protected $fillables = [
        'company',
        'price',
    ];

    protected $filename = 'file.csv';

    public function index()
    {
        // request()->merge(['page' => 12]);
        // dd(request()->page ?? 1);
        // dd(request());
        $data = $this->list();
        return $data;
    }

    public function store()
    {
        $data = [
            ['Google Inc.', '800'],
            ['Apple Inc.', '500'],
            ['Amazon.com Inc.', '250'],
            ['Yahoo! Inc.', '250'],
            ['Facebook, Inc.', '30'],
        ];
        $this->create($data);
        return $data;
    }

    function list()
    {
        $file = fopen(storage_path('app/' . $this->filename), 'r');
        if ($file === false) {
            dd('Error opening the file ' . $this->filename);
        }
        $data  = [];
        while ($row = fgetcsv($file)) {
            $data[] = $row;
        }
        return $data;
    }

    function create($data)
    {
        $file = fopen(storage_path('app/' . $this->filename), 'a');
        if ($file === false) {
            dd('Error opening the file ' . $this->filename);
        }
        foreach ($data as $row) {
            fputcsv($file, $row);
        }
        fclose($file);
    }
}
