Weather and Navigation Application
Overview

This Skycast and Navigation Application fetches and displays weather information for any searched city using the OpenWeatherMap API. It also integrates Google Maps to provide navigation support and nearby places of interest such as restaurants and hotels. The app is designed to cater to travelers by offering essential information and tools for their journey.
Features

    Displays current weather information for any searched city.
    Provides a detailed map of the destination using Google Maps.
    Highlights nearby places such as restaurants, hotels, and attractions.
    Allows users to navigate and explore their destination with ease.

APIs Used
OpenWeatherMap API

    Base URL: https://api.openweathermap.org/data/2.5
        Endpoints Used:
            GET /weather - Fetches current weather for a specific city.

Google Maps API

    Base URL: Google Maps JavaScript API
        Features Used:
            Geocoding to display a map of the searched city.
            Places API to list nearby restaurants, hotels, and attractions.

Installation Instructions

    Clone the repository:

git clone https://github.com/charsey/SkyCast.git
cd weather-navigation-app

Set up environment variables:

    Create a .env file in the root directory and add your API keys as follows:

        OPENWEATHER_API_KEY=http://openweathermap.org/img/wn/${item.weather[0].icon}@2x.png
        GOOGLE_API_KEY=https://maps.googleapis.com/maps/api/js?key=AIzaSyAaKIfZZOAmH5jo8IRf5Sf1q7qNmX1XwR8&libraries=places

        You can obtain your OpenWeatherMap API key by signing up here and your Google Maps API key here.

    Install dependencies:
        The application runs purely on HTML, CSS, and JavaScript, so no additional dependencies are needed.

    Run the application locally:
        Open the index.html file in your browser to start the app.

Deployment

The application is deployed on two web servers with a load balancer for better scalability and performance.
1. Web Servers Deployment

    The app is deployed on the following servers:
        Web01: http://54.221.165.253:3000
        Web02: http://54.90.134.12:3000

2. Load Balancer Configuration

    A load balancer (Lb01) is set up to distribute traffic evenly between the two web servers.
    Load Balancer URL: 	52.201.67.1:3000

Steps to configure the load balancer:

    Set up the load balancer to forward requests to Web01 and Web02.
    Use the round-robin algorithm to ensure even distribution of traffic.

How the Application Works
1. Fetching Weather Data

    When a user searches for a city, the app fetches the current weather data using the /weather endpoint:

    const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${OPENWEATHER_API_KEY}&units=metric`;

    The app displays the temperature, weather condition, humidity, and wind speed.

2. City Map

    The app uses Google Maps to display a detailed map of the destination city.
    The map is centered on the location retrieved via Google Maps' Geocoding service.

3. Nearby Places

    Nearby restaurants, hotels, and attractions are fetched using Google Places API and displayed in a list format:

    const request = {
        location: destinationLocation,
        radius: 5000,
        type: ["restaurant", "lodging"],
    };
    service.nearbySearch(request, handlePlaces);

How to Access the Application

    Web Server 1: http://54.221.165.253:3000
    Web Server 2: http://54.90.134.12:3000
    Load Balancer: http://52.201.67.1:3000

Demo Video

A demo video is available showcasing the following:

    How to search for weather information.
    How to view maps and navigate around a destination.
    How to access the application through the load balancer.

Demo Video Link: (https://www.loom.com/share/6626fcfa94ea481897cf200fda4c4112)
Challenges Faced

    Handling API Rate Limits:
        Both OpenWeatherMap and Google Maps APIs have rate limits, requiring efficient management of requests.

    Map Integration:
        Displaying dynamic maps and ensuring accurate geolocation required careful configuration of the Google Maps API.

    Server Deployment:
        Configuring the load balancer to seamlessly distribute traffic between the two servers was a key challenge.