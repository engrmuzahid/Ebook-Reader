export default class {
    constructor(data) {
        this.slide = this.getSlide(data);
    }

    getSlide(data) {
        data.slide.options = data.slide.options || this.getDefaultSlideOptions();

        let template = _.template($('#slide-template').html());

        return $(template(data));
    }

    getDefaultSlideOptions() {
        return { caption_1: {}, caption_2: {}, caption_3: {}, call_to_action: {} };
    }

    render() {
        this.eventListeners();
        this.showSelectedOptionBlock();

        return this.slide;
    }

    eventListeners() {
        this.attachDeleteEvent();
        this.attachChangeBlockEvent();
    }

    attachDeleteEvent() {
        this.slide.find('.delete-slide').on('click', () => {
            this.slide.remove();
        });
    }

    attachChangeBlockEvent() {
        this.slide.find('.change-option-block').on('change', (e) => {
            this.slide.find('.slide-options').hide();
            this.slide.find(`.${e.currentTarget.value}`).show();
        });
    }

    showSelectedOptionBlock() {
        setTimeout(() => {
            this.slide.find('.change-option-block').trigger('change');
        });
    }
}
