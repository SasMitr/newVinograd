<?php

namespace App\Console\Commands;

use App\Models\Blog\Post;
use Illuminate\Console\Command;

class YandexMetricAPI extends Command
{
    protected $signature = 'metric:start';

    public function handle()
    {
        $token = 'AgAAAAAG6A33AAYBULcb3tP6V09YkgVZ5gweOaU';

        $params = array(
            'ids'     => 'Номер счетчика', // 54737767
            'metrics' => 'ym:s:visits,ym:s:pageviews,ym:s:users,ym:s:bounceRate,ym:s:pageDepth,ym:s:avgVisitDurationSeconds',
            'date1'   => 'today', // 7daysAgo - неделя, 30daysAgo - месяц, 365daysAgo - год
            'date2'   => 'today',
        );

        $ch = curl_init('https://api-metrika.yandex.net/stat/v1/data/bytime?' . urldecode(http_build_query($params)));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: OAuth ' . $token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $res = curl_exec($ch);
        curl_close($ch);

        $metrikaRequest = json_decode($res, true);



//        $options = [
//            'http' => [
//                'method' => 'GET',
//                'header' => [
//                    'Content-Type: application/x-yametrika+json',
//                    "Authorization: OAuth AgAAAAAG6A33AAYBULcb3tP6V09YkgVZ5gweOaU"
//                ]
//            ]
//        ];
//
//        $url = 'https://api-metrika.yandex.ru/stat/v1/data?';
//        $url .= '&ids=54737767';
//        $url .= '&metrics=ym:pv:pageviews,ym:pv:users';
//        $url .= '&dimensions=ym:pv:URLHash';
//        $url .= '&date1=2019-01-01';
//        $url .= '&date2=today';
//        $url .= '&accuracy=full';
//        $url .= '&limit=100000';
//        $url .= '&proposed_accuracy=false';
//
//        $metrikaRequest = file_get_contents($url, false, stream_context_create($options));

        if ( !empty($metrikaRequest) ) {

            $countPeopleView = json_decode($metrikaRequest, true)['data'];

            foreach ($countPeopleView as $value) {
                preg_match("~^https://vinograd-minsk.by/blog/(.+)\.html$~", $value['dimensions'][0]['name'], $matches);
                if ($matches && $value['metrics'][0] > 0){
                    Post::where('slug', $matches[1])->update(['view' => $value['metrics'][0]]);
                }
            }
        }
    }
}

/*
public function getAnalytics()
    {
        // 1. Извлекаем данные конфигурации
        $token = env('YANDEX_METRIKA_TOKEN');
        $counterId = env('YANDEX_METRIKA_COUNTER_ID');

        // 2. Делаем GET-запрос к API Метрики
        $response = Http::withHeaders([
            'Authorization' => 'OAuth ' . $token,
        ])->get('https://yandex.net', [
            'ids' => $counterId,
            'metrics' => 'ym:s:visits,ym:s:pageviews', // Метрики: визиты и просмотры
            'date1' => '7daysAgo',                     // Начальная дата
            'date2' => 'today',                         // Конечная дата
        ]);

        // 3. Обрабатываем ответ
        if ($response->successful()) {
            $data = $response->json();

            // Здесь будет массив с результатами
            return response()->json([
                'success' => true,
                'data' => $data['data'] ?? []
            ]);
        }

        // В случае ошибки
        return response()->json([
            'success' => false,
            'error' => $response->body()
        ], $response->status());
    }
 */

