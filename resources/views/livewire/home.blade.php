<div>
    <!-- HEADER -->
    <x-card title="{{ __('Register new short link') }}">
        <x-form wire:submit="submit">
            <x-input label="URL" wire:model="url"/>
            @if($redirect)
                <small class="text-gray-500">{{$redirect}}</small>
            @endif

            <div class="flex justify-between">
                <x-slot:actions>
                    <x-button label="Register!" class="btn-primary" type="submit" spinner="save"/>
                    @if($redirect)
                        <x-button label="{{ __('Click here to test') }}" link="{{$redirect}}" class="btn-warning"
                                  external/>
                    @endif
                </x-slot:actions>
            </div>
        </x-form>

    </x-card>
</div>
