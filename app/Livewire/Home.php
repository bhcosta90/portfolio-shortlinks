<?php

namespace App\Livewire;

use Core\UseCase\CreateShortLink;
use Livewire\Component;
use Mary\Traits\Toast;

class Home extends Component
{
    use Toast;

    public ?string $url = null;
    public ?string $redirect = null;

    protected CreateShortLink $shortLink;

    public function boot(CreateShortLink $shortLink): void
    {
        $this->shortLink = $shortLink;
    }

    public function render()
    {
        return view('livewire.home');
    }

    public function submit(): void
    {
        $response = $this->shortLink->execute(url: $this->url);
        $this->redirect(route('short-link.show', $response->id), navigate: true);
    }
}
