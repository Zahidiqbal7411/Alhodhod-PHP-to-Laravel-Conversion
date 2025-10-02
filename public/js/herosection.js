 // Create stars
  const starField = document.getElementById('starField');
  for (let i = 0; i < 150; i++) {
    const star = document.createElement('div');
    star.classList.add('star');
    const size = Math.random() * 2 + 1;
    star.style.width = `${size}px`;
    star.style.height = `${size}px`;
    star.style.left = `${Math.random() * 100}%`;
    star.style.top = `${Math.random() * 100}%`;
    star.style.setProperty('--opacity', Math.random());
    star.style.setProperty('--duration', `${Math.random() * 3 + 2}s`);
    star.style.animationDelay = `${Math.random() * 5}s`;
    starField.appendChild(star);
  }

  // Create particles
  const particleContainer = document.getElementById('particleContainer');
  for (let i = 0; i < 50; i++) {
    const particle = document.createElement('div');
    particle.classList.add('particle');
    const size = Math.random() * 3 + 1;
    particle.style.width = `${size}px`;
    particle.style.height = `${size}px`;
    particle.style.left = `${Math.random() * 100}%`;
    particle.style.bottom = `-10px`;
    particle.style.setProperty('--random-x', `${(Math.random() - 0.5) * 100}px`);
    particle.style.animationDuration = `${Math.random() * 10 + 5}s`;
    particle.style.animationDelay = `${Math.random() * 5}s`;
    particleContainer.appendChild(particle);
  }