<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use stdClass;
use ArrayObject;
class ScrapingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function scraping(){
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.americatv.com.pe/noticias/');
        // $styles = 'fluid-list item-grid';
        $styles = 'port-noti-img boxgrid';
        $array2 = new ArrayObject();
        $crawler->filter("[class='$styles']")->each(function ($node, $i) use($array2) {
            $noticia = new stdClass();
            $noticia->img = $node->filter('img')->eq(0)->attr('data-src');
            $noticia->url = $node->filter('a')->eq(0)->attr('href');
            $noticia->texto = $node->text();
            $array2->append($noticia);
        });
        $json = json_encode($array2);
        return $json;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
