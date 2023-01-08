<?php

// src/Controller/OpenWeather.php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OpenWeatherController extends AbstractController
{
    #[Route('/meteo/infometeo')]
    public function infometeo():Response
    {
        $city_name = 'Lille';
        $api_key = '50ede9c54c057c8644fa8688848379a1';
        $lat = 48.856614;
        $lon = 2.3522219;
        $api_url = "https://api.openweathermap.org/data/2.5/weather?q=".$city_name."&appid=".$api_key;
        
        $weather_data = json_decode(file_get_contents($api_url), true) ;
        
        $temperature = $weather_data['weather'][0]['main'];
        $degree = $weather_data['main']['temp'];
        
        $celsius = round($degree - 273.15);
        return $this->render('infometeo.html.twig', [
            'city_name' => $city_name,
            'temperature' => $temperature,
            'celsius' => $celsius,
        ]);
    }
}