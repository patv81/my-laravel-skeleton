<?php 
namespace App\Helpers;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use PhpParser\Node\Stmt\TryCatch;

class Feed
{
    public static function readVNExpress($link){
        // https://vnexpress.net/rss/the-gioi.rss
        try {
            $rss = simplexml_load_file($link, 'SimpleXMLElement', LIBXML_NOCDATA);
            $arr = json_decode(json_encode((array)$rss), TRUE);
            $data = collect($arr['channel']['item'])->map(function ($post) {
                unset($post['guid']);
                $pattern1 = '/src="(.*?)" ><\/a>/i';
                $pattern2 = '/(\<\/br\>)(.*)/i';
                $temp1 = [];
                $temp2 = [];
                preg_match($pattern1, $post['description'], $temp1);
                preg_match($pattern2, $post['description'], $temp2);
                $post['thumb'] = $temp1[1]??'';
                $post['description'] = $temp2[2]??$post['description'];
                return $post;
            })->all();
                 
            return $data;
            
        } catch (\Throwable $th) {
            return [];
        }
    }
    public static function readTuoiTre($link)
    {
        try {
            $rss = simplexml_load_file($link, 'SimpleXMLElement', LIBXML_NOCDATA);
            $arr = json_decode(json_encode((array)$rss), TRUE);
            $data = collect($arr['channel']['item'])->map(function ($post) {
                unset($post['guid']);
                // $pattern1 = '/src="(.*?)" ><\/a>/i';
                $pattern1= '/src="(.*)" \/>/i';
                $pattern2 = '/<a (.*)<\/a>(.*)/i';
                $temp1 = [];
                $temp2 = [];
                preg_match($pattern1, $post['description'], $temp1);
                preg_match($pattern2, $post['description'], $temp2);
                
                // echo '<pre>' ;
                // print_r($post['description']); 
                // echo'</pre>';
                // die(123);
                $post['thumb'] = $temp1[1] ?? '';
                $post['description'] = $temp2[2] ?? $post['description'];
                return $post;
            })->all();
            return $data;
        } catch (\Throwable $th) {
            return [];
        }
    }
    public static function readThanhnien($link){
        try {
            $rss = simplexml_load_file($link, 'SimpleXMLElement', LIBXML_NOCDATA);
            $arr = json_decode(json_encode((array)$rss), TRUE);
            $data = collect($arr['channel']['item'])->map(function ($post) {
                unset($post['guid']);
                $pattern1 = '/src="(.*?)><\/a>/i';
                $pattern2 = '/<p>(.*)<\/p>/i';
                $temp1 = [];
                $temp2 = [];
                preg_match($pattern1, $post['description'], $temp1);
                preg_match($pattern2, $post['description'], $temp2);
                // echo '<pre>' ;
                // print_r($post['description']); 
                // echo'</pre>';
                // die(123);
                $post['thumb'] = $temp1[1] ?? '';
                $post['description'] = $temp2[1] ?? $post['description'];
                return $post;
            })->all();
            return $data;
        } catch (\Throwable $th) {
            return [];
        }
    }
    public static function checkSourceLink($source,$link){
        $sourceFromLink= explode('.',parse_url($link,PHP_URL_HOST))[0];
        
        return($source==$sourceFromLink);
    }
    public static function readGold(){
        $link= 'https://www.sjc.com.vn/xml/tygiavang.xml';
        $context = stream_context_create(array('ssl' => array(
            'verify_peer' => false,
            "verify_peer_name" => false
        )));

        libxml_set_streams_context($context);

        $arr = simplexml_load_file($link);

        // $rss = simplexml_load_file($link, 'SimpleXMLElement', LIBXML_NOCDATA);
        $arr = json_decode(json_encode((array)$arr), TRUE);
        $data=array_column($arr['ratelist']['city'][0]['item'], '@attributes');
        return $data;
    }

    public static function read($items){
        $re = [];
        foreach($items as $item){
            if(Feed::checkSourceLink($item['source'],$item['link'])){
                
                switch ($item['source']) {
                    case 'tuoitre':
                        $data = Feed::readTuoiTre($item['link']);
                        break;
                    case 'vnexpress':
                        $data = Feed::readVNExpress($item['link']);
                        break;
                    case 'thanhnien':
                        $data = Feed::readThanhnien($item['link']);
                        dd('eor');
                        break;
                    default:
                        $data=[];
                        dd('error');
                        
                }
                $re = array_merge_recursive($data,$re);
            }
        }
        return $re;
    }
    public static function readCoin(){
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
        $parameters = [
        'start' => '1',
        'limit' => '10',
        'convert' => 'USD'
        ];

        $headers = [
        'Accepts: application/json',
        'X-CMC_PRO_API_KEY: '.env('API_COINMARKETCAP')
        ];
        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL


        $curl = curl_init(); // Get cURL resource
        // Set cURL options
        curl_setopt_array($curl, array(
        CURLOPT_URL => $request,            // set the request URL
        CURLOPT_HTTPHEADER => $headers,     // set the headers 
        CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response = curl_exec($curl); // Send the request, save the response
        curl_close($curl); // Close request
        $data = json_decode($response,TRUE); 
        $data= $data["data"];
        
        $data = collect($data)
                ->map(function($item){
                    return [
                        'name'=>$item['name'],
                        'price'=> $item['quote']['USD']['price'],
                        'percent_change_24h'=>$item['quote']['USD']['percent_change_24h'],
                    ];
                })->all();
        return $data;
    }
}