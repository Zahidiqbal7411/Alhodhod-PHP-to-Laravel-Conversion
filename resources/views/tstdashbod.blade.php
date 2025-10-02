@extends('layouts.app')

@section('Main-content')
<!-- Welcome Heading -->
<h1 class="welcome-heading">
  Welcome Admin <span>Dashboard</span>
</h1>

<!-- Hero Section -->
<section class="hero">
  
    <div class="islamic-pattern"></div>
    <div class="star-field" id="starField"></div>
    <div class="geometric-overlay"></div>
    <div class="light-effects"></div>
    <div class="star-burst-container">
      <div class="star-burst" id="starBurst"></div>
    </div>
    <div class="particle-container" id="particleContainer"></div>
    <div class="hero-content">
      <div class="hero-icon">
        <i class="fas fa-moon"></i>
      </div>
      <h2>ISLAMIC DREAMS INTERPRETATION</h2>
      <p>BECAUSE YOUR DREAMS ARE MEANINGFUL!</p>
      <div class="hero-buttons">
        <button class="cta-button primary">
          <i class="fas fa-book-open"></i>
          Explore Dreams
        </button>
        <button class="cta-button secondary">
          <i class="fas fa-video"></i>
          Watch Guide
        </button>
      </div>
    </div>
  </section>

@endsection