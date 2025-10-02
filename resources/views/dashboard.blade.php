@extends('layouts.app')

@section('Main-content')
   
  @push('styles')

      <link rel="stylesheet" href="{{ asset('styling/herosectiondashbord.css') }}">
      
  @endpush
   
<!-- Welcome Heading -->
<h1 class="welcome-heading">
  Welcome Admin <span>Dashboard</span>
</h1>

<!-- Hero Section -->
<section class="hero">
  <div class="star-field" id="starField"></div>
  <div class="light-effects">
    <div class="light-orb" style="top: 20%; left: 10%;"></div>
    <div class="light-orb" style="top: 60%; left: 70%; animation-delay: 2s;"></div>
  </div>
  <div class="particle-container" id="particleContainer"></div>
  <div class="crescent-moon"></div>
  
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

   @push('script')
     <script src="{{asset('js/herosection.js')}}"></script>
   @endpush
   
@endsection
