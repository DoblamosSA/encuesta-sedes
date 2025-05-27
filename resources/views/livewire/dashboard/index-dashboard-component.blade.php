@assets
<head>
  <style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Barlow Semi Condensed', sans-serif;
    position: relative;
    overflow-x: hidden;
  }

  body::before {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(#968787, #ffffff, #ffffff);
    background-image: url('{{ asset("wallpaper.jpg") }}');
    background-position: center center;
    background-repeat: no-repeat;
    background-size: cover;
    filter: blur(5px);
    z-index: -2;
  }

  body::after {
    content: "";
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.1);
    z-index: -1;
  }

  .survey-container {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
    z-index: 1;
  }

  /* Main content row layout */
  .content-row {
    width: 100%;
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    margin-bottom: 60px;
  }

  /* Question container */
  .question-container {
    flex: 1;
    opacity: 0;
    transition: all 0.8s ease;
    perspective: 1000px;
    transform-style: preserve-3d;
  }

  .question-container.active {
    opacity: 1;
    animation: float 6s ease-in-out infinite;
  }

  .question-inner {
    position: relative;
    padding: 40px 30px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 16px;
    box-shadow: 
      0 10px 30px rgba(0, 0, 0, 0.3),
      0 0 15px rgba(255, 157, 0, 0.5);
    transform-style: preserve-3d;
    transform: translateZ(0);
    transition: transform 0.6s ease, box-shadow 0.6s ease;
    overflow: hidden;
    text-align: center;
  }

  .question-container.active .question-inner {
    animation: cardPulse 3s infinite alternate;
  }

  .question-text {
    font-size: 50px;
    text-align: center;
    color: #333;
    font-weight: 700;
    position: relative;
    z-index: 210;
    pointer-events: auto;
  }

  /* Mascot container */
  .mascot-container {
    max-width: 300px;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-left: 20px;
    opacity: 0;
    transition: all 0.8s ease;
  }

  .mascot-container.active {
    opacity: 1;
  }

  .mascot-img {
    max-height: 400px;
    max-width: 100%;
    object-fit: contain;
    filter: drop-shadow(0 10px 15px rgba(0, 0, 0, 0.3));
    transform: translateZ(0);
    animation: mascotFloat 4s ease-in-out infinite alternate;
  }

  @keyframes mascotFloat {
    0% {
      transform: translateY(0);
    }
    100% {
      transform: translateY(-15px);
    }
  }

  @media (min-width: 768px) {
    .question-text {
      font-size: 38px;
    }
  }

  /* Faces styles - MODIFIED to spread across full width */
  .faces-circle {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 1000;
    transform-style: preserve-3d;
    margin-top: -50px;
  }

  .face {
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 34px;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 100;
    user-select: none;
  }

  /* Individual face colors */
  .face-1 {
    background: #ff3b30;
    border: 3px solid #cc2f26;
    box-shadow: 0 0 15px rgba(255, 59, 48, 0.7);
  }

  .face-2 {
    background: #ff9500;
    border: 3px solid #cc7700;
    box-shadow: 0 0 15px rgba(255, 149, 0, 0.7);
  }

  .face-3 {
    background: #ffcc00;
    border: 3px solid #cca300;
    box-shadow: 0 0 15px rgba(255, 204, 0, 0.7);
  }

  .face-4 {
    background: #a2d729;
    border: 3px solid #82ac21;
    box-shadow: 0 0 15px rgba(162, 215, 41, 0.7);
  }

  .face-5 {
    background: #34c759;
    border: 3px solid #28a046;
    box-shadow: 0 0 15px rgba(52, 199, 89, 0.7);
  }

  .face:hover {
    transform: scale(1.15);
  }

  .face.active {
    transform: scale(1.2);
  }

  .face-1.active {
    box-shadow: 0 0 25px rgba(255, 59, 48, 0.9);
  }

  .face-2.active {
    box-shadow: 0 0 25px rgba(255, 149, 0, 0.9);
  }

  .face-3.active {
    box-shadow: 0 0 25px rgba(255, 204, 0, 0.9);
  }

  .face-4.active {
    box-shadow: 0 0 25px rgba(162, 215, 41, 0.9);
  }

  .face-5.active {
    box-shadow: 0 0 25px rgba(52, 199, 89, 0.9);
  }

  .face-emoji {
    font-size: 100px;
    position: relative;
    z-index: 103;
  }

  .face-tooltip {
    position: absolute;
    top: 150px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 89, 255, 0.8);
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 25px;
    white-space: nowrap;
    z-index: 104;
  }

  /* Animations */
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

  /* Responsive adjustments */
  @media (max-width: 992px) {
    .content-row {
      flex-direction: column;
    }
    
    .mascot-container {
      margin-left: 0;
      margin-top: 20px;
      max-width: 200px;
    }
    
    .mascot-img {
      max-height: 300px;
    }
  }

  @media (max-width: 768px) {
    .question-text {
      font-size: 24px;
    }

    .faces-circle {
      flex-wrap: wrap;
      justify-content: center;
      gap: 210px;
    }

    .face {
      width: 80px;
      height: 80px;
    }

    .face-emoji {
      font-size: 48px;
    }

    .face-tooltip {
      top: 90px;
    }
    
    .mascot-container {
      max-width: 150px;
    }
    
    .mascot-img {
      max-height: 250px;
    }
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
      { id: 1, emoji: '😢', mood: 'Muy insatisfecho' },
      { id: 2, emoji: '🙁', mood: 'Insatisfecho' },
      { id: 3, emoji: '😐', mood: 'Regular' },
      { id: 4, emoji: '🙂', mood: 'Satisfecho' },
      { id: 5, emoji: '😄', mood: 'Muy satisfecho' }
    ],
    startSurvey() {
      if (this.surveyStarted) return;
      this.surveyStarted = true;
      this.startAnimation();
    },
    
    startAnimation() {
      this.animationState = 'shaking';
      
      this.animationState = 'erupting';
      
      setTimeout(() => {
        this.showRandomQuestion();
        this.animationState = 'showing';
      }, 500);
      
    },
    
    showRandomQuestion() {
      this.currentQuestion = this.questions[Math.floor(Math.random() * this.questions.length)];
      this.questionVisible = true;
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
  "
  class="survey-container"
>
  
  <!-- Question and Mascot Row -->
  <div style="margin-top: -200px;" class="block">
    <img class="absolute" style="margin-top: -100px;" src="{{ asset('img/logo.png') }}">
    <div class="content-row">

      <!-- Question container -->
      <div class="question-container" :class="{ 'active': questionVisible }"
          x-transition:enter="transition ease-out duration-700"
          x-transition:enter-start="opacity-0 transform translate-y-10"
          x-transition:enter-end="opacity-100 transform translate-y-0">
        <div class="question-inner">
          <!-- Question Text -->
          <div>
            <p class="question-text" x-text="currentQuestion"></p>
          </div>
        </div>
      </div>
      
      <!-- Mascot container -->
      <div class="mascot-container" :class="{ 'active': questionVisible }"
          x-transition:enter="transition ease-out duration-700 delay-200"
          x-transition:enter-start="opacity-0 transform translate-x-10"
          x-transition:enter-end="opacity-100 transform translate-x-0">
        <img wire:ignore style="width: 200px; height: 300px;" src="{{ asset('img/recomendacion' . rand(1, 3) . '.png') }}" alt="Mascot" class="mascot-img">
      </div>
    </div>
  </div>

  <!-- Faces -->
  <div class="faces-circle" x-show="questionVisible" 
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0 transform translate-y-10"
        x-transition:enter-end="opacity-100 transform translate-y-0">
    <template x-for="(face, index) in faces" :key="face.id">
      <div :class="['face', `face-${face.id}`, { 'active': activeIndex === index }]" 
            @click="setActive(index)">
        <span class="face-emoji" x-text="face.emoji"></span>
        <div class="face-tooltip">
          <span x-text="face.mood"></span>
        </div>
        <div x-show="activeIndex === index" 
              x-transition:enter="transition ease-out duration-300"
              x-transition:enter-start="opacity-0 transform scale-90"
              x-transition:enter-end="opacity-100 transform scale-100"
              x-transition:leave="transition ease-in duration-300"
              x-transition:leave-start="opacity-100 transform scale-100"
              x-transition:leave-end="opacity-0 transform scale-90"
              style="position: absolute; top: -40px; background: rgba(43, 123, 214, 0.7); color: white; font-weight: bold;  padding: 5px 10px; border-radius: 5px; font-size: 15px; z-index: 10400;">
          <span>Seleccionado!</span>
        </div>
      </div>
    </template>
  </div>
</div>