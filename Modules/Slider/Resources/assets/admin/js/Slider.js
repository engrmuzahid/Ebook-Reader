import Slide from './Slide';

export default class {
    constructor() {
        this.slideCount = 0;

        $('.add-slide').on('click', () => {
            this.addSlide();
        });

        this.addSliderSlides(CI.data['slider.slides']);
        this.makeSlidesSortable();
        this.addSlideImage();
    }

    addSliderSlides(slides) {
        for (let attributes of slides) {
            this.addSlide(attributes);
        }

        // If there is no model slide or any old slide then
        // automatically add an empty slide on page load.
        if (slides.length === 0) {
            $('.add-slide').trigger('click');
        }
    }

    addSlide(attributes = {}) {
        let slide = new Slide({ slideNumber: this.slideCount++, slide: attributes });

        $('#slides-wrapper').append(slide.render());
        $('.color-picker').spectrum({
            type: "text",
            togglePaletteOnly: "true",
            hideAfterPaletteSelect: "true",
            showInput: "true",
            showInitial: "true"
        });
    }

    makeSlidesSortable() {
        Sortable.create(document.getElementById('slides-wrapper'), {
            handle: '.slide-drag',
            animation: 150,
        });
    }

    addSlideImage() {
        $('#slides-wrapper').on('click', '.slide-image', (e) => {
            let picker = new MediaPicker({ type: 'image' });

            picker.on('select', (files) => {
                let html = `
                    <img src="${files.path}">
                    <input type="hidden" name="slides[${e.currentTarget.dataset.slideNumber}][files_id]" value="${files.id}">
                `;

                $(e.currentTarget).html(html);
            });
        });
    }
}
