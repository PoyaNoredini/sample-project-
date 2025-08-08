<?php

use Illuminate\Support\Facades\Schedule;

// Schedule the story deactivation command to run every day
Schedule::command('stories:deactivate-expired')->daily();

// Alternative: run every 5 minutes for better performance
// Schedule::command('stories:deactivate-expired')->everyFiveMinutes();

// Alternative: run every hour
// Schedule::command('stories:deactivate-expired')->hourly();
