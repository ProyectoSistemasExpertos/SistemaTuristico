@props(['settings', 'imageUrls'])

<div class="w-full">
    <x-slider data-settings="{{ $settings }}" :imageUrls="{{ $imageUrls }}" />
</div>
