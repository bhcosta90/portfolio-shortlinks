<div>
    <p><strong>Endpoint: </strong><small class="text-gray-500">{{ route('redirect', $shortLinkOutput['hash']) }}</small></p>
    <x-hr />

    <x-stat
        title="{{__('Clicks')}}"
        description="{{ __('Clicks that occurred in this redirect') }}"
        value="{{ $shortLinkOutput['total'] }}"
        icon="o-arrow-trending-up"
        tooltip-bottom="There" />
</div>
