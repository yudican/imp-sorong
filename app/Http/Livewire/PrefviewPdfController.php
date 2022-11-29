<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PrefviewPdfController extends Component
{
  public $pdf;

  public function mount($file = null)
  {
    if (!$file) return abort(404);

    return response()->file(storage_path('upload/' . $file));
  }
}
