<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather and Places Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Google Places API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaKIfZZOAmH5jo8IRf5Sf1q7qNmX1XwR8&libraries=places"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="container">
            <div class="user-info">
                <img src="img/user.png" alt="Profile Picture" class="profile-pic">
                <span class="username">{{ Auth::user()->name }}</span>
            </div>
        </div>



        <div class="container">
            <div class="user-info">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                <button class="logout-button">Logout  <i class="fa fa-sign-out"></i></button>
                </form>
            </div>
        </div>

    </nav>

    <!-- Main Content -->
    <div id="app">
        <div class="search-container">
            <input type="text" id="cityInput" placeholder="Enter city name" />
            <button id="searchButton">Get Weather and Places</button>
        </div>

        <div id="currentWeather" class="weather-section hidden">
            <div id="currentWeatherData"></div>
        </div>

        <div id="forecast" class="weather-section hidden">
            <div id="forecastData" class="forecast-grid"></div>
        </div>

        <div id="places" class="hidden">
            <h2>Nearby Places of Interest</h2>
            <div id="placesData" class="places-grid"></div>
        </div>
        
    </div>

    <script src="script.js"></script>
</body>
</html>

<style>
/* General Reset */
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    color: #333;
}

/* Navigation Bar */
.navbar {
    background-color: #007BFF;
    padding: 10px 20px;
    color: white;
    display: flex;
    justify-content: space-between; /* Space between brand and user-info */
    align-items: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.navbar .brand {
    font-size: 20px;
    font-weight: bold;
    color: white;
    text-decoration: none;
}

/* User Info in Navbar */
.user-info {
    display: flex;
    align-items: center;
    gap: 10px; /* Space between profile picture, name, and logout button */
    position: relative;
    padding-left: 20;
}

.profile-pic {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid white;
}

.username {
    font-size: 16px;
    font-weight: bold;
}

.logout-button {
    background-color: white;
    color: #007BFF;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    cursor: pointer;
    font-size: 14px;
}

.logout-button:hover {
    background-color: #f4f4f9;
}

/* App Container */
#app {
    max-width: 800px;
    margin: 50px auto;
    padding: 20px;
    text-align: center;
    background: white;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Search Section */
.search-container {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-bottom: 30px;
}

input {
    padding: 10px;
    width: 60%;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
}

button {
    padding: 10px 20px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

/* Weather Sections */
.weather-section {
    text-align: left;
    margin-top: 20px;
}

.hidden {
    display: none;
}

.forecast-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 10px;
}

.forecast-card {
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 10px;
    border-radius: 5px;
    text-align: center;
}

.forecast-card img {
    width: 50px;
}
    </style>