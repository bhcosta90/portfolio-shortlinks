<?php

namespace App\Livewire;

use Core\UseCase\ShowShortLink;
use Livewire\Component;
use Mary\Traits\Toast;

class ShortLink extends Component
{
    use Toast;

    protected ShowShortLink $shortLink;

    public array $shortLinkOutput;

    public function boot(ShowShortLink $shortLink): void
    {
        $this->shortLink = $shortLink;
    }

    public function mount(string $id)
    {
        $this->shortLinkOutput = (array) $this->shortLink->execute(id: $id);
    }

    public function render()
    {
        return view('livewire.short-link');
    }
}
