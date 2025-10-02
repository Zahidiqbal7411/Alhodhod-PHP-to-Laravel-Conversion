// Profile Dropdown Toggle
document.getElementById('profileMenu').addEventListener('click', function() {
    this.classList.toggle('open');
  });

  // Close dropdown when clicking outside
  document.addEventListener('click', (e) => {
    if (!profileMenu.contains(e.target)) {
      profileMenu.classList.remove('open');
    }
  });

  // Create star burst rays
  function createStarBurst() {
    const starBurst = document.getElementById('starBurst');
    const numberOfRays = 12;
    
    for (let i = 0; i < numberOfRays; i++) {
      const ray = document.createElement('div');
      ray.className = 'burst-ray';
      ray.style.transform = `rotate(${(360 / numberOfRays) * i}deg)`;
      starBurst.appendChild(ray);
    }
  }

  // Create floating particles
  function createParticles() {
    const container = document.getElementById('particleContainer');
    const numberOfParticles = 30;
    
    for (let i = 0; i < numberOfParticles; i++) {
      const particle = document.createElement('div');
      particle.className = 'particle';
      
      // Random position
      particle.style.left = Math.random() * 100 + '%';
      particle.style.top = Math.random() * 100 + '%';
      
      // Random movement direction
      const angle = Math.random() * Math.PI * 2;
      const distance = Math.random() * 50 + 50;
      const x = Math.cos(angle) * distance;
      const y = Math.sin(angle) * distance;
      particle.style.setProperty('--x', x + 'px');
      particle.style.setProperty('--y', y + 'px');
      
      // Random animation duration and delay
      particle.style.animationDuration = (Math.random() * 2 + 3) + 's';
      particle.style.animationDelay = (Math.random() * 2) + 's';
      
      container.appendChild(particle);
    }
  }

  // Create animated stars with enhanced effects
  function createStars() {
    const starField = document.getElementById('starField');
    const numberOfStars = 50;
    
    for (let i = 0; i < numberOfStars; i++) {
      const star = document.createElement('div');
      star.className = 'star';
      
      // Random position
      star.style.left = Math.random() * 100 + '%';
      star.style.top = Math.random() * 100 + '%';
      
      // Random size
      const size = Math.random() * 3 + 1;
      star.style.width = size + 'px';
      star.style.height = size + 'px';
      
      // Random animation delay and duration
      const delay = Math.random() * 3;
      const duration = Math.random() * 2 + 2;
      star.style.animationDelay = delay + 's';
      star.style.animationDuration = duration + 's';
      
      starField.appendChild(star);
    }
  }

  // Initialize all effects
  createStarBurst();
  createParticles();
  createStars();


   