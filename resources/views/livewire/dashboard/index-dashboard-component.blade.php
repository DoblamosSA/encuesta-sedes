@assets
<head>
  <style>
    :root {
      --power: 20;
      --default-rotate-x: 0;
      --default-rotate-y: 0;
      --default-rotate-z: 0;
      --perspective: 1000px;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    div {
      transform-style: preserve-3d;
    }

    body {
      position: relative;
      display: grid;
      place-items: center;
      height: 100vh;
      font-family: 'Barlow Semi Condensed', sans-serif;
      overflow: hidden;
    }

    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: radial-gradient(#968787, #ffffff, #ffffff);
      background-image: url('{{ asset('wallpaper.jpg') }}');
      background-position: center center;
      background-repeat: no-repeat;
      background-size: cover;
      filter: blur(5px);
      z-index: -2;
    }

    body::after {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.3);
      z-index: -1;
    }

    .container {
  position: relative;
  display: grid;
  grid-template-rows: repeat(21, 4.77vh);
  grid-template-columns: repeat(21, 4.77vw);
  transform-style: preserve-3d;
  cursor: zoom-in;
  z-index: 1;
  /* Add this to ensure it doesn't block */
  pointer-events: none;
}


    .container:active .monitor {
      transform: scale3d(2, 2, 2);
    }

    .monitor {
      position: absolute;
      z-index: 10;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      perspective: var(--perspective);
      transition: 1000ms;
    }

    .camera {
      position: absolute;
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      height: 100%;
      transition: 500ms;
    }

    .camera.-x {
      transform: rotateX(calc(var(--default-rotate-x) + 0deg));
    }

    .camera.-y {
      transform: rotateY(calc(var(--default-rotate-y) + 0deg));
    }

    .camera.-z {
      transform: rotateY(calc(var(--default-rotate-z) + 0deg));
    }

    /* Cube styles */
    .abc {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 200px;
      height: 200px;
      background: #000;
      color: #fff;
      font-family: 'Barlow Semi Condensed', sans-serif;
    }

    .cube .scale {
      transform: scale(1.2, 0.7);
    }

    .cube .surface {
      position: absolute;
      width: 200px;
      height: 200px;
      top: -100px;
      left: -100px;
      background: linear-gradient(-30deg, #333, #555);
      overflow: hidden;
    }

    .cube .surface::before {
      content: '';
      position: absolute;
      width: 300%;
      height: 300%;
      top: -150%;
      background: radial-gradient(closest-side, #fff 0%, #fff 20%, #333 100%);
      filter: blur(50px);
      transform: translateX(-100%);
      animation: refrection 10000ms ease-out infinite;
    }

    .cube .surface.-a {
      transform: rotateY(0deg) translateZ(100px);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .cube .surface.-a::before {
      animation-delay: -1000ms;
    }

    .cube .surface.-a img {
      width: 80%;
      height: auto;
      position: relative;
      z-index: 2;
    }

    .cube .surface.-b {
      transform: rotateY(180deg) translateZ(100px);
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .cube .surface.-b::before {
      animation-delay: 4000ms;
    }
    
    .cube .surface.-b img {
      width: 80%;
      height: auto;
      position: relative;
      z-index: 2;
    }

    .cube .surface.-c {
      transform: rotateY(90deg) translateZ(100px);
    }

    .cube .surface.-c::before {
      animation-delay: 1500ms;
    }

    .cube .surface.-d {
      transform: rotateY(-90deg) translateZ(100px);
    }

    .cube .surface.-d::before {
      animation-delay: 6500ms;
    }

    .cube .shadow {
      position: absolute;
      width: 200px;
      height: 200px;
      top: -100px;
      left: -100px;
      background: rgba(0, 0, 0, 0.6);
      filter: blur(30px);
      transform: rotateX(-90deg) translateZ(130px) scale(0.92);
    }

    .cube .rotate {
      animation: rotation 10000ms linear infinite;
    }

    /* Faces styles - Z-INDEX INCREASED */
    .faces-circle {
  position: absolute;
  width: 100%;
  bottom: 15%;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 10000;
  transform-style: flat; /* Prevents 3D space issues */
  /* Ensure pointer events work */
  pointer-events: auto;
}

.face {
  position: relative;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: #757368;
  border: 2px solid #ff9d00;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 24px;
  box-shadow: 0 0 15px rgba(255, 255, 0, 0.7);
  cursor: pointer;
  transition: transform 0.3s, box-shadow 0.3s;
  margin: 0 15px;
  z-index: 10100; /* Increased z-index */
  user-select: none;
  pointer-events: auto !important; /* Force pointer events */
  transform-style: flat; /* Prevents 3D space issues */
}

.monitor, .face, .start-survey-btn, .start-survey-btn button {
  pointer-events: auto;
}

    .face:hover {
      transform: scale(1.2) !important;
      box-shadow: 0 0 25px rgba(255, 255, 0, 0.9);
      z-index: 10200; /* Even higher z-index on hover */
    }

    .face.active {
      transform: scale(1.5) !important;
      box-shadow: 0 0 30px rgba(255, 255, 255, 0.9);
      animation: pulse 1s infinite alternate;
      z-index: 10200; /* Matching hover z-index */
    }

    .face-aura {
      position: absolute;
      width: 70px;
      height: 70px;
      border-radius: 50%;
      background: transparent;
      border: 2px solid rgba(255, 255, 0, 0.3);
      filter: blur(2px);
      animation: aura 3s infinite alternate;
      top: -5px;
      left: -5px;
      pointer-events: none; /* Ensures clicks go through to face */
    }

    .face span, 
    .face div {
      z-index: 10300; /* Higher z-index for face content */
      pointer-events: auto;
    }

    @keyframes pulse {
      0% {
        box-shadow: 0 0 25px rgba(255, 255, 0, 0.9);
      }
      100% {
        box-shadow: 0 0 40px rgba(255, 255, 255, 0.9);
      }
    }

    @keyframes aura {
      0% {
        transform: scale(1);
        opacity: 0.6;
      }
      100% {
        transform: scale(1.3);
        opacity: 0.2;
      }
    }

    @keyframes rotation {
      0% {
        transform: rotateY(0deg);
      }
      100% {
        transform: rotateY(-360deg);
      }
    }

    @keyframes refrection {
      0% {
        transform: translateX(-100%);
      }
      90% {
        transform: translateX(100%);
      }
      100% {
        transform: translateX(100%);
      }
    }

    /* Animations for volcano effect */
    .shake-animation {
      animation: shake 0.5s cubic-bezier(.36,.07,.19,.97) both;
    }

    @keyframes shake {
      0%, 100% {
        transform: translateX(0) translateY(0);
      }
      15% {
        transform: translateX(-8px) translateY(-5px);
      }
      30% {
        transform: translateX(8px) translateY(5px);
      }
      45% {
        transform: translateX(-8px) translateY(5px);
      }
      60% {
        transform: translateX(8px) translateY(-5px);
      }
      75% {
        transform: translateX(-5px) translateY(-3px);
      }
      85% {
        transform: translateX(5px) translateY(3px);
      }
    }

    .eruption-animation {
      animation: erupt 1.5s ease-out forwards;
    }

    @keyframes erupt {
      0% {
        transform: scale(1) translateY(0);
      }
      40% {
        transform: scale(1.2) translateY(-10px);
      }
      60% {
        transform: scale(1.4) translateY(-30px);
      }
      80% {
        transform: scale(1.2) translateY(-15px);
      }
      100% {
        transform: scale(1) translateY(0);
      }
    }

    .question-container {
  position: absolute;
  top: -200px;
  left: 50%;
  transform: translateX(-50%);
  padding: 20px;
  width: 80%;
  max-width: 600px;
  z-index: 200; /* Lower than faces */
  opacity: 0;
  transition: all 0.8s ease;
  
  /* Ensure no blocking of pointer events */
  pointer-events: none;
  
  /* Enhanced 3D Styles */
  perspective: 1000px;
  transform-style: preserve-3d;
}

    .question-container.active {
      top: 10%;
      opacity: 1;
      animation: float 6s ease-in-out infinite;
    }

    .question-inner {
      position: relative;
      padding: 30px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 16px;
      box-shadow: 
        0 10px 30px rgba(0, 0, 0, 0.3),
        0 0 15px rgba(255, 157, 0, 0.5);
      transform-style: preserve-3d;
      transform: translateZ(0);
      transition: transform 0.6s ease, box-shadow 0.6s ease;
      overflow: hidden;
    }

    .question-container.active .question-inner {
      animation: cardPulse 3s infinite alternate;
    }

    .question-text {
  font-size: 24px;
  text-align: center;
  color: #333;
  font-weight: 500;
  position: relative;
  z-index: 210; /* Lower than faces */
  pointer-events: auto; /* Allow interaction with text */
}

.question-inner, 
.corner, 
.glow, 
.particle-bg, 
.particle-star {
  pointer-events: none;
}
    .glow {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      border-radius: 16px;
      box-shadow: 0 0 60px rgba(255, 157, 0, 0.6);
      opacity: 0;
      z-index: 50; /* Lower than faces */
      animation: glowPulse 4s infinite alternate;
    }

    .corner {
      position: absolute;
      width: 20px;
      height: 20px;
      border-color: #ff9d00;
      z-index: 5; /* Lower than faces */
    }

    .corner-tl {
      top: 0;
      left: 0;
      border-top: 2px solid;
      border-left: 2px solid;
      border-top-left-radius: 8px;
    }

    .corner-tr {
      top: 0;
      right: 0;
      border-top: 2px solid;
      border-right: 2px solid;
      border-top-right-radius: 8px;
    }

    .corner-bl {
      bottom: 0;
      left: 0;
      border-bottom: 2px solid;
      border-left: 2px solid;
      border-bottom-left-radius: 8px;
    }

    .corner-br {
      bottom: 0;
      right: 0;
      border-bottom: 2px solid;
      border-right: 2px solid;
      border-bottom-right-radius: 8px;
    }

    .particle-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      opacity: 0.2;
      z-index: 0; /* Lower than faces */
    }

    .particle-star {
      position: absolute;
      background: #ff9d00;
      width: 3px;
      height: 3px;
      border-radius: 50%;
      animation: moveStar 15s linear infinite;
    }

    @keyframes float {
      0%, 100% {
        transform: translateX(-50%) translateY(0);
      }
      50% {
        transform: translateX(-50%) translateY(-15px);
      }
    }

    @keyframes cardPulse {
      0% {
        transform: translateZ(0) rotateX(0deg) rotateY(0deg);
      }
      25% {
        transform: translateZ(10px) rotateX(1deg) rotateY(-1deg);
      }
      50% {
        transform: translateZ(15px) rotateX(0deg) rotateY(1deg);
      }
      75% {
        transform: translateZ(10px) rotateX(-1deg) rotateY(0deg);
      }
      100% {
        transform: translateZ(0) rotateX(0deg) rotateY(0deg);
      }
    }

    @keyframes glowPulse {
      0% {
        opacity: 0.3;
        box-shadow: 0 0 30px rgba(255, 157, 0, 0.6);
      }
      50% {
        opacity: 0.6;
        box-shadow: 0 0 60px rgba(255, 157, 0, 0.8);
      }
      100% {
        opacity: 0.3;
        box-shadow: 0 0 30px rgba(255, 157, 0, 0.6);
      }
    }

    @keyframes moveStar {
      0% {
        transform: translateY(0) translateX(0);
      }
      100% {
        transform: translateY(100px) translateX(100px);
      }
    }
    /* Survey start button */
    .start-survey-btn {
      position: absolute;
      top: 75%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 300;
      text-align: center;
    }
    
    .start-survey-btn button {
      background: linear-gradient(135deg, #ff9d00, #ff4500);
      color: white;
      border: none;
      padding: 15px 30px;
      font-size: 20px;
      font-weight: bold;
      border-radius: 50px;
      cursor: pointer;
      box-shadow: 0 5px 15px rgba(255, 157, 0, 0.4);
      transition: all 0.3s ease;
      font-family: 'Barlow Semi Condensed', sans-serif;
    }
    
    .start-survey-btn button:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 20px rgba(255, 157, 0, 0.6);
    }
    
    .start-survey-btn button:active {
      transform: translateY(1px);
      box-shadow: 0 2px 10px rgba(255, 157, 0, 0.4);
    }

    /* Alpine.js transition styles */
    .transition {
      transition-property: opacity, transform;
      transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    }

    .ease-out {
      transition-timing-function: cubic-bezier(0, 0, 0.2, 1);
    }

    .ease-in {
      transition-timing-function: cubic-bezier(0.4, 0, 1, 1);
    }

    .duration-300 {
      transition-duration: 300ms;
    }

    .duration-700 {
      transition-duration: 700ms;
    }

    .transform {
      transform: translateX(var(--tw-translate-x)) translateY(var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y));
    }

    .translate-y-10 {
      --tw-translate-y: 2.5rem;
    }

    .translate-y-0 {
      --tw-translate-y: 0px;
    }

    .scale-90 {
      --tw-scale-x: 0.9;
      --tw-scale-y: 0.9;
    }

    .scale-100 {
      --tw-scale-x: 1;
      --tw-scale-y: 1;
    }

    .opacity-0 {
      opacity: 0;
    }

    .opacity-100 {
      opacity: 1;
    }

/* Make sure particles don't block clicks */
.particles {
  position: absolute;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: 150; /* Lower than faces */
}
    .particle {
      position: absolute;
      width: 10px;
      height: 10px;
      border-radius: 50%;
      background: linear-gradient(135deg, #ff9d00, #ff4500);
      pointer-events: none;
      opacity: 0;
    }
  </style>
</head>
@endassets
<div
    x-data="{
        activeIndex: -1,
        animationState: 'idle',
        questionVisible: false,
        currentQuestion: $wire.entangle('currentQuestion').live,
        surveyStarted: false,
        facesLocked: false,
        questions: [
            '¿Qué tan probable es que recomiende nuestra empresa a un amigo o colega?',
            '¿Qué tan satisfecho está con el servicio recibido?',
            '¿Qué tan satisfecho está con la atención recibida?',
        ],
        faces: [
            { id: 1, emoji: '😢', mood: 'Mala atención' },
            { id: 2, emoji: '🙁', mood: 'Puede mejorar' },
            { id: 3, emoji: '😐', mood: 'Neutral' },
            { id: 4, emoji: '🙂', mood: 'Satisfecho' },
            { id: 5, emoji: '😄', mood: 'Muy satisfecho' }
        ],
        startSurvey() {
            if (this.surveyStarted) return;
            this.surveyStarted = true;
            this.startAnimation();
        },
        
        startAnimation() {
            setTimeout(() => {
                this.animationState = 'shaking';
                this.createParticles();
                
                setTimeout(() => {
                    this.animationState = 'erupting';
                    
                    setTimeout(() => {
                        this.showRandomQuestion();
                        this.animationState = 'showing';
                        
                        
                        setTimeout(() => {
                            this.clearParticles();
                        }, 1000);
                    }, 2000);
                }, 2000);
            }, 1000);
        },
        
        showRandomQuestion() {
            this.currentQuestion = this.questions[Math.floor(Math.random() * this.questions.length)];
            this.questionVisible = true;
        },
        
        createParticles() {
            this.clearParticles();
            const container = document.querySelector('.particles');
            if (!container) return;
            
            const centerX = container.offsetWidth / 2;
            const centerY = container.offsetHeight / 2;
            
            for (let i = 0; i < 40; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Initial position near center
                const x = centerX + (Math.random() * 20 - 10);
                const y = centerY + (Math.random() * 20 - 10);
                
                particle.style.left = `${x}px`;
                particle.style.top = `${y}px`;
                
                // Configure animation for each particle
                const angle = Math.random() * Math.PI * 2;
                const distance = 50 + Math.random() * 200;
                const duration = 1 + Math.random() * 2;
                const size = 5 + Math.random() * 10;
                const endX = x + Math.cos(angle) * distance;
                const endY = y + Math.sin(angle) * distance;
                
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Apply animation with CSS
                const keyframes = `
                    @keyframes fly-${i} {
                        0% {
                            transform: translate(0, 0) scale(0.2);
                            opacity: 0;
                        }
                        10% {
                            opacity: 1;
                        }
                        70% {
                            opacity: 0.7;
                        }
                        100% {
                            transform: translate(${endX - x}px, ${endY - y}px) scale(0.1);
                            opacity: 0;
                        }
                    }
                `;
                
                const styleElement = document.createElement('style');
                styleElement.innerHTML = keyframes;
                document.head.appendChild(styleElement);
                
                particle.style.animation = `fly-${i} ${duration}s ease-out forwards`;
                particle.style.animationDelay = `${Math.random() * 0.5}s`;
                
                container.appendChild(particle);
            }
        },
        
        clearParticles() {
            const container = document.querySelector('.particles');
            if (container) {
                container.innerHTML = '';
            }
        },
        
        setActive(index) {
            // If faces are already locked, do nothing
            if (this.facesLocked) return;
            
            this.activeIndex = index;
            // Lock faces after click
            this.facesLocked = true;
            
            // Call wire function
            $wire.ClickAlternative(this.faces[index].id);
        }
    }"
     x-init="
        startSurvey();
        setInterval(() => { activeIcon = Math.floor(Math.random() * 3) }, 3000);       
    "
>
  <!-- Particle container -->
  <div class="particles"></div>
  
  <!-- Question container -->
  <div class="question-container" :class="{ 'active': questionVisible }">
    <div class="question-inner">
      <!-- Corner Accents -->
      <div class="corner corner-tl"></div>
      <div class="corner corner-tr"></div>
      <div class="corner corner-bl"></div>
      <div class="corner corner-br"></div>
      
      <!-- Glow Effect -->
      <div class="glow"></div>
      
      <!-- Particle Background -->
      <div class="particle-bg">
        <template x-for="i in 10">
          <div class="particle-star" 
               :style="`left: ${Math.random() * 100}%; top: ${Math.random() * 100}%; animation-delay: -${Math.random() * 15}s; animation-duration: ${15 + Math.random() * 10}s;`"></div>
        </template>
      </div>
      
      <!-- Question Text -->
      <p class="question-text" x-text="currentQuestion"></p>
    </div>
  </div>

  
  <div class="container">
    <!-- Faces in horizontal line (outside monitor) -->
    <div class="faces-circle" x-show="questionVisible" 
         x-transition:enter="transition ease-out duration-700"
         x-transition:enter-start="opacity-0 transform translate-y-10"
         x-transition:enter-end="opacity-100 transform translate-y-0">
      <template x-for="(face, index) in faces" :key="face.id">
        <div :class="['face', `face-${face.id}`, { 'active': activeIndex === index }]" 
             @click="setActive(index)">
          <div class="face-aura"></div>
          <span x-text="face.emoji" style="font-size: 36px; position: relative; z-index: 10300;"></span>
          <div style="position: absolute; top: -40px; background: rgba(43, 123, 214, 0.7); color: white; padding: 5px 10px; border-radius: 5px; font-size: 10.5px; z-index: 10400; white-space: nowrap;">
          <span x-text="face.mood"></span>
        </div>
          <div x-show="activeIndex === index" 
               x-transition:enter="transition ease-out duration-300"
               x-transition:enter-start="opacity-0 transform scale-90"
               x-transition:enter-end="opacity-100 transform scale-100"
               x-transition:leave="transition ease-in duration-300"
               x-transition:leave-start="opacity-100 transform scale-100"
               x-transition:leave-end="opacity-0 transform scale-90"
               style="position: absolute; top: -40px; background: rgba(43, 123, 214, 0.7); color: white; padding: 5px 10px; border-radius: 5px; font-size: 14px; z-index: 10400;">
            <span x-text="face.mood"></span>
          </div>
        </div>
      </template>
    </div>
    
    <div class="monitor" :class="{
      'shake-animation': animationState === 'shaking',
      'eruption-animation': animationState === 'erupting'
    }">
      <div class="camera -z">
        <div class="camera -y">
          <div class="camera -x">
            <!-- Original cube -->
            <div class="cube">
              <div class="scale">
                <div class="rotate">
                  <div class="surface -a">
                    <img src="https://www.doblamos.com/wp-content/uploads/2022/05/logo.png" alt="Doblamos logo">
                  </div>
                  <div class="surface -b">
                    <img src="https://www.doblamos.com/wp-content/uploads/2022/05/logo.png" alt="Doblamos logo">
                  </div>
                  <div class="surface -c"></div>
                  <div class="surface -d"></div>
                  <div class="shadow"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>