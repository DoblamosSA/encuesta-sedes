<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\Attributes\Url;
use Masmerise\Toaster\Toaster;
use App\Models\CompanyQualification;

class IndexDashboardComponent extends Component
{

    #[Url] 
    public $sede = '';

    private $band = false;

    public $currentQuestion;

    public $questions = [
        0 => '¿Qué tan probable es que recomiende nuestra empresa a un amigo o colega?',
        1 => '¿Qué tan satisfecho está con el servicio recibido?',
        2 => '¿Qué tan satisfecho está con la atención recibida?',
    ];

    private $calification = [
        0 => "MALA ATENCION",
        1 => "PUEDE MEJORAR",
        2 => "NEUTRAL",
        3 => "SATISFECHO",
        4 => "MUY SATISFECHO",
    ];

    public function mount()
    {
        $this->currentQuestion = $this->questions[0];
    }

    public function ClickAlternative($id_calification)
    {
        try {
            if (!$this->band) {
                $this->band = true;

                $id_calification = $id_calification - 1;
    
                $question_number = array_search($this->currentQuestion, $this->questions);
    
                CompanyQualification::create([
                    'headquarters_name' => $this->sede,
                    'qualitication' => $this->calification[$id_calification] ?? null,
                    'question_number' => $question_number
                ]);
    
                Toaster::success('¡Gracias por su calificación!');

                $this->js("setTimeout(function() {
                        window.location.reload();
                    }, 3000);");
            }
        } catch (\Throwable $e) {
            // Puedes usar también Exception en lugar de Throwable si prefieres capturar solo excepciones estándar
            Toaster::error($e->getMessage());
            $this->js("setTimeout(function() {
                window.location.reload();
            }, 2500);");
        }
    }

    public function render()
    {
        return view('livewire.dashboard.index-dashboard-component');
    }
}
