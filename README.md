# Running Laravel App Localy

1. Clone the project
2. cd on the project -> **"cd laravel-google-calendar"**
3. Install Dependencies
   ```
   composer install
   ```
4. Copy the .env File
   ```
   cp .env.example .env
   ```
5. Generate Application Key
   ```
   php artisan key:generate
   ```
6. Setup Environment Variables
7. Start Laravel Sail (using Docker)
   ```
   ./vendor/bin/sail up -d
   ```
8. Compile Frontend Assets
   ```
   npm install && npm run dev
   ```

# Enabling Google Calendar API in Laravel

This guide will walk you through setting up Google Calendar API in your Laravel app using OAuth 2.0 authentication.

## Prerequisites
- A Google Cloud project
- Laravel 12 installed
- Laravel Socialite configured for Google authentication
- Composer installed

## Step 1: Enable Google Calendar API
1. Go to the [Google Cloud Console](https://console.cloud.google.com/)
2. Select your project or create a new one
3. Navigate to **"APIs & Services" → "Library"**
4. Search for **Google Calendar API**
5. Click **"Enable"**

## Step 2: Create OAuth Credentials
1. Go to **"APIs & Services" → "Credentials"**
2. Click **"Create Credentials" → "OAuth 2.0 Client ID"**
3. Choose **"Web Application"**
4. Set the authorized redirect URIs:
   - `http://localhost/login/google/callback`
5. Click **"Create"**
6. Download the **JSON credentials file**

## Step 3: Store Credentials Securely
Instead of hardcoding the JSON file in your app, use **.env variables**:

1. Open the downloaded JSON file and extract these values:
   ```json
   {
     "client_id": "YOUR_CLIENT_ID",
     "client_secret": "YOUR_CLIENT_SECRET",
     "redirect_uris": ["YOUR_REDIRECT_URI"]
   }
   ```
2. Add these values to your `.env` file:
   ```env
   GOOGLE_CLIENT_ID=your-client-id
   GOOGLE_CLIENT_SECRET=your-client-secret
   GOOGLE_REDIRECT_URI=http://localhost/login/google/callback
   ```
3. Add Google Calendar Scopes to your `.env` file:
   ```env
   GOOGLE_CALENDAR_SCOPES=https://www.googleapis.com/auth/calendar
   ```