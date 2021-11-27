/**
 *  @package diTheme
*/

/*
    ##################################################
    |   FORM ELEMENTS                                |
    ##################################################
*/

export class Select 
{
    constructor ( element ) {
        this.element = element;
        this.options = getFormattedOptions(element.querySelectorAll('option'));
        this.customElement = document.createElement('div');
        this.labelElement = document.createElement('span');
        this.optionsCustomElement = document.createElement('ul');

        setupCustomElement(this);
        element.style.display = 'none';
        element.after(this.customElement);
    }

    get selectedOption()
    {
        return this.options.find( option => option.selected );
    }

    get selectedOptionIndex()
    {
        return this.options.indexOf( this.selectedOption );
    }

    selectValue (value)
    {
        if ( value !== '') {
            const newSelectedOption = this.options.find(option => {
                return option.value === value;
            })
            const prevSelectedOption = this.selectedOption;
            prevSelectedOption.selected = false;
            prevSelectedOption.element.selected = false;

            newSelectedOption.selected = true;
            newSelectedOption.element.selected = true;

            this.labelElement.innerText = newSelectedOption.label;
            this.optionsCustomElement
                .querySelector(`[data-value="${prevSelectedOption.value}"]`)
                .classList.remove('selected');

            const newCustomElement = this.optionsCustomElement
                .querySelector(`[data-value="${newSelectedOption.value}"]`);
            newCustomElement.classList.add('selected');
            newCustomElement.scrollIntoView({block: 'nearest'});
        }
    }
}

function setupCustomElement(select)
{
    select.customElement.classList.add('di-select-container');
    select.customElement.tabIndex = 0;

    select.labelElement.classList.add('di-select-value');
    select.labelElement.innerText = select.selectedOption.label;
    if (select.selectedOption.value === '') select.labelElement.classList.add('placeholder');
    select.customElement.append(select.labelElement);

    select.optionsCustomElement.classList.add('di-select-options');
    select.options.forEach(option => {
        
        const optionEl = document.createElement('li');
        optionEl.classList.add('di-select-option');
        if ( option.value === '' ) { optionEl.classList.add('hidden'); }
        optionEl.classList.toggle('selected', option.selected);
        optionEl.innerText = option.label;
        optionEl.dataset.value = option.value;
        optionEl.addEventListener('click', () => {
            select.selectValue(option.value);
            select.labelElement.classList.remove('placeholder');
            select.optionsCustomElement.classList.remove('show');
        })
        select.optionsCustomElement.append(optionEl);
    })
    select.customElement.append(select.optionsCustomElement);

    select.labelElement.addEventListener('click', () => {
        select.optionsCustomElement.classList.toggle('show');
    })

    select.customElement.addEventListener('blur', () => {
        select.optionsCustomElement.classList.remove('show');
    })

    let debounceTimeout;
    let searchTerm = '';
    select.customElement.addEventListener('keydown', e => {
        switch (e.code) {
            case "Space":
                select.optionsCustomElement.classList.toggle('show');
                break;
            case "ArrowUp":
                const prevOption = select.options[select.selectedOptionIndex - 1];
                if ( prevOption ) {
                    select.selectValue( prevOption.value );
                    select.labelElement.classList.remove('placeholder');
                }
                break;
            case "ArrowDown":
                const nextOption = select.options[select.selectedOptionIndex + 1];
                if ( nextOption ) {
                    select.selectValue( nextOption.value );
                    select.labelElement.classList.remove('placeholder');
                }
                break;
            case "Enter":
            case "Escape":
                select.optionsCustomElement.classList.remove('show');
                break;
            default:
                clearTimeout(debounceTimeout);
                searchTerm += e.key;
                debounceTimeout = setTimeout(() => {
                    searchTerm = '';
                }, 500)

                const searchedOption = select.options.find(option => {
                    return option.label.toLowerCase().startsWith(searchTerm);
                });
                if ( searchedOption ) {
                    select.selectValue(searchedOption.value);
                    select.labelElement.classList.remove('placeholder');
                };
        }
    })
}

function getFormattedOptions(optionElements)
{
    return [...optionElements].map(optionElement => {
        return {
            value: optionElement.value,
            label: optionElement.label,
            selected: optionElement.selected,
            element: optionElement
        }
    })
}