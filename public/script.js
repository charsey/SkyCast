// OpenWeatherMap API Key
const API_KEY = '0ec6b9c45459c64bb12934b30b23f330';
const BASE_URL = 'https://api.openweathermap.org/data/2.5';

// DOM Elements
const cityInput = document.getElementById('cityInput');
const searchButton = document.getElementById('searchButton');
const currentWeather = document.getElementById('currentWeather');
const forecast = document.getElementById('forecast');
const currentWeatherData = document.getElementById('currentWeatherData');
const forecastData = document.getElementById('forecastData');
const places = document.getElementById('places');
const placesData = document.getElementById('placesData');

// Initialize Google Places Autocomplete
let autocomplete;
function initializeAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(cityInput, {
        types: ['(cities)'],
    });
}
google.maps.event.addDomListener(window, 'load', initializeAutocomplete);

// Fetch current weather data
async function getCurrentWeather(city) {
    const url = `${BASE_URL}/weather?q=${encodeURIComponent(city)}&units=metric&appid=${API_KEY}`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            alert('City not found!');
            console.error('Error fetching current weather:', response.statusText);
            return null;
        }
        return await response.json();
    } catch (error) {
        console.error('Error fetching current weather:', error);
        alert('Error fetching weather data.');
        return null;
    }
}

// Fetch 5-day forecast data
async function getForecast(city) {
    const url = `${BASE_URL}/forecast?q=${encodeURIComponent(city)}&units=metric&appid=${API_KEY}`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            alert('City not found!');
            console.error('Error fetching forecast:', response.statusText);
            return null;
        }
        return await response.json();
    } catch (error) {
        console.error('Error fetching forecast data:', error);
        alert('Error fetching forecast data.');
        return null;
    }
}


// Display current weather data
function displayCurrentWeather(data) {
    if (!data) return;
    currentWeatherData.innerHTML = `
        <p><strong>City:</strong> ${data.name}</p>
        <p><strong>Temperature:</strong> ${data.main.temp}°C</p>
        <p><strong>Humidity:</strong> ${data.main.humidity}%</p>
        <p><strong>Weather:</strong> ${data.weather[0].description}</p>
        <img src="http://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png" alt="Weather icon" />
    `;
    currentWeather.classList.remove('hidden');
}

// Display 5-day forecast
function displayForecast(data) {
    if (!data) return;

    const filteredData = data.list.filter(item => item.dt_txt.includes('12:00:00'));
    forecastData.innerHTML = filteredData.map(item => `
        <div class="forecast-card">
            <p>${new Date(item.dt_txt).toDateString()}</p>
            <p><strong>Temp:</strong> ${item.main.temp}°C</p>
            <p><strong>Weather:</strong> ${item.weather[0].description}</p>
            <img src="http://openweathermap.org/img/wn/${item.weather[0].icon}@2x.png" alt="Weather icon" />
        </div>
    `).join('');
    forecast.classList.remove('hidden');
}

// Display nearby places
function displayPlaces(data) {
    if (!data) return;

    placesData.innerHTML = data.results.map(place => `
        <div class="place-card">
            <p><strong>Name:</strong> ${place.name}</p>
            <p><strong>Address:</strong> ${place.vicinity}</p>
        </div>
    `).join('');
    places.classList.remove('hidden');
}

// Event Listener
searchButton.addEventListener('click', async () => {
    const city = cityInput.value.trim();
    if (!city) {
        alert('Please enter a city name');
        return;
    }

    console.log('Fetching weather data for city:', city);
    const weatherData = await getCurrentWeather(city);
    displayCurrentWeather(weatherData);

    console.log('Fetching forecast data for city:', city);
    const forecastDataResponse = await getForecast(city);
    displayForecast(forecastDataResponse);

    if (weatherData) {
        const { lat, lon } = weatherData.coord;
        console.log(`Fetching places near latitude: ${lat}, longitude: ${lon}`);
        const placesDataResponse = await getPlaces(lat, lon);
        displayPlaces(placesDataResponse);
    }
});
