<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use anlutro\LaravelSettings\Facade as Setting;

class SetWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $apiKey = "a019f9d1e84dd9ef9abb91db252d4c20";

        $openWeather = ['api_key' => $apiKey];

        $ids = ['727011' => 'Sofia', '728193' => 'Plovdiv', '726050' => 'Varna'];

        foreach ($ids as $id => $location) {
            $base_url = "https://api.openweathermap.org/data/2.5";
            $weather_url = "/forecast/daily?cnt=7&lang=bg&units=metric&id=" . $id;
            $api_key = "&appid={$openWeather['api_key']}";
            $api_url = $base_url . $weather_url . $api_key;
            $data = json_decode(file_get_contents($api_url));

            $weather = $data->list;

            $arr = [];

            foreach ($weather as $k => $w) {
                $t[$k] = $w->weather;

                $arr[$k] = [
                    'day' => date("D", $w->dt),
                    'temperature' => $w->temp->day,
                    'description' => $t[$k][0]->description,
                    'icon' => $t[$k][0]->icon
                ];
            }

            $myJSON = json_encode($arr);

            Setting::set($location, $myJSON);
            //Setting::set($id, $myJSON);
            Setting::save();
        }
    }
}
