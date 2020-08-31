<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ArrayObject;
use stdClass;
use Goutte\Client;
class ScrapingController extends Controller
{
    public function main(){
        $client = new Client();
        $crawler = $client->request('GET','https://www.americatv.com.pe/noticias/');
        $styles = 'port-noti-img boxgrid';
        $array = new ArrayObject();
        $crawler->filter("[class='$styles']")->each(function ($node) use($array){
            $new = new stdClass();
            $new->img = $node->filter('img')->eq(0)->attr('data-src');
            $new->url = $node->filter('a')->eq(0)->attr('href');
            $new->texto = $node->text();
            $array->append($new);
        });
        $json = json_encode($array);
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
}
