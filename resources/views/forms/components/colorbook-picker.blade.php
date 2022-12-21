<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-action="$getHintAction()"
    :hint-color="$getHintColor()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    <div x-data="{
            state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')', lazilyEntangledModifiers: ['defer']) }},
            colors: @js( $getColors() ),
            isOpen: false,
{{--            darkSelector: '',--}}
            colorSelectedName: @js($colorSelectedName),
            colorSelectedHex: @js($colorSelectedHex),
{{--            colorSelectedRgb: @js($colorSelectedRgb),--}}
            changeColor(name, hex) {
                this.colorSelectedName = name;
                this.colorSelectedHex = hex;
{{--                if (this.textColorContrast(hex)) { this.darkSelector = false} else { this.darkSelector = true};--}}
            },
            init() {
                this.colorSelectedHex = this.arrayLookup(this.colorSelectedName, this.colors, 'name', 'hex');
{{--                this.colorSelectedRgb = this.arrayLookup(this.colorSelectedName, this.colors, 'name', 'rgb');--}}
            },
{{--            textColorContrast(bgColor) {--}}
{{--                var color = (bgColor.charAt(0) === '#') ? bgColor.substring(1, 7) : bgColor;--}}
{{--                var r = parseInt(color.substring(0, 2), 16); // hexToR--}}
{{--                var g = parseInt(color.substring(2, 4), 16); // hexToG--}}
{{--                var b = parseInt(color.substring(4, 6), 16); // hexToB--}}
{{--                var uicolors = [r / 255, g / 255, b / 255];--}}
{{--                var c = uicolors.map((col) => {--}}
{{--                if (col <= 0.03928) {--}}
{{--                  return col / 12.92;--}}
{{--                }--}}
{{--                return Math.pow((col + 0.055) / 1.055, 2.4);--}}
{{--                });--}}
{{--                var L = (0.2126 * c[0]) + (0.7152 * c[1]) + (0.0722 * c[2]);--}}
{{--                console.log(L > 0.179);--}}
{{--                return (L > 0.179);--}}
{{--            },--}}
            arrayLookup(searchValue,array,searchIndex,returnIndex)
            {
                var returnVal = null;
                var i;
                for(i=0; i<array.length; i++) {
                    if(array[i][searchIndex]==searchValue) {
                    returnVal = array[i][returnIndex];
                    break;
                    }
                }
                return returnVal;
            },
            colorSelectedName: $wire.entangle('{{ $getStatePath() }}'),
        }"
        x-init="init()"
    >


        @if ($label = $getPrefixLabel())
            <span @class($affixLabelClasses)>
                {{ $label }}
            </span>
        @endif

        <div class="flex items-center relative">
            <div
                class="colorbook-picker flex w-full border-0 rounded-lg ring-4 ring-transparent"
                {{ $attributes->merge($getExtraAttributes())->merge($getExtraAlpineAttributes()) }}
                :style="`--tw-ring-color: #${colorSelectedHex}`"
                x-data="selectFormComponent({
                            getOptionLabelUsing: async () => {
                                return await $wire.getSelectOptionLabel(@js($getStatePath()))
                            },
                            getOptionLabelsUsing: async () => {
                                return await $wire.getSelectOptionLabels(@js($getStatePath()))
                            },
                            getOptionsUsing: async () => {
                                return await $wire.getSelectOptions(@js($getStatePath()))
                            },
                            getSearchResultsUsing: async (search) => {
                                return await $wire.getSelectSearchResults(@js($getStatePath()), search)
                            },
                            isHtmlAllowed: true,
                            hasDynamicOptions: @js($hasDynamicOptions()),
                            hasDynamicSearchResults: @js($hasDynamicSearchResults()),
                            options: @js($getOptionsForJs()),
                            optionsLimit: @js($getOptionsLimit()),
                            placeholder: @js($getPlaceholder()),
                            position: @js($getPosition()),
                            searchDebounce: @js($getSearchDebounce()),
                            searchingMessage: @js($getSearchingMessage()),
                            searchPrompt: @js($getSearchPrompt()),
                            state: $wire.{{ $applyStateBindingModifiers('entangle(\'' . $getStatePath() . '\')') }},
                        })"
                wire:ignore
            >
                <select
                    x-ref="input"
                    id="{{ $getId() }}"
                    @change="changeColor($event.target.value, arrayLookup($event.target.value, colors, 'label', 'hex'))"
                    {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
                    {!! $isLazy() ? "x-on:blur=\"\$wire.\$refresh\"" : null !!}
                    {!! $isDebounced() ? "x-on:input.debounce.{$getDebounce()}=\"\$wire.\$refresh\"" : null !!}
                    {{ $getExtraInputAttributeBag() }}
                    {{ $getExtraAlpineAttributeBag() }}
                    class="block w-full px-4 py-2 leading-normal border-0 bg-white dark:bg-gray-700 text-gray-700 dark:text-white disabled:opacity-70 duration-75 focus:outline-none focus:ring-0 shadow-none focus:shadow-none transition"
                ></select>
            </div>
        </div>
    </div>
</x-dynamic-component>
