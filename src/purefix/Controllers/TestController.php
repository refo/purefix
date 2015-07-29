<?php

namespace Purefix\Controllers;

class TestController extends Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function getPartial()
    {
        $list = [
            ['id' => 1, 'title' => 'Lorem'],
            ['id' => 2, 'title' => 'Ipsum'],
            ['id' => 3, 'title' => 'Dolor'],
            ['id' => 4, 'title' => 'Sit Amet'],
        ];
        
        
        $hb = $this->hb;
        return $hb('partial/test', [
            'list' => $list,
            'meta' => ['title' => 'Hey !'],
        ]);
        //return $hb->render('partial/test', ['list' => $list]);
    }

    public function getImport()
    {
        $dir    = __DIR__.'/../import';
        $source = require($dir.'/products.php');

        foreach($source as $s)
        {
            set_time_limit(200);
            $this->importProduct($dir, $s);
        }

        return 'OK';

    }

    private function importProduct($dir, $local)
    {
        // create folder if not exsits
        $dir = $this->createFolder($dir, $local);

        $dataRemoteFile = $dir.'/data-remote.json';

        if (file_exists($dataRemoteFile))
        {
            $remote = json_decode(file_get_contents($dataRemoteFile), TRUE);
        } else {
            $remote = $this->fetchAndParse($local['url']);
            if ($remote !== null) {
                file_put_contents($dataRemoteFile, $remote);
            }
        }

        file_put_contents($dir.'/data-local.json', json_encode($local));

        // fetch and store images and main image
        $this->saveImages($dir, $remote);

        return $remote;
    }

    private function saveImages($dir, $remote)
    {
        $images = [];

        $images[] = $remote['product']['image']['src'];

        foreach($remote['product']['images'] as $image)
        {
            $images[] = $image['src'];
        }

        $dir = $dir . '/images';
        if ( ! is_dir($dir)) {
            mkdir($dir, 0766, TRUE);
        }

        foreach($images as $idx => $src)
        {
            $filepath = sprintf('%s/image-%d.jpg', $dir, $idx);
            
            if ( ! file_exists($filepath)) {
                try {
                    file_put_contents($filepath, fopen($src, 'r'));
                } catch (\Exception $e) {
                    // silently continue
                }                
            }

        }

    }

    private function createFolder($basedir, $local)
    {
        $basedir = $basedir . '/products';
        $dir = $basedir . '/' . $local['collection'] . '-' . $local['title'];
        if ( ! is_dir($dir) ) {
            mkdir($dir, 0766, TRUE);
        }
        return realpath($dir);
    }

    private function fetchAndParse($url)
    {
        $url = parse_url($url);
        $url = sprintf('%s://%s%s.json', $url['scheme'], $url['host'], $url['path']);   
        try {
            $jsonString = file_get_contents($url);
            $obj = json_decode($jsonString, TRUE);
        } catch (\Exception $e) {
            $obj =  NULL;
        }

        return $obj;

    }

}



