<?php

use App\Livewire\Counter;
use App\Livewire\Dashboard\MediatorDashboardComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', MediatorDashboardComponent::class);
