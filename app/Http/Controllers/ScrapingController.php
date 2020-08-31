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

    public function main(){
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.americatv.com.pe/noticias/');
        $styles = 'port-noti-img boxgrid';
        $array2 = new ArrayObject();
        $crawler->filter("[class='$styles']")->each(function ($node, $i) use($array2) {
            $new = new stdClass();
            $new->img = $node->filter('img')->eq(0)->attr('data-src');
            $new->url = $node->filter('a')->eq(0)->attr('href');
            $new->texto = $node->text();
            $array2->append($new);
        });
        $json = json_encode($array2);
        return $json;
    }
    public function detail(Request $request){
        $detailClient = new Client();
        $crawler = $detailClient->request('GET', $request->url);
        $article = new stdClass();
        $article->title = $crawler->filter("[id='txtlink']")->first()->text();
        $article->text = $crawler->filter("[class='bajada-text']")->first()->text();
        $article->long_text = $crawler->filter("[class='cont_p']")->first()->text();
        return json_encode($article);
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
