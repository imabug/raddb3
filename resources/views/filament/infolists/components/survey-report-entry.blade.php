<x-dynamic-component
    :component="$getEntryWrapperView()"
    :entry="$entry"
>
    <div {{ $getExtraAttributeBag() }}>
        <x-filament::icon-button
            icon="heroicon-m-document"
            tag="a"
            href="{{ $getSurveyLink($record->id) }}"
         />
    </div>
</x-dynamic-component>
